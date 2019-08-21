<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use \Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class RegulatorBox
 * 
 * @property int $id
 * @property int $user_id
 * @property int $interception_id
 * @property string $code
 * @property string $brand
 * @property string $status
 * @property float $latitude
 * @property float $longitude
 * @property string $google_address
 * @property string $picture_in
 * @property string $picture_out
 * @property string $comment
 * @property string $erp_code
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \App\Models\Intersection $intersection
 * @property \App\Models\User $user
 * @property \Illuminate\Database\Eloquent\Collection $traffic_devices
 * @property \Illuminate\Database\Eloquent\Collection $traffic_lights
 *
 * @package App\Models
 */
class RegulatorBox extends Eloquent
{
	use SoftDeletes;

	protected $casts = [
		'user_id' => 'int',
		'intersection_id' => 'int',
		'latitude' => 'float',
		'longitude' => 'float'
	];

	protected $fillable = [
		'user_id',
		'intersection_id',
		'code',
		'brand',
		'state',
		'latitude',
		'longitude',
		'google_address',
		'picture_in',
		'picture_out',
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
                'code'   => 'required|min:3|max:50|unique:vertical_signals,code',
                'latitude'   => 'required|numeric',
                'longitude'  => 'required|numeric',
                'google_address' => 'required',
                'intersection' => 'required|numeric',
                'state' => 'required|max:50',
                //'picture_data_in' => 'required',
                //'picture_data_out' => 'required',
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

	public function traffic_devices()
	{
		return $this->hasMany(\App\Models\TrafficDevice::class, 'regulatorbox_id');
	}

	public function traffic_lights()
	{
		return $this->hasMany(\App\Models\TrafficLight::class, 'regulatorbox_id');
	}
}
