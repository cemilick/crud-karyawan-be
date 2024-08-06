<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\RouteDiscovery\Attributes\DoNotDiscover;

class BaseController extends Controller
{
    protected $class;

    #[DoNotDiscover]
    public function sendResponse($result, $message, $code = 200)
    {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }

    #[DoNotDiscover]
    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }

    #[DoNotDiscover]
    public function validateRequest($request)
    {
        $model = new $this->class;
        $rules = $model->rules();
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->sendError('Error validate request', $validator->errors(), 400);
        }

        return false;
    }
}
