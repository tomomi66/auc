<?php

/**
 * CSVへの出力用Const
 * 列のテンプレートと各初期値設定
 */
namespace App\Consts;

class CsvDataConsts
{
    const MANAGE_NUMBER = 0;    // 管理番号
    const CATEGORY = 1;    // カテゴリ
    const TITLE = 2;    // タイトル
    const DISCRIPTION = 3;    // 説明
    const KEYWORD = 4;    // ストア内商品検索用キーワード
    const START_PRICE = 5;    // 開始価格
    const IMMEDIATE_PRICE = 6;    // 即決価格
    const COUNT = 7;    // 個数
    const SPAN = 8;    // 期間
    const END_TIME = 9;    // 終了時間
    const FROM_PREFECTURES = 10;    // 商品発送元の都道府県
    const FROM_CITY = 11;    // 商品発送元の市区町村
    const FEE_BURDEN = 12;    // 送料負担
    const PAY_METHOD = 13;    // 代金先払い、後払い
    const PRODUCT_STATUS = 14;    // 商品の状態
    const IMAGE1 = 15;    // 画像1
    const IMAGE1_COMMENT = 16;    // 画像1コメント
    const IMAGE2 = 17;    // 画像2
    const IMAGE2_COMMENT = 18;    // 画像2コメント
    const IMAGE3 = 19;    // 画像3
    const IMAGE3_COMMENT = 20;    // 画像3コメント
    const IMAGE4 = 21;    // 画像4
    const IMAGE4_COMMENT = 22;    // 画像4コメント
    const IMAGE5 = 23;    // 画像5
    const IMAGE5_COMMENT = 24;    // 画像5コメント
    const IMAGE6 = 25;    // 画像6
    const IMAGE6_COMMENT = 26;    // 画像6コメント
    const IMAGE7 = 27;    // 画像7
    const IMAGE7_COMMENT = 28;    // 画像7コメント
    const IMAGE8 = 29;    // 画像8
    const IMAGE8_COMMENT = 30;    // 画像8コメント
    const IMAGE9 = 31;    // 画像9
    const IMAGE9_COMMENT = 32;    // 画像9コメント
    const IMAGE10 = 33;    // 画像10
    const IMAGE10_COMMENT = 34;    // 画像10コメント
    const LOWEST_RATE = 35;    // 最低評価
    const WORTH_LIMIT = 36;    // 悪評割合制限
    const AUTH_LIMIT = 37;    // 入札者認証制限
    const AUTO_EXTENDED = 38;    // 自動延長
    const AUTO_RELISTING = 39;    // 商品の自動再出品
    const AUTO_PRICE_CUT = 40;    // 自動値下げ
    const NOTICE_ITEM = 41;    // 注目のオークション
    const WEIGHT_SETTING = 42;    // 重量設定
    const TAX_SETTING = 43;    // 消費税設定
    const INTAX_FLUG = 44;    // 税込みフラグ
    const JAN_CODE = 45;    // JANコード・ISBNコード
    const BRAND_ID = 46;    // ブランドID
    const ITEM_SPEC_SIZE = 47;    // 商品スペックサイズ種別
    const ITEM_SPEC_SIZE_ID = 48;    // 商品スペックサイズID
    const ITEM_SPEC_CATEGORY = 49;    // 商品分類ID
    const ITEM_SHIPPING_GROUP = 50;    // 配送グループ
    const UP_TO_DELIVARY = 51;    // 発送までの日数

    const CSV_DATA = [
        self::MANAGE_NUMBER => '',
        self::CATEGORY => '',
        self::TITLE => '',
        self::DISCRIPTION => '',
        self::KEYWORD => '',
        self::START_PRICE => '',
        self::IMMEDIATE_PRICE => '',
        self::COUNT => '',
        self::SPAN => '',
        self::END_TIME => '',
        self::FROM_PREFECTURES => '',
        self::FROM_CITY => '',
        self::FEE_BURDEN => '',
        self::PAY_METHOD => '',
        self::PRODUCT_STATUS => '',
        self::IMAGE1 => '',
        self::IMAGE1_COMMENT => '',
        self::IMAGE2 => '',
        self::IMAGE2_COMMENT => '',
        self::IMAGE3 => '',
        self::IMAGE3_COMMENT => '',
        self::IMAGE4 => '',
        self::IMAGE4_COMMENT => '',
        self::IMAGE5 => '',
        self::IMAGE5_COMMENT => '',
        self::IMAGE6 => '',
        self::IMAGE6_COMMENT => '',
        self::IMAGE7 => '',
        self::IMAGE7_COMMENT => '',
        self::IMAGE8 => '',
        self::IMAGE8_COMMENT => '',
        self::IMAGE9 => '',
        self::IMAGE9_COMMENT => '',
        self::IMAGE10 => '',
        self::IMAGE10_COMMENT => '',
        self::LOWEST_RATE => '',
        self::WORTH_LIMIT => '',
        self::AUTH_LIMIT => '',
        self::AUTO_EXTENDED => '',
        self::AUTO_RELISTING => '',
        self::AUTO_PRICE_CUT => '',
        self::NOTICE_ITEM => '',
        self::WEIGHT_SETTING => '',
        self::TAX_SETTING => '',
        self::INTAX_FLUG => '',
        self::JAN_CODE => '',
        self::BRAND_ID => '',
        self::ITEM_SPEC_SIZE => '',
        self::ITEM_SPEC_SIZE_ID => '',
        self::ITEM_SPEC_SIZE_ID => '',
        self::ITEM_SPEC_CATEGORY => '',
        self::UP_TO_DELIVARY => '',
    ];
}
