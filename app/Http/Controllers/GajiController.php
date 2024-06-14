<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    function viewPegawai()
    {
        $data['title'] = "Lihat gaji";
        // dd($data['status']);
        $data['gaji'] = DB::table('gaji')->where('id', 3)->first();
        $data['users'] = DB::table('users')->where('id', Auth::user()->id)->first();
        $absen = DB::table('absensi')->where('id_user', Auth::user()->id)->where('tanggal', 'like', '%' . date('Y-m') . '%')->where('status', 'OUT')->count();
        $gaji = DB::table('gaji')->where('id', 3)->first();

        // $data['absen'] = $absen;
        $data['gajiperjam'] = $gaji->nominal;
        $data['hasilGaji'] = $absen * $gaji->nominal;

        $month = [];
        $no = [];
        for ($m = 1; $m <= 12; $m++) {
            $month[] = date('F', mktime(0, 0, 0, $m, 1, date('Y')));
            $no[] = $m;
        }
        // dd($no);
        $data['month'] = $month;
        $data['no'] = $no;



        // dd($data);
        return view('backend.gaji.hasilGaji', $data);
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
