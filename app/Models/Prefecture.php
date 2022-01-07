<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prefecture extends Model
{
    /**
     * モデルに関連付けるテーブル
     *
     * @var string
     */
    protected $table = 'prefectures';

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
        'id' => '',
        'prefecture_name' => '',
        'prefecture_group' => '',
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
        'prefecture_name',
        'prefecture_group',
    ];
}
