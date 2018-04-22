<?php

//--------------------------------------------------------------------
// BlognPlus Module
// http://www.blogn.org/
//--------------------------------------------------------------------
// *** System Uptime Module ***
//
// function.php
//
// Last Update: 2012/03/03
// Version    : 1.0
// Copyright  : Yuta Akama
// URL        : https://www.bloodia.net/
//--------------------------------------------------------------------

// 設定ファイルの読み込み
function blogn_mod_sysuptime_ini_load() {
	$ini = file(BLOGN_MODDIR."sysuptime/ini.cgi");
	if (!$ini) {
		$inilist["type"] = 0;
	}else{
		list($inilist["type"],) = explode(",", $ini[0]);;
		reset($ini);
	}
	return $inilist;
}

?>
