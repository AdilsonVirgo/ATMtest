<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use \Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Priority;
use App\Models\Status;
use App\Models\Motive;


class Alert extends Eloquent
{
    protected $table = 'alerts';
    protected $fillable = ['place', 'user_id', 'priority_id', 'status_id', 'motive_id', 'description','device_id','completed'];
    protected $casts = ['user_id' => 'int', 'priority_id' => 'int', 'status_id' => 'int', 'motive_id' => 'int'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function priority() {
         return $this->belongsTo(Priority::class);
    }

    public function status() {
        return $this->belongsTo(Status::class);
    }

    public function motive() {
         return $this->belongsTo(Motive::class);
    }
    
    public function report() {
        return $this->hasOne(Report::class);
    }

}
