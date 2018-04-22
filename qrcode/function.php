<?php

//--------------------------------------------------------------------
// BlognPlus Module
// http://www.blogn.org/
//--------------------------------------------------------------------
// *** QR CODE Generate Module ***
//
// function.php
//
// Last Update: 2012/03/07
// Version    : 1.0
// Copyright  : Yuta Akama
// URL        : https://www.bloodia.net/
//--------------------------------------------------------------------

// 設定ファイルの読み込み
function blogn_mod_qrcode_ini_load() {
	$ini = file(BLOGN_MODDIR."qrcode/ini.cgi");
	if (!$ini) {
		$inilist["size"] = 150;		// デフォルト値
		$inilist["errorlevel"] = 0;	// デフォルト値
		$inilist["alt"] = "QRコード";	// デフォルト値
		$inilist["title"] = "QRコード";	// デフォルト値
	}else{
		list(
			$inilist["size"],
			$inilist["errorlevel"],
			$inilist["alt"],
			$inilist["title"]
		) = explode(",", $ini[0]);;
		reset($ini);
	}
	return $inilist;
}

?>
