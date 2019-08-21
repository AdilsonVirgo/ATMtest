<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use \Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TrafficDevice
 * 
 * @property int $id
 * @property int $user_id
 * @property int $traffictensor_id
 * @property int $trafficpole_id
 * @property int $regulatorbox_id
 * @property int $device_id
 * @property string $code
 * @property string $status
 * @property string $brand
 * @property string $model
 * @property string $comment
 * @property string $picture
 * @property string $erp_code
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \App\Models\DeviceInventory $devices_inventory
 * @property \App\Models\RegulatorBox $regulator_box
 * @property \App\Models\TrafficPole $traffic_pole
 * @property \App\Models\TrafficTensor $traffic_tensor
 * @property \App\Models\User $user
 * @property \Illuminate\Database\Eloquent\Collection $traffic_lights
 *
 * @package App\Models
 */
class TrafficDevice extends Eloquent
{
	use SoftDeletes;

	protected $table = 'devices_inventory';

	protected $casts = [
		'user_id' => 'int',
		'traffictensor_id' => 'int',
		'trafficpole_id' => 'int',
		'regulatorbox_id' => 'int',
		'device_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'traffictensor_id',
		'trafficpole_id',
		'regulatorbox_id',
		'device_id',
		'code',
		'status',
		'brand',
		'model',
		'comment',
		'picture',
		'erp_code'
	];

	public function devices_inventory()
	{
		return $this->belongsTo(\App\Models\DeviceInventory::class, 'device_id');
	}

	public function regulator_box()
	{
		return $this->belongsTo(\App\Models\RegulatorBox::class, 'regulatorbox_id');
	}

	public function traffic_pole()
	{
		return $this->belongsTo(\App\Models\TrafficPole::class, 'trafficpole_id');
	}

	public function traffic_tensor()
	{
		return $this->belongsTo(\App\Models\TrafficTensor::class, 'traffictensor_id');
	}

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class);
	}

	public function traffic_lights()
	{
		return $this->hasMany(\App\Models\TrafficLight::class, 'tlight_type_id');
	}
}
