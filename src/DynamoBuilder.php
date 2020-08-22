<?php

namespace API;

use Illuminate\Pagination\Paginator;

class DynamoBuilder extends \BaoPham\DynamoDb\DynamoDbQueryBuilder
{
    public function items()
    {
        return $this->get();
    }
    
    public function toArray()
    {
        $items = $this->items();
        
        return $items->toArray();
    }
    
    public function paginate($perPage)
    {
        $this->limit($perPage);
        $items = $this->toArray();
        
        //$items = !$items ? $items : $items;
        
        $api = app()->get(API::class);
        
        $paginator = new Paginator($items, $perPage);
        $paginator->setPath(env('APP_URL') . $api->base->endpoint);
        
        return $paginator;
    }
}