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
        self::MANAGE_NUMBER => '',    // 管理番号
        self::CATEGORY => '',    // カテゴリ
        self::TITLE => '',    // タイトル
        self::DISCRIPTION => '',    // 説明
        self::KEYWORD => '',    // ストア内商品検索用キーワード
        self::START_PRICE => '',    // 開始価格
        self::IMMEDIATE_PRICE => '',    // 即決価格
        self::COUNT => '1',    // 個数
        self::SPAN => '',    // 期間
        self::END_TIME => '',    // 終了時間
        self::FROM_PREFECTURES => '三重県',    // 商品発送元の都道府県
        self::FROM_CITY => '度会郡',    // 商品発送元の市区町村
        self::FEE_BURDEN => '落札者',    // 送料負担
        self::PAY_METHOD => '代金先払い',    // 代金先払い、後払い
        self::PRODUCT_STATUS => '',    // 商品の状態
        self::IMAGE1 => '',    // 画像1
        self::IMAGE1_COMMENT => '',    // 画像1コメント
        self::IMAGE2 => '',    // 画像2
        self::IMAGE2_COMMENT => '',    // 画像2コメント
        self::IMAGE3 => '',    // 画像3
        self::IMAGE3_COMMENT => '',    // 画像3コメント
        self::IMAGE4 => '',    // 画像4
        self::IMAGE4_COMMENT => '',    // 画像4コメント
        self::IMAGE5 => '',    // 画像5
        self::IMAGE5_COMMENT => '',    // 画像5コメント
        self::IMAGE6 => '',    // 画像6
        self::IMAGE6_COMMENT => '',    // 画像6コメント
        self::IMAGE7 => '',    // 画像7
        self::IMAGE7_COMMENT => '',    // 画像7コメント
        self::IMAGE8 => '',    // 画像8
        self::IMAGE8_COMMENT => '',    // 画像8コメント
        self::IMAGE9 => '',    // 画像9
        self::IMAGE9_COMMENT => '',    // 画像9コメント
        self::IMAGE10 => '',    // 画像10
        self::IMAGE10_COMMENT => '',    // 画像10コメント
        self::LOWEST_RATE => '',    // 最低評価
        self::WORTH_LIMIT => 'はい',    // 悪評割合制限
        self::AUTH_LIMIT => '',    // 入札者認証制限
        self::AUTO_EXTENDED => '',    // 自動延長
        self::AUTO_RELISTING => '',    // 商品の自動再出品
        self::AUTO_PRICE_CUT => '',    // 自動値下げ
        self::NOTICE_ITEM => '',    // 注目のオークション
        self::WEIGHT_SETTING => '',    // 重量設定
        self::TAX_SETTING => '10',    // 消費税設定
        self::INTAX_FLUG => 'はい',    // 税込みフラグ
        self::JAN_CODE => '',    // JANコード・ISBNコード
        self::BRAND_ID => '',    // ブランドID
        self::ITEM_SPEC_SIZE => '',    // 商品スペックサイズ種別
        self::ITEM_SPEC_SIZE_ID => '',    // 商品スペックサイズID
        self::ITEM_SPEC_SIZE_ID => '',    // 商品分類ID
        self::ITEM_SPEC_CATEGORY => '',    // 配送グループ
        self::UP_TO_DELIVARY => '',    // 発送までの日数
    ];
}
