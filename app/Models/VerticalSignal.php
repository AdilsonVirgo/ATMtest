<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class SignalsInventory
 * 
 * @property int $id
 * @property int $user_id
 * @property int $signal_id
 * @property float $latitude
 * @property float $longitude
 * @property string $picture
 * @property string $comment
 * @property string $orientation
 * @property string $google_address
 * @property string $street1
 * @property string $street2
 * @property string $neighborhood
 * @property string $state
 * @property string $normative
 * @property string $fastener
 * @property string $material
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\SignalInventory $vertical_signal
 * @property \App\Models\User $user
 *
 * @package App\Models
 */
class VerticalSignal extends Eloquent
{
    use SoftDeletes;

    protected $table = 'vertical_signals';

	protected $casts = [
		'user_id' => 'int',
		'signal_id' => 'int',
		'latitude' => 'float',
		'longitude' => 'float'
	];

	protected $fillable = [
		'user_id',
		'signal_id',
        'code',
		'latitude',
		'longitude',
		'picture',
		'comment',
		'orientation',
		'google_address',
		'street1',
		'street2',
		'neighborhood',
		'parish',
		'state',
		'normative',
		'fastener',
		'material',
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
                'inventory' => 'required',
                'orientation' => 'required',
                'state' => 'required',
                'normative' => 'required',
                'fastener' => 'required',
                'material' => 'required',
                //'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240'
                'picture_data' => 'required'
            ],
            $merge);
    }

	public function signal_inventory()
	{
		return $this->belongsTo(SignalInventory::class, 'signal_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
