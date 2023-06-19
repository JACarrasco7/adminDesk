<?php

namespace App\Helpers;

use App\Models\User;

class Helpers
{
    public static function getIsConnected($id)
    {
        return User::find($id)->connected;
    }
}
