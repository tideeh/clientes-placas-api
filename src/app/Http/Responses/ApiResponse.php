<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;

final class ApiResponse
{
    public static function ok(mixed $data = null, string $message = 'OK'): JsonResponse
    {
        return response()->json(
            [
                'success' => true,
                'message' => $message,
                'data' => $data,
            ],
            200
        );
    }

    public static function created(mixed $data, string $message = 'Created'): JsonResponse
    {
        return response()->json(
            [
                'success' => true,
                'message' => $message,
                'data' => $data,
            ],
            201
        );
    }

    public static function noContent(): JsonResponse
    {
        return response()->json(null, 204);
    }

    public static function error(string $message, int $status = 400, mixed $errors = null): JsonResponse
    {
        return response()->json(
            [
                'success' => false,
                'message' => $message,
                'errors' => $errors,
            ],
            $status
        );
    }
}
