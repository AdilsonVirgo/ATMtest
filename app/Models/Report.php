<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'reports';
    
    protected $fillable = [
            'user_id',
            'alert_id',
            'status_id',
            'device_id',
            'assign_id',
            'material_id',
            'description',
            'completed',
    ];
    
    public function alert()
    {
        return $this->belongsTo(Alert::class);
    }
    
    public function workorder()
    {
        return $this->hasOne('App\Models\WorkOrder');
    }
    
}
