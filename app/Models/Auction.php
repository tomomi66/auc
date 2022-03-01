<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * partsモデル
 */
class Auction extends Model
{
    /**
     * モデルに関連付けるテーブル
     *
     * @var string
     */
    protected $table = 'auctions';

    /**
     * パーツの取得
     */
    public function Parts()
    {
        return $this->belongsTo('App\Models\Parts');
    }

    public function Category()
    {
        return $this->belongsTo('App\Models\Category');
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
        'parts_id' => '',    // パーツID
        'category' => '',    // カテゴリ
        'title' => '',    // タイトル
        'descript' => '',    // 商品説明
        'keyword' => '',    // オークションキーワード
        'starting_price' => 0,    // 開始価格
        'pompt_decision' => 0,    // 即決価格
        'term' => 5,    // 期間
        'end_time' => 20,    // 終了時間
        'shipping_group' => '',    // 配送グループ
        'condition' => '',    // 商品の状態
        'image1' => '',    // 画像1
        'image1_caption' => '',    // 画像1キャプション
        'image2' => '',    // 画像2
        'image2_caption' => '',    // 画像2キャプション
        'image3' => '',    // 画像3
        'image3_caption' => '',    // 画像3キャプション
        'image4' => '',    // 画像4
        'image4_caption' => '',    // 画像4キャプション
        'image5' => '',    // 画像5
        'image5_caption' => '',    // 画像5キャプション
        'image6' => '',    // 画像6
        'image6_caption' => '',    // 画像6キャプション
        'image7' => '',    // 画像7
        'image7_caption' => '',    // 画像7キャプション
        'image8' => '',    // 画像8
        'image8_caption' => '',    // 画像8キャプション
        'image9' => '',    // 画像9
        'image9_caption' => '',    // 画像9キャプション
        'image10' => '',    // 画像10
        'image10_caption' => '',    // 画像10キャプション
        'created_at' => '',    // 
        'updated_at' => '',    // 
        'status' => 0,    // ステータス
    ];

    /**
     * 複数代入可能な属性
     *
     * @var array
     */
    protected $fillable = [
        'parts_id', // パーツID
        'category', // カテゴリ
        'title', // タイトル
        'descript', // 商品説明
        'keyword', // オークションキーワード
        'starting_price', // 開始価格
        'pompt_decision', // 即決価格
        'term', // 期間
        'end_time', // 終了時間
        'shipping_group', // 配送グループ
        'condition', // 商品の状態
        'image1', // 画像1
        'image1_caption', // 画像1キャプション
        'image2', // 画像2
        'image2_caption', // 画像2キャプション
        'image3', // 画像3
        'image3_caption', // 画像3キャプション
        'image4', // 画像4
        'image4_caption', // 画像4キャプション
        'image5', // 画像5
        'image5_caption', // 画像5キャプション
        'image6', // 画像6
        'image6_caption', // 画像6キャプション
        'image7', // 画像7
        'image7_caption', // 画像7キャプション
        'image8', // 画像8
        'image8_caption', // 画像8キャプション
        'image9', // 画像9
        'image9_caption', // 画像9キャプション
        'image10', // 画像10
        'image10_caption', // 画像10キャプション
        'created_at', // 
        'updated_at', // 
        'status', // ステータス

    ];
}
