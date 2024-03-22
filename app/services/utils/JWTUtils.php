<?php

namespace Services\Utils;

class JWTUtils {

    private static $key = "sdwsdfsdf;fewfefr234rcascs";

    public static function generateToken($userid) {
        //create token payload
        $payload = [
            'user_id' => $userid
        ];

        $payloadEncoded = base64_encode(json_encode($payload));
        $signature = hash_hmac('sha256', $payloadEncoded, JWTUtils::$key);

        return sprintf('%s.%s', $payloadEncoded, $signature);
    }

    public static function verifyToken($token) {
        $payload = JWTUtils::getTokenPayload($token);
        $userid = $payload['user_id'];

        //generate signature and verify
        return JWTUtils::generateToken($userid) == $token;
    }

    public static function getTokenPayload($token) {
        //get payload and signature
        [$payloadEncoded] = explode('.', $token);

        //get payload
        return json_decode(base64_decode($payloadEncoded), true);
    }
}