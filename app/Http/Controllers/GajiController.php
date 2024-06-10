<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class GajiController extends Controller
{
    function view()
    {
        $data['title'] = "Setting gaji";
        // dd($data['status']);
        $data['gaji'] = DB::select("select * from gaji");
        return view('backend.gaji.view', $data);
    }
    function addProses(Request $request)
    {
        $chekGaji = DB::table('gaji')->where('jenis_gaji', $request->jenis_gaji)->first();
        if ($chekGaji == null) {
            $data = [
                'jenis_gaji' => $request->jenis_gaji,
                'nominal' => $request->nominal,
                'keterangan' => $request->keterangan,
                'created_at' => now(),
            ];
            DB::table('gaji')->insert($data);
            Alert::success('Gaji berhasilll Ditambah.');
            return redirect()->back();
        } else {
            Alert::warning('Sudah Pernah Menambahkan Jenis gaji.');
            return redirect()->back();
        }
        
    }
}
