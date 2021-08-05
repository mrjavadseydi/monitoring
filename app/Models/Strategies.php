<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Strategies extends Model
{
    protected $fillable =['category_id','name','description','goal_id'];
}
