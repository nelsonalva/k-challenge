<?php

namespace App\Services;

class Tools
{
/** Identifies if a route has the prefix 'public' or 'protected'*/
    public static function trimRoute($route)
    {
        if (strpos($route, 'public') == true) {
            return 'public';
        }
        elseif (strpos($route, 'protected') == true) {
            return 'protected';
        }
        else {
            return 'other';
        }

        // return $route;

    }
}