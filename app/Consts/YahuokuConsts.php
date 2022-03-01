<?php
/**
 * CSVへの出力用Const
 * 列のテンプレートと各初期値設定
 */
namespace App\Consts;

class YahuokuConsts
{
    /** CSV HEADER */
    const CSV_HEADER = ['管理番号', 'カテゴリ', 'タイトル', '説明', 'ストア内商品検索用キーワード', 
    '開始価格', '即決価格', '個数', '期間', '終了時間', '商品発送元の都道府県', '商品発送元の市区町村', 
    '送料負担', '代金先払い、後払い', '商品の状態', '画像1', '画像1コメント', '画像2', '画像2コメント', '画像3', '画像3コメント', 
    '画像4', '画像4コメント', '画像5', '画像5コメント', '画像6', '画像6コメント', 
    '画像7', '画像7コメント', '画像8', '画像8コメント', '画像9', '画像9コメント', 
    '画像10', '画像10コメント', '最低評価', '悪評割合制限', '入札者認証制限', '自動延長', 
    '商品の自動再出品', '自動値下げ', '注目のオークション', '重量設定', '消費税設定', 
    '税込みフラグ', 'JANコード・ISBNコード', 'ブランドID', '商品スペックサイズ種別', 
    '商品スペックサイズID', '商品分類ID', '配送グループ', '発送までの日数',];

    /** 配達グループ設定 */
    const SHIP_A = 2;
    const SHIP_B = 3;
    const SHIP_C = 4;
    const SHIP_D = 5;
    const SHIP_E = 6;
    const SHIP_F = 7;
    const SHIP_NEKOPOS = 8;

    const SHIP_GROUP = [
        self::SHIP_A => 'A',
        self::SHIP_B => 'B',
        self::SHIP_C => 'C',
        self::SHIP_D => 'D',
        self::SHIP_E => 'E',
        self::SHIP_F => 'F',
        self::SHIP_NEKOPOS => 'A',
    ];

    const LABEL_YES = 1;
    const LABEL_NO = 0;
    const SETTING_TAX = [
        self::LABEL_YES => '税込み',
        self::LABEL_NO => '税抜き'
    ];
}