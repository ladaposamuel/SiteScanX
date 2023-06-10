<?php
header('Content-type: application/json');

/**
 * Class APIHelper
 */
class APIHelper
{

    /**
     * Formats a response to be sent back to the client
     * Sample usage: $response = formatResponse('success', 'Data retrieved successfully', $data, 200);
     * @param $status
     * @param $message
     * @param $statusCode
     * @param $data
     * @return false|string
     */
    public static function formatResponse($status, $message,  $statusCode, $data = null)
    {
        http_response_code(isset($statusCode) ? $statusCode : 200);
        $response = compact('status', 'message');

        if ($data !== null) {
            $response['data'] = $data;
        }


        $response['status_code'] = isset($statusCode) ? $statusCode : 200;


        return json_encode($response);
    }

}
