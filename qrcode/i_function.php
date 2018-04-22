<?php

//--------------------------------------------------------------------
// BlognPlus Module
// http://www.blogn.org/
//--------------------------------------------------------------------
// *** QR CODE Generate Module ***
//
// i_function.php
//
// Last Update: 2012/03/07
// Version    : 1.0
// Copyright  : Yuta Akama
// URL        : https://www.bloodia.net/
//--------------------------------------------------------------------

// 表示処理
function blogn_mod_qrcode_viewer($user, $skin, $qrcode) {
	if (!preg_match("/\{QRCODE\}([\w\W]+?)\{\/QRCODE\}/",$skin)) return $skin;
	// 設定ファイル読み込み
	$inilist = blogn_mod_qrcode_ini_load();
	$size = $inilist["size"];
	if ($inilist["errorlevel"] == 0) {
		$chld = "H";
	} else if ($inilist["errorlevel"] == 1) {
		$chld = "Q";
	} else if ($inilist["errorlevel"] == 2) {
		$chld = "M";
	} else if ($inilist["errorlevel"] == 3) {
		$chld = "L";
	}
	$alt = $inilist["alt"];
	$title = $inilist["title"];
	preg_match_all("/\{QRCODE\}([\w\W]+?)\{\/QRCODE\}/", $skin, $matches, PREG_SET_ORDER);
	foreach ($matches as $val) {
		$url = $val[1];
		$chl = urlencode($url);
		$chl = preg_replace("/%7B/", '{', $chl);
		$chl = preg_replace("/%7D/", '}', $chl);
		$qrcode = '<img src="//chart.apis.google.com/chart?chs=' . $size . 'x' . $size . '&amp;cht=qr&amp;chld=' . $chld . '&amp;chl=' . $chl . '" width="' . $size . '" height="' . $size . '" alt="' . $alt . '" title="' . $title . '" />';
		$skin = preg_replace("/\{QRCODE\}([\w\W]+?)\{\/QRCODE\}/", $qrcode, $skin, 1);
	}
	return $skin;
}

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
