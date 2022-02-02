<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Car extends Model
{
    
    /**
     * モデルに関連付けるテーブル
     *
     * @var string
     */
    protected $table = 'cars';

    /**
     * パーツの取得
     */
    public function Part(){
        return $this->hasMany('App\Models\Part');
    }


    /**
     * テーブルに関連付ける主キー
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * モデルのIDを自動増分するか
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * 自動増分IDのデータ型
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * モデルにタイムスタンプを付けるか
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * モデルの属性のデフォルト値
     *
     * @var array
     */
    protected $attributes = [
        // 'id' => '',
        'name' => '',
        'status' => 0,
        'model_type' => '',
        'model_grade' => '',
        'color' => '',
        'color_no' => '',
        'trim_no' => '',
        'mileage' => '',
        'create_parson' => '',
        'chenge_person' => '',
        // 'created_at' => '',
        // 'updated_at' => ''
        'record_number' => '',
        'gear_shift' => '',
        'made_year' => '',
        'made_month' => '',
    ];

    /**
     * 複数代入可能な属性
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'status',
        'model_type',
        'model_grade',
        'color',
        'color_no',
        'trim_no',
        'mileage',
        'create_parson',
        'chenge_person',
        'created_at',
        'updated_at',
        'record_number',
        'gear_shift',
        'made_year',
        'made_month',
    ];

    /**
     * ステータス変更（終了:9）
     * @param array $id carId
     * @return bool true|false
     */
    public static function changeStatusEnd($id)
    {
        $updates = ['status' => 9];
        Car::whereIn('id', $id)->update($updates);
    }
}
