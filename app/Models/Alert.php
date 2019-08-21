<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use \Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;


class Alert extends Eloquent
{
    use SoftDeletes;

    protected $table = 'alerts';

	protected $casts = [
		'user_id' => 'int',
		'latitude' => 'float',
		'longitude' => 'float'
	];

	protected $fillable = [
		'user_id',
		'state',
		'latitude',
		'longitude',
		'google_address',
		'filename',
		'mime',
		'original_filename',
		'description'
	];
    
	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
