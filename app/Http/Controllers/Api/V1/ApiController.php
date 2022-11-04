<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller as BaseController;
use App\Trits\ApiHttpResponses;

class ApiController extends BaseController
{
    /**
     * Respond with http 200 success (or other similar code)
     *
     * @param  mixed  $data
     * @param  string  $message
     * @param  integer $code
     * @return JsonResponse
     */
    protected function success($data, $message = null, $code = 200)
    {
        return response()->json([
            'status'  => 'success',
            'message' => $message,
            'data'    => $data
        ], $code);
    }

    /**
     * Respond with http 200 success (or other similar code)
     *
     * @param  mixed  $data
     * @param  string  $message
     * @param  integer $code
     * @return JsonResponse
     */
    protected function error($data, $message = null, $code = 500)
    {
        return response()->json([
            'status'  => 'error',
            'message' => $message,
            'data'    => $data
        ], $code);
    }
}
