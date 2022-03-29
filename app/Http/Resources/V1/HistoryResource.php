<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;


class HistoryResource extends JsonResource
{
    protected $without_fields = [];
    protected $accept_fields = [];
    protected $rename_fields = [];
    protected $field_items = [];

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public static function collection($resource)
    {
        return tap(new HistoryResourceCollection($resource), function ($collection) {
            $collection->collects = __CLASS__;
        });
    }

    public function rename($rename_fields){
        if( !is_array($rename_fields) ){
            $rename_fields = (array)$rename_fields;
        }
        $this->rename_fields = $rename_fields;
        return $this;
    }

    /**
     * Hide Properties From Resoonse
     */
    public function hide($hide_fields){
        if( !is_array($hide_fields) ){
            $hide_fields = (array)$hide_fields;
        }
        $this->without_fields = $hide_fields;
        return $this;
    }

    public function accept($accept_fields){
        if( !is_array($accept_fields) ){
            $accept_fields = (array)$accept_fields;
        }
        $this->accept_fields = $accept_fields;
        $all_fields = array_keys( $this->fieldItems() );
        $this->without_fields = array_diff($all_fields,$this->accept_fields);
        return $this;
    }

    /**
     * Filter the response And Hide Unwanted Properties
     */
    protected function filterArray($array = []){
        $items = collect($array)->forget($this->without_fields)->toArray();
        return $items;
    }

    public function fieldItems(){
        $this->field_items = [
            "id"                          => $this->id,
            "product_id"                  => $this->product_id,
            "store_id"                    => $this->store_id,
            "invoice_id"                  => $this->invoice_id ?? "",
            "product_type"                => $this->product_type ?? "",
            "customer_name"               => $this->customer_name ?? "",
            "customer_phone"              => $this->customer_phone ?? "",
            "pickup_phone"                => $this->store->contact_number ?? "",
            "pickup_address"              => $this->store->pickup_address,
            "shipping_address"            => $this->shipping_address ?? "",
            "weight"                      => $this->weight ?? "",
            "product_price"               => $this->product_price ?? 0,
            "delivery_charge"             => $this->delivery_charge ?? 0,
            "invoice_price"               => $this->invoice_price ?? 0,
            "collection_price"            => $this->collection_price ?? 0,
            "payment_method"              => $this->payment_method ?? "",
            "delivery_type"               => $this->delivery_type,
            "status"                      => $this->parcelOperation->status->name ?? "",
            "shipping_area"               => $this->area ?? "",
            "driver_pickedup_commission"  => ( new ParcelController() )->getPickedupCommision($this->id),
            "driver_delivered_commission" => ( new ParcelController() )->getDeliveredCommision($this->id),
            "pickedup_payment_settled"    => ( new ParcelController() )->getPaymentSettled($this->id)[Status::$STATUS_PICKED_UP],
            "delivered_payment_settled"   => ( new ParcelController() )->getPaymentSettled($this->id)[Status::$STATUS_DELIVERED],
            "actions"                     => ( new ParcelController() )->getAllowedActions($this->id) ?? null,
            "reasons"                     => ( new ParcelController() )->getNextStatusReasons($this->id),
            "printed_barcode"             => env('APP_PARCEL_BARCODE_PREFIX', 'KX-') . $this->id,
        ];

        if($this->rename_fields != [] ){
            foreach($this->rename_fields as $key => $value){
                $this->field_items[$value] = $this->field_items[$key];
                unset($this->field_items[$key]);
            }
        }

        return $this->field_items;
    }

    /**
     * Return Response Into Array
     */
    public function toArray($request)
    {
        // if we need all parameters - return parent::toArray($request);
        return $this->filterArray($this->fieldItems());
    }
}
