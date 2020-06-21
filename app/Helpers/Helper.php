<?php
namespace App\Helpers;

use App\User;
use Exception;
use Throwable;
use Storage;

class Helper {
    /**
     * Sends  input error response
     *
     * @param type $validation_error_message
     * @return type \Illuminate\Http\JsonResponse
     */
    public static function send_input_error_response($validation_error_message) {
        $status = 'fail';
        $message = 'Bad Request';
        $data = ['error' =>
            [
                'user_message' => $validation_error_message,
                'internal_message' => 'Required inputs need to be filled and it must be valid.',
                'code' => '1002'
            ]
        ];

        return Helper::send_fail_response($data, $message, $status, 400);
    }

    /**
     * Sends exception response
     *
     * @param type $error
     * @return type \Illuminate\Http\JsonResponse
     */
    public static function send_exception_response($error) {
        $status = 'failed';
        $message = 'Internal Server Error';
        $data = [
            'error' => [
                'user_message' => 'Something went wrong. Kindly report on this.',
                'internal_message' => $error,
                'code' => '1100'
            ]
        ];

        return Helper::send_fail_response($data, $message, $status, 500);
    }

    /**
     *
     * Sends success reponse
     *
     * @param type $data
     * @return type \Illuminate\Http\JsonResponse
     */
    public static function send_success_response($data) {
        $response_array = [
            "program" => config('app.name'),
            "version" => config('api.version'),
            "release" => config('api.release'),
            "datetime" => date('Y-m-d h:i:s A'),
            "timestamp" => time(),
            "status" => "success",
            "code" => "200",
            "message" => "OK",
            "data" => $data
        ];

        return response()->json($response_array, 200);
    }

    /**
     * Sends failure response
     *
     * @param type $data
     * @param type $message
     * @param type $status
     * @param type $status_code
     * @return type \Illuminate\Http\JsonResponse
     */
    public static function send_fail_response($data, $message, $status = 'fail', $status_code = 500) {
        $response_array = [
            "program" => config('app.name'),
            "version" => config('api.version'),
            "release" => config('api.release'),
            "datetime" => date('Y-m-d h:i:s A'),
            "timestamp" => time(),
            "status" => $status,
            "code" => "$status_code",
            "message" => $message,
            "data" => $data
        ];

        return response()->json($response_array, $status_code);
    }

    /**
     * [exception_handling description]
     * @param  [type] $ex [description]
     * @return [type]     [description]
     */
    public static function exception_handling($ex) {
        return Helper::send_exception_response('Error: ' . $ex->getMessage() . ' Line Number: ' . $ex->getLine());
    }
}
