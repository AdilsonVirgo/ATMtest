<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use \Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TrafficPole
 * 
 * @property int $id
 * @property int $user_id
 * @property int $interception_id
 * @property string $code
 * @property string $brand
 * @property string $status
 * @property bool $atm_own
 * @property float $height
 * @property string $material
 * @property float $latitude
 * @property float $longitude
 * @property string $google_address
 * @property string $comment
 * @property string $erp_code
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \App\Models\Intersection $intersection
 * @property \App\Models\User $user
 * @property \Illuminate\Database\Eloquent\Collection $pole_tensors
 * @property \Illuminate\Database\Eloquent\Collection $traffic_devices
 * @property \Illuminate\Database\Eloquent\Collection $traffic_lights
 *
 * @package App\Models
 */
class TrafficPole extends Eloquent
{
	use SoftDeletes;

	protected $casts = [
		'user_id' => 'int',
		'intersection_id' => 'int',
		'atm_own' => 'bool',
		'height' => 'float',
		'latitude' => 'float',
		'longitude' => 'float'
	];

	protected $fillable = [
		'user_id',
		'intersection_id',
		'code',
		'state',
		'atm_own',
		'height',
		'material',
		'latitude',
		'longitude',
		'google_address',
		'comment',
		'erp_code'
	];

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return array
     */
    public static function rules($merge = [])
    {
        return array_merge(
            [
                'code'   => 'required|min:1|max:50|unique:devices_inventory,code',
                'erp_code' => 'max:50',
                'intersection' => 'required',
                'state' => 'required|max:50',
                'height' => 'required|numeric',
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
                'material' => 'required',
            ],
            $merge);
    }

	public function intersection()
	{
		return $this->belongsTo(\App\Models\Intersection::class, 'intersection_id');
	}

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class);
	}

	public function tensors()
	{
		return $this->belongsToMany(TrafficTensor::class, 'pole_tensor', 'pole_id', 'tensor_id')->withTimestamps();
	}

	public function traffic_devices()
	{
		return $this->hasMany(\App\Models\TrafficDevice::class, 'trafficpole_id');
	}

	public function traffic_lights()
	{
		return $this->hasMany(\App\Models\TrafficLight::class, 'pole_id');
	}
}
