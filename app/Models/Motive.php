<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Alert;

class Motive extends Model
{
    protected $table = 'motives';

    protected $fillable = ['name','description'];

    public function alert()
    {
        return $this->belongsTo(Alert::class);
    }
}
