<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class AbsensiController extends Controller
{
    function view()
    {
        $data['title'] = "Absensi";
        // dd($data['status']);
        $data['absensi'] = DB::select("select a.*, u.full_name from absensi a, users u where a.id_user=u.id and a.id_user = '" . Auth::user()->id . "'");
        return view('backend.absensi.view', $data);
    }
    function addProses(Request $request)
    {
        $chekAbsensi = DB::table('absensi')->where('tanggal', $request->tanggal)->where('status', $request->status)->first();
        if ($chekAbsensi == null) {
            $data = [
                'id_user' => Auth::user()->id,
                'status' => $request->status,
                'tanggal' => $request->tanggal,
                'created_at' => now(),
            ];
            DB::table('absensi')->insert($data);
            Alert::success('Absen berhasilll.');
            return redirect()->back();
        } else {
            Alert::warning('Sudah Pernah absen untuk hari ini.');
            return redirect()->back();
        }
        
    }
}
