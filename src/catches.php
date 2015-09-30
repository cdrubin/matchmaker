<?php

namespace matchmaker;

function catches($value, $pattern)
{
	require_once('key_catcher.php');

    if (is_array($pattern)) {
        if (!is_array($value) && !$value instanceof \Traversable) {
			return false;
        }
        $keyCatcher = key_catcher($pattern);
        foreach ($value as $key => $item) {
			if (!$keyCatcher($key, $item)) throw new \Exception( "validation error: value '" . $item . "' is invalid for key '" . $key . "'" );
			if ($keyCatcher($key)) throw new \Exception( "validation error: key '" . $key . "' not found in schema" );
        }
        if (!$keyCatcher()) return false;
    } elseif (!catcher($value, $pattern)) {
        return false;
    }

    return true;
}
