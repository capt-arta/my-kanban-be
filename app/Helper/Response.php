<?php

namespace App\Helper;

class Response
{
    public static function success($payload = [])
    {
        $payload = (object) $payload;
        return response()->json([
            'code' => $payload->code ?? 1,
            'data' => $payload->data ?? null,
            'message' => $payload->message ?? "success",
            'error' => $payload->error ?? null
        ], $payload->status_code ?? 200);
    }

    public static function failed($payload = [])
    {
        $payload = (object) $payload;
        return response()->json([
            'code' => $payload->code ?? 0,
            'data' => $payload->data ?? null,
            'message' => $payload->message ?? "failed",
            'error' => $payload->error ?? null
        ], $payload->status_code ?? 200);
    }
}
