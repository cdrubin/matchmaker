<?php

namespace matchmaker;

function catches($value, $pattern)
{
    require_once('key_matcher.php');

    if (is_array($pattern)) {
        if (!is_array($value) && !$value instanceof \Traversable) {
            throw new \Exception( "validation error: value is non-array and non-transversable" );
        }
        $keyMatcher = key_matcher($pattern);
        foreach ($value as $key => $item) {
            if (!$keyMatcher($key, $item)) throw new \Exception( "validation error: value '" . $item . "' is invalid for key '" . $key . "'" );
            if (!isset( $pattern[$key] )) throw new \Exception( "validation error: key '" . $key . "' not found in schema" );
        }
        if (!$keyMatcher()) return false;
    } elseif (!matcher($value, $pattern)) {
        return false;
    }

    return true;
}
