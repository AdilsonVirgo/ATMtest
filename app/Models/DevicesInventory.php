<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * Class DevicesInventory
 * 
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $symbol
 * @property string $dimensions
 * @property string $erp_code
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $traffic_devices
 *
 * @package App\Models
 */
class DevicesInventory extends Eloquent
{
	use SoftDeletes;
	protected $table = 'devices_inventory';

	protected $fillable = [
		'code',
		'name',
		'symbol',
		'brand',
		'dimensions',
		'options',
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
                'dimensions' => 'max:50',
                'name' => 'required|min:3|max:100',
                'symbol' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240'
            ],
            $merge);
    }

	public function traffic_devices()
	{
		return $this->hasMany(\App\Models\TrafficDevice::class, 'device_id');
	}
}
