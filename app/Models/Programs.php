<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Programs extends Model
{
    protected $fillable = [
        "strategy",
        "category",
        "strategies_id",
        "row",
        "name",
        "dead_line",
        "description",
        "rcancel",
        "plan_id",
        "shortcut",
        "done",
        "ideal",
    ];
}
