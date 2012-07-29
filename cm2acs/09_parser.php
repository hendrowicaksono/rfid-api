<?php
/*
Hendro Wicaksono

Checkin
This message is used by the SC to request to check in an item, and also to cancel a Checkout request that
did not successfully complete. The ACS must respond to this command with a Checkin Response
message.
09<no block><transaction date><return date><current location><institution id><item
identifier><terminal password><item properties><cancel>

Field               ID  Format
no block                1-char, fixed-length required field: Y or N.
transaction date        18-char, fixed-length required field: YYYYMMDDZZZZHHMMSS
return date             18-char, fixed-length required field: YYYYMMDDZZZZHHMMSS
current location    AP  variable-length required field
institution id      AO  variable-length required field
item identifier     AB  variable-length required field
terminal password   AC  variable-length required field
item properties     CH  variable-length required field
cancel              BI  1-char, optional field: Y or N

*/

function get_09_values ($q)
{
    $scid = '09';
    $title = 'Checkin';
    $no_block = substr ($q, 1, 1);
    $transaction_date = substr ($q, 2, 18);
    $return_date = substr ($q, 19, 18);
    $current_location = get_between ($q, 'AP', 'AO');
    $institution_id = get_between ($q, 'AO', 'AB');
    $item_identifier = get_between ($q, 'AB', 'AC');
    $terminal_password = get_between ($q, 'AC', 'CH');
    $item_properties = get_between ($q, 'CH', 'BI');
    $cancel = get_between ($q, 'BI');
    
    $result = array (
        'scid' => $scid,
        'title' => $title,
        'no_block' => $no_block,
        'transaction_date' => $transaction_date,
        'return_date' => $return_date,
        'current_location' => $current_location,
        'institution_id' => $institution_id,
        'item_identifier' => $item_identifier,
        'terminal_password' => $terminal_password,
        'item_properties' => $item_properties,
        'cancel' => $cancel
    );
    return $result;
}

# Testing
include_once 'tools.inc.php';

$q09 = '09YYYYYMMDDZZZZHHMMSSYYYYMMDDZZZZHHMMSSAPPerpustakaan KemdikbudAOKemdikbudABB1234567890ACterminalpasswdCHitempropertieshereBIY';
if (preg_match("/^09/i", $q09)) {
    $values_09 = get_09_values ($q09);
    foreach ($values_09 as $key => $value) {
        echo $key.' --> '.$value."\n";
    }
}
