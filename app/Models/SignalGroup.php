<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class SignalGroup
 * 
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $signal_subgroups
 *
 * @package App\Models
 */
class SignalGroup extends Eloquent
{
    use SoftDeletes;

	protected $fillable = [
		'code',
		'name',
		'description'
	];

	public function signal_subgroups()
	{
		return $this->hasMany(\App\Models\SignalSubgroup::class, 'group_id');
	}
}
