<?php

function get_between ($q, $m1, $m2='')
{
    $result = explode ($m1, $q);
    $result = $result[1];
    if ($m2 != '') {
        $result = explode ($m2, $result);
        $result = $result[0];
    }
    return $result;
}
