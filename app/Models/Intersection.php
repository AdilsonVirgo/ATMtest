<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class Intersection
 * 
 * @property int $id
 * @property string $main_st
 * @property string $cross_st
 * @property float $latitude
 * @property float $longitude
 * @property string $reference
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class Intersection extends Eloquent
{
    use SoftDeletes;

	protected $casts = [
		'latitude' => 'float',
		'longitude' => 'float'
	];

	protected $fillable = [
		'main_st',
		'cross_st',
		'latitude',
		'longitude',
		'google_address',
		'comment'
	];

    public static function rules($merge = [])
    {
        return array_merge(
            [
                'latitude'   => 'required|numeric',
                'longitude'  => 'required|numeric',
                'google_address' => 'required',
            ],
            $merge);
    }

    public function regulators()
    {
        return $this->hasMany(RegulatorBox::class, 'intersection_id');
    }

    public function lights()
    {
        return $this->hasMany(TrafficLight::class, 'intersection_id');
    }

    public function poles()
    {
        return $this->hasMany(TrafficLight::class, 'intersection_id');
    }
}
