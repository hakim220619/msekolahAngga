<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentsModel extends Model
{
    use HasFactory;
    protected $table = "students";
 
    protected $fillable = ['nis','full_name','membaca','menulis','berhitung','btq', 'spd', 'interview', 'hasil'];
}
