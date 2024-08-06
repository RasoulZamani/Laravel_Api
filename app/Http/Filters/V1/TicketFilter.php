<?php

namespace App\Http\Filters\V1;

use App\Http\Filters\V1\QueryFilterBase;

class TicketFilter extends QueryFilterBase {
    
    // include relations
    public function include($relation) {
        return $this->builder->with($relation);
    }

    // filter tickets by status
    public function status($value) {
        return $this->builder->whereIn('status',explode(',', $value));
    }

    // filter tickets by title 
    public function title($value) {
        $likeStr = str_replace('*', '%', $value);
        // return $this->builder->where('title',$value);
        return $this->builder->where('title','like', $likeStr);
    }

    // filter tickets by created_at
    public function createdAt($value) {
        $dates = explode(',', $value);
        if (count($dates)>1) { 
            // it means user want to filter between two dates
            return $this->builder->whereBetween('created_at', $dates);
        }
        return $this->builder->whereDate('created_at',$value);
    }

    // filter tickets by updated_at
    public function updatedAt($value) {
        $dates = explode(',', $value);
        if (count($dates)>1) { 
            // it means user want to filter between two dates
            return $this->builder->whereBetween('updated_at', $dates);
        }
        return $this->builder->whereDate('updated_at',$value);
    }
}

