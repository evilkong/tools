<?php
/**
 * 校验email
$email = "blog@koonk.com";
$check = is_validemail($email);
echo $check;
// If the output is 1, then email is valid.
 */

function is_email($email)
{
    $check = 0;
    if(filter_var($email,FILTER_VALIDATE_EMAIL))
    {
        $check = 1;
    }
    return $check;
}