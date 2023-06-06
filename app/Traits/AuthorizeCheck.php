<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth as FacadesAuth;

trait AuthorizeCheck
{

    public function authorizeCheck($permission)
    {
        if (FacadesAuth::user()->can($permission)) {
            return response("Only admins");
        };
    }
}
