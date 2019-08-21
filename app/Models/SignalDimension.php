<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class SignalDimension
 * 
 * @property int $id
 * @property string $value
 * @property string $value_fn
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $vertical_signals
 *
 * @package App\Models
 */
class SignalDimension extends Eloquent
{
    use SoftDeletes;

	protected $fillable = [
		'value',
		'value_fn'
	];

	public function vertical_signals()
	{
		return $this->hasMany(SignalInventory::class, 'dimension_id');
	}
}
