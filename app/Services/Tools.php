<?php

namespace App\Services;

class Tools
{
    /** Identifies if a route has the prefix 'public' or 'protected'*/
    public static function trimRoute($route)
    {
        if (strpos($route, 'public') == true) {
            return 'public';
        } elseif (strpos($route, 'protected') == true) {
            return 'protected';
        } else {
            return 'route';
        }
    }

    /** Format json response for create and update to comply with JSON:API Specs*/
    public static function formatResponse($response, $type)
    {
        $id = $response['id'];
        unset($response['id']);
        $response = [
            'data' => [
                'type' => $type, 'id' => $id, 'attributes' => $response
            ]
        ];

        return $response;
    }
}
