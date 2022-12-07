<?php


namespace App\Helper;


class ValidationRules
{
    static $LOGIN = [
        'phone' => 'required|max:16',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8',
        'username' => 'required',
    ];

    static $LOGIN_MESSAGE = [];

    static $SECS = [
        'name' => 'required',
        'start' => 'required|number',
        'end' => 'required|number',
    ];
}
