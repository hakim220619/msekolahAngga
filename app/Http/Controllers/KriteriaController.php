<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KriteriaController extends Controller
{
    function view()
    {
        $data['title'] = "Kriteria";
        $data['kriteria'] = DB::table('kriteria')->get();
        return view('backend.kriteria.view', $data);
    }
}
