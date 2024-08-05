<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// base class for api controllers
class ApiBaseController extends Controller
{
    /**
     * Check if this queryValue exist in the query params with this queryKey.
     */
    public function checkQueryParam(string $queryKey, string $queryValue) :bool {
        $params = request()->get( $queryKey);
        if (!isset($params)) {
            return false;
        }
        // convert comma separated values to list
        $queryValueList = explode(',',strtolower($params));

        return in_array(strtolower($queryValue), $queryValueList);

    }
}
