<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Alert;

class Status extends Model {

    protected $table = 'statuses';
    protected $fillable = ['name', 'description'];

    public function alert() {
        return $this->hasOne(Alert::class);
    }
    public function report() {
        return $this->hasOne(Report::class);
    }

}
