<?php
/*
Hendro Wicaksono

Patron Status Request
This message is used by the SC to request patron information from the 
ACS. The ACS must respond to
this command with a Patron Status Response message.
23<language><transaction date><institution id><patron identifier><terminal password><patron password>
Field               ID  Format
language                3-char, fixed-length required field
transaction date        18-char, fixed-length required field: YYYYMMDDZZZZHHMMSS
institution id      AO  variable-length required field
patron identifier   AA  variable-length required field
terminal password   AC  variable-length required field
patron password     AD  variable-length required field
*/

function get_23_values ($q)
{
    $scid = '23';
    $title = 'Patron Status Request';
    $language = substr ($q, 2, 3);
    $transaction_date = substr ($q, 5, 18);
    $institution_id = get_between ($q, 'AO', 'AA');
    $patron_identifier = get_between ($q, 'AA', 'AC');
    $terminal_password = get_between ($q, 'AC', 'AD');
    $patron_password = get_between ($q, 'AD');
    $result = array (
        'scid' => $scid,
        'title' => $title,
        'language' => $language,
        'transaction_date' => $transaction_date,
        'institution_id' => $institution_id,
        'patron_identifier' => $patron_identifier,
        'terminal_password' => $terminal_password,
        'patron_password' => $patron_password
    );
    return $result;
}

# Testing
include_once 'tools.inc.php';
$q23 = '23indYYYYMMDDZZZZHHMMSSAOKemdikbudAA0792130162ACtermpasswdADpatronpasswd';
if (preg_match("/^23/i", $q23)) {
    $values_23 = get_23_values ($q23);
    foreach ($values_23 as $key => $value) {
        echo $key.' --> '.$value."\n";
    }
}

