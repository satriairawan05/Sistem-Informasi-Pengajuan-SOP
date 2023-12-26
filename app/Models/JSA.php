<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JSA extends Model
{
    use HasFactory;

    protected $table = 'jsas';

    protected $primaryKey = 'jsa_id';
}
