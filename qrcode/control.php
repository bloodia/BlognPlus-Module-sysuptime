<?php

//--------------------------------------------------------------------
// BlognPlus Module
// http://www.blogn.org/
//--------------------------------------------------------------------
// *** QR CODE Generate Module ***
//
// control.php
//
// Last Update: 2012/03/07
// Version    : 1.0
// Copyright  : Yuta Akama
// URL        : https://www.bloodia.net/
//--------------------------------------------------------------------

// 管理画面用のスキンファイル読み込み
$blogn_skin = file(BLOGN_MODDIR."qrcode/setting.html");
$blogn_skin = implode("",$blogn_skin);

// 設定ファイルの更新・確認
switch($qry_action) {
	case "set":
		// 設定ファイルの更新
		$error = blogn_mod_qrcode_file_update($_POST["blogn_qrcode_size"], $_POST["blogn_qrcode_errorlevel"], $_POST["blogn_qrcode_alt"], $_POST["blogn_qrcode_title"]);
		// インフォメーション表示
		$blogn_skin = str_replace ("{BLOGN_INFORMATION}", blogn_information_bar($error[0], $error[1]), $blogn_skin);
		break;
	default:
		// 設定ファイルの確認
		$error = blogn_mod_qrcode_ini_check();
		// インフォメーション表示
		$blogn_skin = str_replace ("{BLOGN_INFORMATION}", blogn_information_bar($error[0], $error[1]), $blogn_skin);
		break;
}

// 設定ファイルの読み込み
$inilist = blogn_mod_qrcode_ini_load();
$blogn_skin = str_replace ("{BLOGN_QRCODE_SIZE}", $inilist["size"], $blogn_skin);
if ($inilist["errorlevel"] == 0) {
	$blogn_skin = str_replace ("{BLOGN_QRCODE_ERRORLEVEL0}", " selected", $blogn_skin);
} else if ($inilist["errorlevel"] == 1) {
	$blogn_skin = str_replace ("{BLOGN_QRCODE_ERRORLEVEL1}", " selected", $blogn_skin);
} else if ($inilist["errorlevel"] == 2) {
	$blogn_skin = str_replace ("{BLOGN_QRCODE_ERRORLEVEL2}", " selected", $blogn_skin);
} else if ($inilist["errorlevel"] == 3) {
	$blogn_skin = str_replace ("{BLOGN_QRCODE_ERRORLEVEL3}", " selected", $blogn_skin);
}
$blogn_skin = str_replace ("{BLOGN_QRCODE_ALT}", $inilist["alt"], $blogn_skin);
$blogn_skin = str_replace ("{BLOGN_QRCODE_TITLE}", $inilist["title"], $blogn_skin);
echo $blogn_skin;

?>
