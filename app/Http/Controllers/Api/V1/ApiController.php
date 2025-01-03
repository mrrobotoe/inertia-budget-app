<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;

class ApiController extends Controller
{
    use ApiResponse;


    public function __construct()
    {

    }

    public function include(string $relationship): bool {
        $param = request()->get('include');

        if (!isset($param)) {
            return false;
        }

        $includedValues = explode(',', strtolower($param));

        return in_array(strtolower($relationship), $includedValues);
    }
}
