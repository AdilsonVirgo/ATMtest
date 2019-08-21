<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use \Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TrafficTensor
 * 
 * @property int $id
 * @property int $user_id
 * @property string $status
 * @property float $height
 * @property string $material
 * @property string $comment
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \App\Models\User $user
 * @property \Illuminate\Database\Eloquent\Collection $pole_tensors
 * @property \Illuminate\Database\Eloquent\Collection $traffic_devices
 * @property \Illuminate\Database\Eloquent\Collection $traffic_lights
 *
 * @package App\Models
 */
class TrafficTensor extends Eloquent
{
	use SoftDeletes;

	protected $casts = [
		'user_id' => 'int',
		'height' => 'float'
	];

	protected $fillable = [
		'user_id',
		'state',
		'height',
		'material',
		'comment'
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
                'poles' => 'required|array|min:1',
                'state' => 'required|max:50',
                'height' => 'required|numeric',
                'material' => 'required',
            ],
            $merge);
    }

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class);
	}

	public function intersection()
    {
        if ($this->poles->count()) {
            return $this->poles->first()->intersection;
        }

        return null;
    }

	public function poles()
	{
		return $this->belongsToMany(TrafficPole::class, 'pole_tensor', 'tensor_id', 'pole_id')->withTimestamps();
	}

	public function traffic_devices()
	{
		return $this->hasMany(\App\Models\TrafficDevice::class, 'traffictensor_id');
	}

	public function traffic_lights()
	{
		return $this->hasMany(\App\Models\TrafficLight::class);
	}
}
