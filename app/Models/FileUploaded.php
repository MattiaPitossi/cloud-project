<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileUploaded extends Model
{
    use HasFactory;
    protected $table = 'file_uploaded';

    protected $fillable = ['id','name','size','user_id'];
}
