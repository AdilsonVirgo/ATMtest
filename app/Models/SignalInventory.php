<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class VerticalSignal
 * 
 * @property int $id
 * @property int $subgroup_id
 * @property int $dimension_id
 * @property string $code
 * @property string $variation
 * @property string $name
 * @property string $usage
 * @property string $description
 * @property string $picture
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\SignalDimension $signal_dimension
 * @property \App\Models\SignalSubgroup $signal_subgroup
 * @property \Illuminate\Database\Eloquent\Collection $signals_inventories
 *
 * @package App\Models
 */
class SignalInventory extends Eloquent
{
    use SoftDeletes;

    protected $table = 'signals_inventory';

	protected $casts = [
		'subgroup_id' => 'int'
	];

	protected $fillable = [
		'subgroup_id',
		'code',
		'name',
		'usage',
		'description',
		'picture',
		'picture_fn',
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
                'code'   => 'required|min:1|max:50|unique:signals_inventory,code',
                'erp_code' => 'max:50',
                'subgroup'   => 'required|numeric',
                'name' => 'required|min:3|max:100',
                'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
                'variations' => 'required'
            ],
            $merge);
    }

	public function variations()
	{
		return $this->hasMany(SignalVariation::class, 'signal_id');
	}

	public function subgroup()
	{
		return $this->belongsTo(SignalSubgroup::class, 'subgroup_id');
	}

	public function vertical_signals()
	{
		return $this->hasMany(VerticalSignal::class, 'signal_id');
	}
}
