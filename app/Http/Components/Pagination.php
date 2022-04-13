<?php

namespace App\Http\Components;

trait Pagination{

    /**
     * Generate $ get Pagination Links
     */
    protected function getPaginationLinks($paginator){
        return [
            "per_page"      => $paginator->perPage(),
            "total"         => $paginator->total(),
            "prev_page"     => $paginator->previousPageUrl(),
            "current_page"  => $paginator->url($paginator->currentPage()),
            "next_page"     => $paginator->nextPageUrl(),
            "total_page"    => ceil($paginator->total() / $paginator->perPage()),
        ];
    }
}