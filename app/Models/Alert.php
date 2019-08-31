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
    use SoftDeletes;


    protected $table = 'alerts';
    protected $fillable = ['place', 'user_id', 'priority_id', 'status_id', 'motive_id', 'description','device_id','completed'];
    protected $casts = ['user_id' => 'int', 'priority_id' => 'int', 'status_id' => 'int', 'motive_id' => 'int'];
/*  $table->String('place');
            $table->unsignedBigInteger('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('priority_id')->references('id')->on('priority');
            $table->unsignedBigInteger('status_id')->references('id')->on('status');
            $table->unsignedBigInteger('motive_id')->references('id')->on('motive');
            $table->text('description');            
            $table->unsignedBigInteger('device_id')->nullable();
            $table->boolean('completed')->default(false);*/
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function priority() {
        return $this->hasOne(Priority::class);
    }

    public function status() {
        return $this->hasOne(Status::class);
    }

    public function motive() {
        return $this->hasOne(Motive::class);
    }
    
    public function report() {
        return $this->hasOne(Report::class);
    }

}
