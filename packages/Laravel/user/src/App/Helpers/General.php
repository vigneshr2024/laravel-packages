<?php

use Illuminate\Support\Facades\DB;

if (!function_exists('uniqueIdGenerator')) {
    function uniqueIdGenerator($table, $field, $id)
    {
        $number = mt_rand(1000000000, 9999999999); // better than rand()
        $unique = $id . $number;
        // call the same function if the barcode exists already
        if (DB::table($table)->where($field, $unique)->exists()) {
            return uniqueIdGenerator($table, $field, $id);
        }

        // otherwise, it's valid and can be used
        return $unique;
    }
}
