<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class SignalVariation
 * 
 * @property int $id
 * @property int $signal_id
 * @property string $variation
 * @property int $dimension_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\SignalDimension $signal_dimension
 * @property \App\Models\SignalInventory $signals_inventory
 *
 * @package App\Models
 */
class SignalVariation extends Eloquent
{
    use SoftDeletes;

    protected $table = 'signal_variations';

	protected $casts = [
		'signal_id' => 'int',
		'dimension_id' => 'int'
	];

	protected $fillable = [
		'signal_id',
		'variation',
		'dimension_id'
	];

	public function signal_dimension()
	{
		return $this->belongsTo(\App\Models\SignalDimension::class, 'dimension_id');
	}

	public function signals_inventory()
	{
		return $this->belongsTo(\App\Models\SignalInventory::class, 'signal_id');
	}
}
