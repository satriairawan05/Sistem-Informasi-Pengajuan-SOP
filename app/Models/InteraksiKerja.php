<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InteraksiKerja extends Model
{
    use HasFactory;

    protected $table = 'interaksi_kerjas';

    protected $primaryKey = 'ik_id';
}
