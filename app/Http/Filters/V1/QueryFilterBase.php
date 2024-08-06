<?php

namespace App\Http\Filters\V1;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class QueryFilterBase {
    protected $builder;
    protected $request;

    public function __construct(Request $request) {
        return $this->request = $request;
    }

    public function apply(Builder $builder){
        $this->builder = $builder; // get builder 
        
        foreach($this->request->all() as $key => $value) {
            if (method_exists($this, $key)) {
                $this->$key($value); // run methods of implemented Filter class and change builder in them
            }
        }

        return $builder; // return filtered builder.
    }
}