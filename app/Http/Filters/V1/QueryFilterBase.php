<?php

namespace App\Http\Filters\V1;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class QueryFilterBase {
    protected $builder;
    protected $request;
    protected $sortable = [] ; // name of columns in db that you can sort
                               //It will be written in child class.                     
    public function __construct(Request $request) {
        return $this->request = $request;
    }

    // apply filters to given builder
    public function apply(Builder $builder){
        $this->builder = $builder; // get builder 
        
        foreach($this->request->all() as $key => $value) {
            if (method_exists($this, $key)) {
                $this->$key($value); // run methods of implemented Filter class and change builder in them
            }
        }

        return $builder; // return filtered builder.
    }

    // sort results
    public function sort($values) {
        $sortList = explode(',', $values);
        foreach($sortList as $sortAttribute){
            $direction = "asc"; //default sort direction

            if (strpos($sortAttribute,'-') === 0) {
                // if sort attribute start with minus (-):
                $direction = "desc";
                $sortAttribute = substr($sortAttribute, 1);
            }
            if (!in_array($sortAttribute, $this->sortable) && !array_key_exists($sortAttribute, $this->sortable)) {
                continue; // ignore whatever in not in sortable list
            }
            
            // if sortable attribute is just a name (not key-val) then that name will be a column name
            // but if it is a key-val pair then its value should be consider as a name of column like created_at in createdAt => 'created_at.
            $columnName = $this->sortable[$sortAttribute] ? $this->sortable[$sortAttribute]: $sortAttribute;

            $this->builder->orderBy($columnName, $direction);
        }
    }


}