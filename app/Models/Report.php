<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use \Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Material;
use App\Models\DevicesInventory;
use App\Models\User;
use App\Models\Status;
use App\Models\Alert;

class Report extends Eloquent {


    protected $table = 'reports';
    protected $fillable = [
        'user_id ', 'alert_id', 'status_id',
        'device_id', 'assign_id', 'description', 'completed'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function alert() {
        return $this->belongsTo(Alert::class);
    }
    public function materials() {
        return $this->HasMany(Material::class);
    }
    public function workorder()
    {
        return $this->hasOne('App\Models\WorkOrder');
    }

     public function status() {
        return $this->belongsTo(Status::class);
    }
/*
    public function device() {
        return $this->hasOne(DevicesInventory::class);
    }

    public function assign() {
        return $this->hasOne(User::class, 'id', 'assign_id');
    }

    public function materials() {
        return $this->hasMany(Material::class);
    }
*/
}
