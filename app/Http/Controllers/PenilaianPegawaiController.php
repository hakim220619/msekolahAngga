<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenilaianPegawaiController extends Controller
{
    function view()
    {
        $data['title'] = "Penilaian Pegawai";
        $data['users'] = DB::table('users')->where('role', 2)->get();
        return view('backend.penilaian.view', $data);
    }
    function performaPegawai()
    {
        $data['title'] = "Performa Pegawai";
       
        $data['tahun'] = DB::table('penilaian_guru')->select('tahun')->where('id_user', Auth::user()->id)->distinct('tahun')->get();
        // dd($data);
        // $data['hasilNilai'] = number_format($nilai / $penilaian_guru);
        // dd($data);
        return view('backend.penilaian.performaPegawai', $data);
    }
    function load_data(Request $request)
    {
        $data = DB::table('penilaian_guru')->where('id_user', $request->id_user)->where('tahun', $request->tahun)->get();
        echo json_encode($data);
    }
    public function penilaianView(Request $request)
    {
        $data['title'] = "Penilaian";
        $data['id'] = $request->id;
        $data['pertanyaan'] = DB::table('pertanyaan')->where('status', 'ON')->where('tahun', date('Y'))->get();
        return view('backend.penilaian.pertanyaan', $data);
    }
    public function addProses(Request $request)
    {
        $cekPenilaian = DB::table('penilaian_guru')->where('id_user', $request->id_user)->where('id_pertanyaan', $request->id_pertanyaan)->where('tahun', $request->tahun)->first();
        if ($cekPenilaian == null) {
            $data = [
                'id_user' => $request->id_user,
                'id_pertanyaan' => $request->id_pertanyaan,
                'tahun' => $request->tahun,
                'nilai' => $request->nilai,
                'created_at' => now()
            ];
            DB::table('penilaian_guru')->insert($data);
            return response()->json([
                'success' => true
            ]);
        } else {
            $data = [
                'id_user' => $request->id_user,
                'id_pertanyaan' => $request->id_pertanyaan,
                'tahun' => $request->tahun,
                'nilai' => $request->nilai,
                'created_at' => now()
            ];
            DB::table('penilaian_guru')->where('id', $cekPenilaian->id)->update($data);
            return response()->json([
                'success' => true
            ]);
        }
    }
}
