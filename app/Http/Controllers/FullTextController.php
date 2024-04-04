<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FullTextController extends Controller
{
    public function show(Request $request)
    {
        $data = $request->query('data');
        return view('fulltext', ['data' => $data]);
    }

}
