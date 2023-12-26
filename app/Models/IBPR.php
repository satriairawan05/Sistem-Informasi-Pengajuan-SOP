<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IBPR extends Model
{
    use HasFactory;

    protected $table = 'ibprs';

    protected $primaryKey = 'ibpr_id';
}
