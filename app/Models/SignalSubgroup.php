<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class SignalSubgroup
 * 
 * @property int $id
 * @property int $group_id
 * @property string $code
 * @property string $name
 * @property string $shape
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\SignalGroup $signal_group
 * @property \Illuminate\Database\Eloquent\Collection $signal_colors
 * @property \Illuminate\Database\Eloquent\Collection $vertical_signals
 *
 * @package App\Models
 */
class SignalSubgroup extends Eloquent
{
    use SoftDeletes;

	protected $casts = [
		'group_id' => 'int'
	];

	protected $fillable = [
		'group_id',
		'code',
		'name',
		'shape',
		'description'
	];

	public function group()
	{
		return $this->belongsTo(SignalGroup::class, 'group_id');
	}

	public function colors()
	{
		return $this->hasMany(SignalColor::class, 'subgroup_id');
	}

	public function vertical_signals()
	{
		return $this->hasMany(SignalInventory::class, 'subgroup_id');
	}
}
