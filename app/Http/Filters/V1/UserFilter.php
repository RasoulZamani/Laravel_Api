<?php

namespace App\Http\Filters\V1;

use App\Http\Filters\V1\QueryFilterBase;

class UserFilter extends QueryFilterBase {
    
    protected $sortable = [
        'name',
        'email',
        'createdAt' => 'created_at',
        'updatedAt' => 'updated_at',
    ];
    // include relations
    public function include($relation) {
        return $this->builder->with($relation);
    }

    // filter users by id
    public function id($value) {
        return $this->builder->whereIn('id',explode(',', $value));
    }

    // filter users by  email
    public function email($value) {
        $likeStr = str_replace('*', '%', $value);
        return $this->builder->where('email','like', $likeStr);
    }

    // filter users by name
    public function name($value) {
        $likeStr = str_replace('*', '%', $value);
        return $this->builder->where('name','like', $likeStr);
    }

    // filter users by created_at
    public function createdAt($value) {
        $dates = explode(',', $value);
        if (count($dates)>1) { 
            // it means user want to filter between two dates
            return $this->builder->whereBetween('created_at', $dates);
        }
        return $this->builder->whereDate('created_at',$value);
    }

    // filter users by updated_at
    public function updatedAt($value) {
        $dates = explode(',', $value);
        if (count($dates)>1) { 
            // it means user want to filter between two dates
            return $this->builder->whereBetween('updated_at', $dates);
        }
        return $this->builder->whereDate('updated_at',$value);
    }
}

