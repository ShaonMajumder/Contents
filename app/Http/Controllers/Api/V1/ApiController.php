<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\UserResource;
use App\Models\History;
use App\Models\Site;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends Controller
{    
    public function visited(Request $request){
        try {
            $date = Carbon::parse($request->visit_time);
            $domain = parse_url($request->get('url'))['host'];

            $site = Site::firstOrCreate(['host' => $domain]);           
            $history = History::create([
                'title'      => $request->title,
                'url'        => $request->url,
                'visit_time' => $date->format('Y-m-d H:i:s T'),
                'site_id'    => $site->id
            ]);
            
            $this->apiSuccess();
            $this->data = $history;
            return $this->apiOutput(Response::HTTP_OK, "Current Visit Stored in Database !");
        } catch (Exception $e) {
            return $this->apiOutput(Response::HTTP_INTERNAL_SERVER_ERROR, $this->getExceptionError($e));
        }
    }
}
