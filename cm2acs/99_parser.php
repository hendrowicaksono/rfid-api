<?php
/*
Hendro Wicaksono

SC Status
The SC status message sends SC status to the ACS. It requires an ACS 
Status Response message reply from the ACS. This message will be the 
first message sent by the SC to the ACS once a connection has been 
established (exception: the Login Message may be sent first to login to 
an ACS server program). The ACS will respond with a message that 
establishes some of the rules to be followed by the SC and establishes 
some parameters needed for further communication.
99<status code><max print width><protocol version>

Field               ID  Format
status code             1-char, fixed-length required field: 0 or 1 or 2
max print width         3-char, fixed-length required field
protocol version        4-char, fixed-length required field: x.xx

*/

function get_99_values ($q)
{
    $scid = '99';
    $title = 'SC Status';
    $status_code = substr ($q, 2, 1);
    $max_print_width = substr ($q, 3, 3);
    $protocol_version = substr ($q, 6, 4);

    $result = array (
        'scid' => $scid,
        'title' => $title,
        'status_code' => $status_code,
        'max_print_width' => $max_print_width,
        'protocol_version' => $protocol_version
    );
    return $result;
}

# Testing
include_once 'tools.inc.php';

$q99 = '9912345.p4';
if (preg_match("/^99/i", $q99)) {
    $values_99 = get_99_values ($q99);
    foreach ($values_99 as $key => $value) {
        echo $key.' --> '.$value."\n";
    }
}
