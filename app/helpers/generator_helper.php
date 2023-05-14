<?php

//Generate a random string for the initial password
function generatePassword()
{
    $length = 8;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, $charactersLength - 1)];
    }

    return $password;
}


//Generate and return a random verification code
function generateVerificationCode()
{
    $length = 6;
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $verificationCode = '';
    for ($i = 0; $i < $length; $i++) {
        $verificationCode .= $characters[rand(0, $charactersLength - 1)];
    }

    return $verificationCode;
}

function generateRefCode()
{
    $length = 4;
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $verificationCode = '';
    for ($i = 0; $i < $length; $i++) {
        $verificationCode .= $characters[rand(0, $charactersLength - 1)];
    }

    return $verificationCode;
}
