<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CsrfTokenController extends Controller
{
    public function showCsrfToken(Request $request)
    {
        $csrfToken = csrf_token();

        return response()->json(['token' => $csrfToken]);
    }
}