<?php

namespace JobSeeker\Port\Primary\ResponseHandler\Api;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiResponseHandler
{
    /**
     * Get a formatted json api response
     *
     * @param int $status
     * @param string $message
     * @param array $data
     * @return JsonResponse
     */
    public static function jsonResponse( int $status = Response::HTTP_OK, string $message = '', array $data = [])
    {
        return response()->json([
            'message' => $message,
            'data' => $data
        ], $status);
    }

}
