<?php
/*
Hendro Wicaksono

Block Patron
This message requests that the patron card be blocked by the ACS. This 
is, for example, sent when the patron is detected tampering with the SC 
or when a patron forgets to take their card. The ACS should invalidate 
the patron’s card and respond with a Patron Status Response message. The
ACS could also notify the library staff that the card has been blocked.
01<card retained><transaction date><institution id><blocked card msg><patron
identifier><terminal password>

Field               ID  Format
card retained           1-char, fixed-length required field: Y or N.
transaction date        18-char, fixed-length required field: YYYYMMDDZZZZHHMMSS
institution id      AO  variable-length required field
blocked card msg    AL  variable-length required field
patron identifier   AA  variable-length required field
terminal password   AC  variable-length required field

*/

function get_01_values ($q)
{
    $scid = '01';
    $title = 'Block Patron';
    $card_retained = substr ($q, 2, 1);
    $transaction_date = substr ($q, 3, 18);
    $institution_id = get_between ($q, 'AO', 'AL');
    $blocked_card_message = get_between ($q, 'AL', 'AA');
    $patron_identifier = get_between ($q, 'AA', 'AC');
    $terminal_password = get_between ($q, 'AC');
    
    $result = array (
        'scid' => $scid,
        'title' => $title,
        'card_retained' => $card_retained,
        'transaction_date' => $transaction_date,
        'institution_id' => $institution_id,
        'blocked_card_message' => $blocked_card_message,
        'patron_identifier' => $patron_identifier,
        'terminal_password' => $terminal_password
    );
    return $result;
}

# Testing
#include_once 'tools.inc.php';

#$q01 = '01YYYYYMMDDZZZZHHMMSSAOKemdikbudALMember ini bermasalahAA0792130162ACTerminalpasswd';
#if (preg_match("/^01/i", $q01)) {
#    $values_01 = get_01_values ($q01);
#    foreach ($values_01 as $key => $value) {
#        echo $key.' --> '.$value."\n";
#    }
#}
