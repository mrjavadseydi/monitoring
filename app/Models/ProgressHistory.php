<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressHistory extends Model
{
    use HasFactory;
    protected $fillable = ["program_id", "user_id", "before", "after"];
}
