<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ImportStudents;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class StudentsController extends Controller
{
    function view()
    {
        $data['title'] = "Students";
        return view('backend.students.view', $data);
    }
    public function load_data()
    {
        $data = DB::table('students')->orderBy('hasil', 'desc')->get();
        echo json_encode($data);
    }
    function UploadStudents(Request $request) {
        // dd($request->all());

       Excel::import(new ImportStudents, $request->file('file'));

        return redirect()->back();
    }
    function proses() {
        $getData = DB::table('students')->get();
        $getMembaca = DB::table('students')->orderBy('membaca', 'desc')->first();
        $getMenulis = DB::table('students')->orderBy('menulis', 'desc')->first();
        $getBerhitung = DB::table('students')->orderBy('berhitung', 'desc')->first();
        $getBtq = DB::table('students')->orderBy('btq', 'desc')->first();
        $getSpd = DB::table('students')->orderBy('spd', 'desc')->first();
        $getInterview = DB::table('students')->orderBy('interview', 'desc')->first();
        // dd($getData);
        $kriteria = DB::table('kriteria')->get();
        foreach ($getData as $gd) {
            $CounSum = ((($gd->membaca / $getMembaca->membaca) * $kriteria[0]->nilai) + (($gd->menulis / $getMenulis->membaca) * $kriteria[1]->nilai)
                + (($gd->berhitung / $getBerhitung->berhitung) * $kriteria[2]->nilai) + (($gd->btq / $getBtq->btq) * $kriteria[3]->nilai) 
                + (($gd->spd / $getSpd->spd) * $kriteria[4]->nilai) + (($gd->interview / $getInterview->interview) * $kriteria[5]->nilai));
            DB::table('students')->where('id', $gd->id)->update(['hasil' => $CounSum]);
        }
        return response()->json([
            'success' => true
        ]);
    }
    function delete()
    {
        DB::table('students')->delete();
        return response()->json([
            'success' => true
        ]);
    }
}
