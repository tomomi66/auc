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
        'in_number' => '',
        'status' => 0,
        'registration_volume' => '',
        'made_date' => '',
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
    ];

    /**
     * 複数代入可能な属性
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'in_number',
        'status',
        'registration_volume',
        'made_date',
        'model_type',
        'model_grade',
        'color',
        'color_no',
        'trim_no',
        'mileage',
        'create_parson',
        'chenge_person',
    ];
}
