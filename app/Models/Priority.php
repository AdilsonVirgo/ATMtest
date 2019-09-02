<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Alert;

class Priority extends Model {

    protected $table = 'priorities';
    protected $fillable = ['name', 'description'];

    public function alert() {
        return $this->hasOne(Alert::class);
    }

}
