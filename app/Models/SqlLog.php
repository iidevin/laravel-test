<?php

namespace App\Models;

use App\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SqlLog extends Model
{
    use HasFactory, DefaultDatetimeFormat;

    protected $guarded = [];
}
