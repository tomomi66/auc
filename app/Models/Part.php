<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Part extends Model
{
    /**
     * モデルに関連付けるテーブル
     *
     * @var string
     */
    protected $table = 'parts';

    /**
     * パーツの取得
     */
    public function Car()
    {
        return $this->belongsTo('App\Models\Car');
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
        'car_id' => '',
        'status' => '',
        'parts_name' => '',
        'parts_makers' => '',
        'parts_makers_no' => '',
        'pretitle' => '',
        'condition' => '',
        'operating_status' => '',
        'check_video' => '',
        'video_url' => '',
        'postage_class' => '',
        'starting_price' => '',
        'pompt_decision' => '',
        'memo' => '',
        'image1' => '',
        'image1_caption' => '',
        'image2' => '',
        'image2_caption' => '',
        'image3' => '',
        'image3_caption' => '',
        'image4' => '',
        'image4_caption' => '',
        'image5' => '',
        'image5_caption' => '',
        'image6' => '',
        'image6_caption' => '',
        'image7' => '',
        'image7_caption' => '',
        'image8' => '',
        'image8_caption' => '',
        'image9' => '',
        'image9_caption' => '',
        'image10' => '',
        'image10_caption' => '',
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
        'car_id',
        'status',
        'parts_name',
        'parts_makers',
        'parts_makers_no',
        'pretitle',
        'condition',
        'operating_status',
        'check_video',
        'video_url',
        'postage_class',
        'starting_price',
        'pompt_decision',
        'memo',
        'image1',
        'image1_caption',
        'image2',
        'image2_caption',
        'image3',
        'image3_caption',
        'image4',
        'image4_caption',
        'image5',
        'image5_caption',
        'image6',
        'image6_caption',
        'image7',
        'image7_caption',
        'image8',
        'image8_caption',
        'image9',
        'image9_caption',
        'image10',
        'image10_caption',
        'create_parson',
        'chenge_person'
    ];
}
