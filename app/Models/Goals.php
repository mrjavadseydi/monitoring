<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goals extends Model
{
    protected $fillable = ['code','title','description','plan_id'];
}
