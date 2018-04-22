<?php

//--------------------------------------------------------------------
// BlognPlus Module
// http://www.blogn.org/
//--------------------------------------------------------------------
// *** System Uptime Module ***
//
// a_function.php
//
// Last Update: 2012/03/03
// Version    : 1.0
// Copyright  : Yuta Akama
// URL        : https://www.bloodia.net/
//--------------------------------------------------------------------

// 設定ファイルの確認
function blogn_mod_sysuptime_ini_check() {
	$inidir = BLOGN_MODDIR."sysuptime/ini.cgi";
	// 設定ファイルが存在しない場合
	if (!$fp1 = @fopen($inidir, "r+")) {
		$oldmask = umask();
		umask(000);
		// 設定ファイルを新規に作成
		if (!$fp1 = @fopen($inidir, "w")) {
			// 設定ファイルを新規に作成出来なかった場合
			umask($oldmask);
			$errdata[0] = false;
			$errdata[1] = "設定ファイルを新規に作成できませんでした。モジュールのパーミッションを確認してください。";
			$errdata[2] = "ini.cgi";
			return $errdata;
		}else{
			// 設定ファイルを新規に作成出来た場合
			umask($oldmask);
			$errdata[0] = true;
			$errdata[1] = "設定ファイルを新規に作成しました。";
			$errdata[2] = "ini.cgi";
			return $errdata;
		}
	}
	// 設定ファイルが存在していた場合
	$errdata[0] = true;
	$errdata[1] = "設定ファイルを読み込みました。";
	$errdata[2] = "ini.cgi";
	return $errdata;
}

// 設定ファイルの更新
function blogn_mod_sysuptime_file_update($type) {
	$inidir = BLOGN_MODDIR."sysuptime/ini.cgi";
	$inifile = file($inidir);
	$fp1 = @fopen($inidir, "w");
	// 設定ファイルがロック出来なかった場合
	if (!$lockkey = blogn_mod_sysuptime_file_lock()) {
		$error[0] = false;
		$error[1] = "設定ファイルが処理中です。時間を置いてから実行してください。";
		return $error;
	}
	// 設定ファイルに書き込み
	if ($inifile) {
		$inifile[0] = $type.",\n";
		fputs($fp1, implode('', $inifile));
	}else{
		$inifile = $type.",\n";
		fputs($fp1, $inifile);
	}
	fclose($fp1);
	// 設定ファイルがアンロック出来なかった場合
	if (!blogn_mod_sysuptime_file_unlock($lockkey)) {
		$error[0] = false;
		$error[1] = "設定ファイルが処理中です。ファイルのロックが解除できませんでした。";
		return $error;
	}
	// 設定ファイルの更新
	$errdata[0] = true;
	$errdata[1] = "設定ファイルを更新しました。";
	$errdata[2] = $id;
	return $errdata;
}

// 設定ファイルのロック
function blogn_mod_sysuptime_file_lock() {
	$id = uniqid('lock');
	for ($i = 0; $i < 5; $i++) {
		if (@rename(BLOGN_MODDIR.'/sysuptime/lock', BLOGN_MODDIR.'/sysuptime/'.$id)) {
			return $id;
		}
		sleep(1);
	}
	return false;
}

// 設定ファイルのアンロック
function blogn_mod_sysuptime_file_unlock($id) {
	if (@rename(BLOGN_MODDIR.'/sysuptime/'.$id, BLOGN_MODDIR.'/sysuptime/lock')) {
		return true;
	}else{
		return false;
	}
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
