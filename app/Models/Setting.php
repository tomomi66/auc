<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * モデルに関連付けるテーブル
     *
     * @var string
     */
    protected $table = 'settings';

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
    public $incrementing = false;

    /**
     * 自動増分IDのデータ型
     *
     * @var string
     */
    // protected $keyType = 'string';

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
        'comment1' => '',
        'comment2' => '',
        'comment3' => '',
        'from_prefecture' => '',
        'fee_burden' => '',
        'pay_method' => '',
        'min_rate' => '',
        'evil_rate_limit' => '',
        'authen_limit' => '',
        'auto_extend' => '',
        'from_city' => '',
        'auto_listing' => '',
        'tax_preference' => '',
        'in_tax_setting_flg' => '',
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
        'comment1',
        'comment2',
        'comment3',
        'from_prefecture',
        'fee_burden',
        'pay_method',
        'min_rate',
        'evil_rate_limit',
        'authen_limit',
        'auto_extend',
        'from_city',
        'auto_listing',
        'tax_preference',
        'in_tax_setting_flg',
    ];
}
