<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use \Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Report;

class Material extends Eloquent {

    use SoftDeletes;

    protected $table = 'materials';
    protected $fillable = [
        'erp_code', 'name', 'quantity', 'origen','report_id'
    ];

    public function report() {
        return $this->belongsToMany(Report::class)->withTimestamps();
    }

    public static function rules($merge = []) {
        return array_merge(
                [
            'report_id' => 'required',
            'name' => 'required|min:1|max:100|unique:materials',
            'erp_code' => 'required|max:50',
            'quantity' => 'required',
            'origen' => 'required',
                ], $merge);
    }

}

/*$table->bigIncrements('id');  
            $table->string('erp_code', 50)->nullable();
            $table->string('name');   
            $table->integer('quantity');              
            $table->boolean('origen')->default(true);     //1-stock(predefinido) o false- almacen         
            $table->timestamps();*/