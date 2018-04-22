<?php

//--------------------------------------------------------------------
// BlognPlus Module
// http://www.blogn.org/
//--------------------------------------------------------------------
// *** System Uptime Module ***
//
// control.php
//
// Last Update: 2012/03/03
// Version    : 1.0
// Copyright  : Yuta AKama
// URL        : https://www.bloodia.net/
//--------------------------------------------------------------------

// 管理画面用のスキンファイル読み込み
$blogn_skin = file(BLOGN_MODDIR."sysuptime/setting.html");
$blogn_skin = implode("",$blogn_skin);

// 設定ファイルの更新・確認
switch($qry_action) {
	case "set":
		// 設定ファイルの更新
		$error = blogn_mod_sysuptime_file_update($_POST["blogn_sysuptime_type"]);
		// インフォメーション表示
		$blogn_skin = str_replace ("{BLOGN_INFORMATION}", blogn_information_bar($error[0], $error[1]), $blogn_skin);
		break;
	default:
		// 設定ファイルの確認
		$error = blogn_mod_sysuptime_ini_check();
		// インフォメーション表示
		$blogn_skin = str_replace ("{BLOGN_INFORMATION}", blogn_information_bar($error[0], $error[1]), $blogn_skin);
		break;
}

// 設定ファイルの読み込み
$inilist = blogn_mod_sysuptime_ini_load();
if ($inilist["type"] == 0) {
	$blogn_skin = str_replace ("{BLOGN_SYSUPTIME_TYPE0}", " checked", $blogn_skin);
} else if ($inilist["type"] == 1) {
	$blogn_skin = str_replace ("{BLOGN_SYSUPTIME_TYPE1}", " checked", $blogn_skin);
} else if ($inilist["type"] == 2) {
	$blogn_skin = str_replace ("{BLOGN_SYSUPTIME_TYPE2}", " checked", $blogn_skin);
}

echo $blogn_skin;

?>
