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
        $data['absensi'] = DB::select("select a.*, u.full_name from absensi a, users u where a.id_user=u.id and a.status != 'CUTI' and a.id_user = '" . Auth::user()->id . "'");
        return view('backend.absensi.view', $data);
    }
    function cuti()
    {
        $data['title'] = "Cuti";
        // dd($data['status']);
        $data['absensi'] = DB::select("select a.*, u.full_name from absensi a, users u where a.id_user=u.id and a.status = 'CUTI' and a.id_user = '" . Auth::user()->id . "'");
        return view('backend.absensi.cuti', $data);
    }
    function cutiAdmin()
    {
        $data['title'] = "Cuti Admin";
        // dd($data['status']);
        $data['cuti'] = DB::select("select a.*, u.full_name from absensi a, users u where a.id_user=u.id and a.status = 'CUTI'");
        return view('backend.absensi.cutiAdmin', $data);
    }
    function prosesAcc($id)
    {
        // dd($id);
        DB::table('absensi')->where('id', $id)->update([
            'cuti' => 'DITERIMA'
        ]);
        return response()->json([
            'success' => true,
        ]);
    }
    function addProses(Request $request)
    {
        $chekAbsensi = DB::table('absensi')->where('tanggal', $request->tanggal)->where('status', $request->status)->first();
        if ($chekAbsensi == null) {
            if ($request->status == 'CUTI') {
                $data = [
                    'id_user' => Auth::user()->id,
                    'status' => $request->status,
                    'tanggal' => $request->tanggal,
                    'cuti' => 'PENDING',
                    'created_at' => now(),
                ];
            } else {
                $data = [
                    'id_user' => Auth::user()->id,
                    'status' => $request->status,
                    'tanggal' => $request->tanggal,
                    'created_at' => now(),
                ];
            }
            DB::table('absensi')->insert($data);
            Alert::success('Absen berhasilll.');
            return redirect()->back();
        } else {
            Alert::warning('Sudah Pernah absen untuk hari ini.');
            return redirect()->back();
        }
    }
}
