<?php

namespace App\Imports;

use App\Models\StudentsModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;



class ImportStudents implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // dd($row);
        $membaca = 0;
        if ($row['membaca'] <= 50) {
            $membaca = 0.5;
        } elseif (in_array($row['membaca'], range(50, 60))) {
            $membaca = 0.6;
        } elseif (in_array($row['membaca'], range(60, 70))) {
            $membaca = 0.7;
        } elseif (in_array($row['membaca'], range(70, 80))) {
            $membaca = 0.8;
        } elseif (in_array($row['membaca'], range(80, 90))) {
            $membaca = 0.9;
        } elseif (in_array($row['membaca'], range(90, 100))) {
            $membaca = 1;
        }

        $menulis = 0;
        if ($row['menulis'] <= 50) {
            $menulis = 0.5;
        } elseif (in_array($row['menulis'], range(50, 60))) {
            $menulis = 0.6;
        } elseif (in_array($row['menulis'], range(60, 70))) {
            $menulis = 0.7;
        } elseif (in_array($row['menulis'], range(70, 80))) {
            $menulis = 0.8;
        } elseif (in_array($row['menulis'], range(80, 90))) {
            $menulis = 0.9;
        } elseif (in_array($row['menulis'], range(90, 100))) {
            $menulis = 1;
        }

        $berhitung = 0;
        if ($row['berhitung'] <= 50) {
            $berhitung = 0.5;
        } elseif (in_array($row['berhitung'], range(50, 60))) {
            $berhitung = 0.6;
        } elseif (in_array($row['berhitung'], range(60, 70))) {
            $berhitung = 0.7;
        } elseif (in_array($row['berhitung'], range(70, 80))) {
            $berhitung = 0.8;
        } elseif (in_array($row['berhitung'], range(80, 90))) {
            $berhitung = 0.9;
        } elseif (in_array($row['berhitung'], range(90, 100))) {
            $berhitung = 1;
        }
        

        $btq = 0;
        if ($row['btq'] <= 60) {
            $btq = 0.6;
        } elseif (in_array($row['btq'], range(60, 80))) {
            $btq = 0.8;
        } elseif (in_array($row['btq'], range(80, 100))) {
            $btq = 1;
        } 

        $spd = 0;
        if ($row['spd'] <= 60) {
            $spd = 0.6;
        } elseif (in_array($row['spd'], range(60, 70))) {
            $spd = 0.6;
        } elseif (in_array($row['spd'], range(70, 80))) {
            $spd = 0.7;
        } elseif (in_array($row['spd'], range(80, 90))) {
            $spd = 0.8;
        } elseif (in_array($row['spd'], range(90, 100))) {
            $spd = 0.9;
        } 

        $interview = 0;
        if ($row['interview'] <= 60) {
            $interview = 0.6;
        } elseif (in_array($row['interview'], range(60, 80))) {
            $interview = 0.8;
        } elseif (in_array($row['interview'], range(80, 100))) {
            $interview = 1;
        } 


        $hasil = 0;
        return new StudentsModel([
            // dd($nis),
            'nis' => $row['nis'],
            'full_name' => $row['full_name'],
            'membaca' => $membaca,
            'menulis' => $menulis,
            'berhitung' => $berhitung,
            'btq' => $btq,
            'spd' => $spd,
            'interview' => $interview,
            'hasil' => $hasil,
        ]);
    }
}
