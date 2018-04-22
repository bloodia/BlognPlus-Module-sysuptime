<?php

//--------------------------------------------------------------------
// BlognPlus Module
// http://www.blogn.org/
//--------------------------------------------------------------------
// *** System Uptime Module ***
//
// info.php
//
// Last Update: 2012/03/03
// Version    : 1.0
// Copyright  : Yuta Akama
// URL        : https://www.bloodia.net/
//--------------------------------------------------------------------

/* バージョンを記載してください */
$blogn_mod_version = "1.0";

/* モジュールの名前を記入してください */
$blogn_mod_name = 'システム稼働時間表示';

/* モジュールの説明を記入してください */
$blogn_mod_desc = 'ブログ内にシステムの稼働時間を表示します。';

/* モジュールのインストール／アップデート用スクリプト名を記入してください */
$blogn_mod_install = 'install.php';
$blogn_mod_update = 'update.php';
$blogn_mod_uninstall = 'uninstall.php';

/* モジュールの管理画面用スクリプト名を記入してください */
$blogn_mod_control = 'control.php';

/* モジュールの表示処理用スクリプト名を記入してください */
/* アクセス解析など、表示用スクリプトが不要な場合は ''と記入してください */
$blogn_mod_viewer = 'sysuptime.php';

/* Blogn+v260以降用 */
/* index.phpで事前に読み込むfunctionデータがあればスクリプト名を記入してください */
/* 別モジュールと共有して使用する場合などに有効です。 不要な場合は ''と記入してください */
$blogn_mod_index_function = 'i_function.php';

/* Blogn+v260以降用 */
/* admin.phpで事前に読み込むfunctionデータがあればスクリプト名を記入してください */
/* 別モジュールと共有して使用する場合などに有効です。 不要な場合は ''と記入してください */
$blogn_mod_admin_function = 'a_function.php';

/* Blogn+v256以前用 */
/* モジュールの管理画面用関数スクリプト名を記入してください */
$blogn_mod_function = 'function.php';

/* キャッシュの有無を記入してください */
/* true : キャッシュあり / false : キャッシュなし */
$blogn_mod_cache_trigger = false;

/* キャッシュ有りの場合はキャッシュ記録時間取得用スクリプト名を記入してください */
//$blogn_mod_cache_time = 'blank.php';

?>
