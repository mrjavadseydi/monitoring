<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actions extends Model
{
    protected $fillable = ['plan_id','program_id','name','description','done','dead_line','delivery','user_id','manager_id','admin_id','obst','repeat','repeat_count','repeat_done'];

//
//    public function uploads(){
//        return $this->belongsToMany('app/Uploads');
//    }
}
