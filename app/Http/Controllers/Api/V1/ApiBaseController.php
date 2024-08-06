<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponses;

// base class for api controllers
class ApiBaseController extends Controller
{
    use ApiResponses;
    /**
     * Check if this queryValue exist in the query params with this queryKey.
     */
    protected function checkQueryParam(string $queryKey, string $queryValue) :bool {
        $params = request()->get( $queryKey);
        if (!isset($params)) {
            return false;
        }
        // convert comma separated values to list
        $queryValueList = explode(',',strtolower($params));

        return in_array(strtolower($queryValue), $queryValueList);
    }


    /**
     * Check if this relation exist in the query params with 'include' key.
     */
    public function include( string $relation) :bool {

        return $this->checkQueryParam("include", $relation);

    }
}
