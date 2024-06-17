<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GeneralController extends Controller
{
    public function getGajiById()
    {
        ini_set('max_execution_time', 180);
        // dd(Auth::user()->id);
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
        $pdf = Pdf::loadView('backend.pdf.gaji', $data);
        $filename = Auth::user()->full_name . '_' . date('mhs');
        // dd($filename);
        $pdf->save(public_path("storage/pdf/" . $filename . ".pdf"));
        //    dd($pdf);
        if ($pdf) {
            $response =  array(
                'success'   => true,
                'msg'       => "Download success",
                'file'      => asset('storage/pdf/' . $filename . '.pdf'),
                'file_name' =>  Auth::user()->full_name
            );
            $body = array(
                "api_key" => "50d645dbe85c8431b94b98f085291148d382ff03",
                "receiver" => Auth::user()->phone,
                "data" => array("message" => "Download berhasil selesai.
File: " . asset('storage/pdf/' . $filename . '.pdf') . "")
            );
            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => "https://wa.sppapp.com/api/send-message",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($body),
                CURLOPT_HTTPHEADER => [
                    "Accept: */*",
                    "Content-Type: application/json",
                ],
            ]);
            curl_exec($curl);
            curl_error($curl);
            curl_close($curl);
            return response($response);
        } else {
            return response(array('msg' => 'There is no data to export.'));
        }
    }

    function listAbsensi(Request $request)
    {
        // header('Access-Control-Allow-Origin: *');
        // dd($request->all());
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
            // dd($no);


        }
        $totalAbsen =  DB::table('absensi')->where('id_user', Auth::user()->id)->where('tanggal', 'like', '%2024-10%')->where('status', 'OUT')->count();
        // dd($month);
        foreach ($no as $key => $n) {
            // dd($month[$key]);
            if ($n > 9) {
                $totalAbsen =  DB::table('absensi')->where('id_user', Auth::user()->id)->where('tanggal', 'like', '%' . date('Y-') . '' . $n . '%')->where('status', 'OUT')->count();
                $values[] = array(
                    'nama' => Auth::user()->full_name,
                    'bulan' => $month[$key],
                    'totalAbsen' => $totalAbsen,
                    'tahun' => date('Y')
                );
            } else {

                $totalAbsen = DB::table('absensi')->where('id_user', Auth::user()->id)->where('tanggal', 'like', '%' . date('Y-') . '0' . $n . '%')->where('status', 'OUT')->count();
                // dd($totalAbsen);
                $values[] = array(
                    'nama' => Auth::user()->full_name,
                    'bulan' => $month[$key],
                    'totalAbsen' => $totalAbsen,
                    'tahun' => date('Y')

                );
            }
        }
        // file_put_contents('mydata.json', json_encode($values, JSON_FORCE_OBJECT));
        // dd($values);
        // dd($no);
        $data['month'] = $month;
        $data['no'] = $no;
        return response()->json([
            'success' => true,
            'message' => 'Show Data Success',
            'data' => $values,
        ]);
    }
    function listGaji(Request $request)
    {
        // header('Access-Control-Allow-Origin: *');
        // dd($request->all());
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
            // dd($no);


        }
        $totalAbsen =  DB::table('absensi')->where('id_user', Auth::user()->id)->where('tanggal', 'like', '%2024-10%')->where('status', 'OUT')->count();
        // dd($month);
        foreach ($no as $key => $n) {
            // dd($month[$key]);
            if ($n > 9) {
                $totalAbsen =  DB::table('absensi')->where('id_user', Auth::user()->id)->where('tanggal', 'like', '%' . date('Y-') . '' . $n . '%')->where('status', 'OUT')->count();
                $values[] = array(
                    'nama' => Auth::user()->full_name,
                    'bulan' => $month[$key],
                    'gaji' => $gaji->nominal,
                    'totalAbsen' => $totalAbsen,
                    'totalGaji' => $totalAbsen * $gaji->nominal,
                    'tahun' => date('Y')
                );
            } else {

                $totalAbsen = DB::table('absensi')->where('id_user', Auth::user()->id)->where('tanggal', 'like', '%' . date('Y-') . '0' . $n . '%')->where('status', 'OUT')->count();
                // dd($totalAbsen);
                $values[] = array(
                    'nama' => Auth::user()->full_name,
                    'bulan' => $month[$key],
                    'gaji' => $gaji->nominal,
                    'totalAbsen' => $totalAbsen,
                    'totalGaji' => $totalAbsen * $gaji->nominal,
                    'tahun' => date('Y')
                );
            }
        }
        // file_put_contents('mydata.json', json_encode($values, JSON_FORCE_OBJECT));
        // dd($values);
        // dd($no);
        $data['month'] = $month;
        $data['no'] = $no;
        return response()->json([
            'success' => true,
            'message' => 'Show Data Success',
            'data' => $values,
        ]);
    }
}
