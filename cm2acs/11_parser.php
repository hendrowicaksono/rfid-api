<?php
/*
Hendro Wicaksono

This message is used by the SC to request to check out an item, and also
to cancel a Checkin request that did not successfully complete. The ACS 
must respond to this command with a Checkout Response message.
11<SC renewal policy><no block><transaction date><nb due date><institution id><patron
identifier><item identifier><terminal password><patron password><item properties><fee
acknowledged><cancel>
Field               ID  Format
SC renewal policy       1-char, fixed-length required field: Y or N.
no block                1-char, fixed-length required field: Y or N.
transaction date        18-char, fixed-length required field: YYYYMMDDZZZZHHMMSS. The date
                        and time that the patron checked out the item at the SC unit.
nb due date             18-char, fixed-length required field: YYYYMMDDZZZZHHMMSS
institution id      AO  variable-length required field
patron identifier   AA  variable-length required field
item identifier     AB  variable-length required field
terminal password   AC  variable-length required field
item properties     CH  variable-length required field
patron password     AD  variable-length required field
fee acknowledged    BO  1-char, optional field: Y or N
cancel              BI  1-char, optional field: Y or N

*/

function get_11_values ($q)
{
    $scid = '11';
    $title = 'Checkout';
    $sc_renewal_policy = substr ($q, 2, 1);
    $no_block = substr ($q, 3, 1);
    $transaction_date = substr ($q, 4, 18);
    $nb_due_date = substr ($q, 22, 18);
    $institution_id = get_between ($q, 'AO', 'AA');
    $patron_identifier = get_between ($q, 'AA', 'AB');
    $item_identifier = get_between ($q, 'AB', 'AC');
    $terminal_password = get_between ($q, 'AC', 'AD');
    $patron_password = get_between ($q, 'AD', 'CH');
    $item_properties = get_between ($q, 'CH', 'BO');
    $fee_acknowledged = get_between ($q, 'BO', 'BI');
    $cancel = get_between ($q, 'BI');

    $result = array (
        'scid' => $scid,
        'title' => $title,
        'sc_renewal_policy' => $sc_renewal_policy,
        'no_block' => $no_block,
        'transaction_date' => $transaction_date,
        'nb_due_date' => $nb_due_date,
        'institution_id' => $institution_id,
        'patron_identifier' => $patron_identifier,
        'item_identifier' => $item_identifier,
        'terminal_password' => $terminal_password,
        'patron_password' => $patron_password,
        'item_properties' => $item_properties,
        'fee_acknowledged' => $fee_acknowledged,
        'cancel' => $cancel
    );
    return $result;
}

# Testing
include_once 'tools.inc.php';

$q11 = '11YNYYYYMMDDZZZZHHMMSSYYYYMMDDZZZZHHMMSSAOKemdikbudAA0792130162ABB1234567890ACterminalpasswdADpatronpasswdCHitempropertieshereBOYBIN';
if (preg_match("/^11/i", $q11)) {
    $values_11 = get_11_values ($q11);
    foreach ($values_11 as $key => $value) {
        echo $key.' --> '.$value."\n";
    }
}
