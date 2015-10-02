<?php

namespace matchmaker;

function catches($value, $pattern, $context ='') {

	require_once('key_catcher.php');

    if (is_array($pattern)) {
        if (!is_array($value) && !$value instanceof \Traversable) {
			return false;
        }
        $keyCatcher = key_catcher($pattern, $context);
        foreach ($value as $key => $item) {
			if (!$keyCatcher($key, $item) ) throw new \Exception( "validation error: invalid key '" . $context . '.' . $key . "'" );
			if ($keyCatcher($key)) throw new \Exception( "validation error: key '" . $context . '.' . $key . "' not found in schema" );
        }
        if (!$keyCatcher()) return false;
    } elseif (!catcher($value, $pattern)) {
        return false;
    }

    return true;

}
