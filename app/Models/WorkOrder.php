<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class WorkOrder
 *  * 
 * @property \App\Models\User $user
 *
 * @package App\Models
 */
class WorkOrder extends Model {

    use SoftDeletes;

    protected $table = 'work_orders';

    //
    public function user() {
        return $this->belongsTo(User::class);
    }

}
//primero voy a hacer lo que me imagino

