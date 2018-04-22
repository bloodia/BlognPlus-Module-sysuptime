<?php

//--------------------------------------------------------------------
// BlognPlus Module
// http://www.blogn.org/
//--------------------------------------------------------------------
// *** System Uptime Module ***
//
// i_function.php
//
// Last Update: 2012/03/03
// Version    : 1.0
// Copyright  : Yuta Akama
// URL        : https://www.bloodia.net/
//--------------------------------------------------------------------

// 表示処理
function blogn_mod_sysuptime_viewer($user, $skin, $type) {
	if (!preg_match("/\{SYSUPTIME\}/",$skin)) return $skin;
	// 設定ファイル読み込み
	$sysuptime_ini = blogn_mod_sysuptime_ini_load();
	list($sysuptime_type, ) = explode(",",$sysuptime_ini["type"]);
	$now = shell_exec("uptime");
	$tmp = preg_split("/up/",$now);
	$time = preg_split("/,/",$tmp[1]);
	// 日数と時間と分（例：X日間とX時間X分）
	if ($sysuptime_type == 0) {
		if (preg_match("/day/",$time[0])) {
			$tmp = preg_split("/day/",$time[0]);
			$day = $tmp[0];
			if (preg_match("/min/",$time[1])) {
				$hour = 0;
				$tmp = preg_split("/min/",$time[1]);
				$min = $tmp[0];
			} else {
				$tmp = preg_split("/:/",$time[1]);
				$hour = $tmp[0];
				$min = $tmp[1];
			}
			$day = trim($day);
			$hour = trim($hour);
			$min = trim($min);
		} else if (preg_match("/:/",$time[0])) {
			$tmp = preg_split("/:/",$time[0]);
			$day = 0;
			$hour = trim($tmp[0]);
			$min = trim($tmp[1]);
		} else if (preg_match( "/min/",$time[0])) {
			$tmp = preg_split("/min/",$time[0]);
			$day = 0;
			$hour = 0;
			$min = trim($tmp[0]);
		}
		$sysuptime = $day."日間と".$hour."時間".$min."分";
	// 時間と分（例：X時間X分）
	} else if ($sysuptime_type == 1) {
		if (preg_match("/day/",$time[0])) {
			$tmp = preg_split("/day/",$time[0]);
			$day = $tmp[0];
			if (preg_match("/min/",$time[1])) {
				$hour = 0;
				$tmp = preg_split("/min/",$time[1]);
				$min = $tmp[0];
			} else {
				$tmp = preg_split("/:/",$time[1]);
				$hour = $tmp[0];
				$min = $tmp[1];
			}
			$day = trim($day) * 60;
			$hour = trim($hour) + $day;
			$min = trim($min);
		} else if (preg_match("/:/",$time[0])) {
			$tmp = preg_split("/:/",$time[0]);
			$day = 0;
			$hour = trim($tmp[0]);
			$min = trim($tmp[1]);
		} else if (preg_match( "/min/",$time[0])) {
			$tmp = preg_split("/min/",$time[0]);
			$day = 0;
			$hour = 0;
			$min = trim($tmp[0]);
		}
		$sysuptime = $hour."時間".$min."分";
	// 分のみ（例：X分）
	} else if ($sysuptime_type == 2) {
		if (preg_match("/day/",$time[0])) {
			$tmp = preg_split("/day/",$time[0]);
			$day = $tmp[0];
			if (preg_match("/min/",$time[1])) {
				$hour = 0;
				$tmp = preg_split("/min/",$time[1]);
				$min = $tmp[0];
			} else {
				$tmp = preg_split("/:/",$time[1]);
				$hour = $tmp[0];
				$min = $tmp[1];
			}
			$day = (trim($day) * 60) * 60;
			$hour = (trim($hour) * 60) + $day;
			$min = trim($min) + $hour;
		} else if (preg_match("/:/",$time[0])) {
			$tmp = preg_split("/:/",$time[0]);
			$hour = trim($tmp[0]) * 60;
			$min = trim($tmp[1]) + $hour;
		} else if (preg_match( "/min/",$time[0])) {
			$tmp = preg_split("/min/",$time[0]);
			$min = trim($tmp[0]);
		}
		$sysuptime = $min."分";
	}
	$skin = preg_replace ("/\{SYSUPTIME\}/", $sysuptime, $skin);
	return $skin;
}

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
