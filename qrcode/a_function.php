<?php

//--------------------------------------------------------------------
// BlognPlus Module
// http://www.blogn.org/
//--------------------------------------------------------------------
// *** QR CODE Generate Module ***
//
// a_function.php
//
// Last Update: 2012/03/07
// Version    : 1.0
// Copyright  : Yuta Akama
// URL        : https://www.bloodia.net/
//--------------------------------------------------------------------

// 設定ファイルの確認
function blogn_mod_qrcode_ini_check() {
	$inidir = BLOGN_MODDIR."qrcode/ini.cgi";
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
function blogn_mod_qrcode_file_update($size, $errorlevel, $alt, $title) {
	$inidir = BLOGN_MODDIR."qrcode/ini.cgi";
	$inifile = file($inidir);
	$fp1 = @fopen($inidir, "w");
	// 設定ファイルがロック出来なかった場合
	if (!$lockkey = blogn_mod_qrcode_file_lock()) {
		$error[0] = false;
		$error[1] = "設定ファイルが処理中です。時間を置いてから実行してください。";
		return $error;
	}
	// 設定ファイルに書き込み
	if ($inifile) {
		$inifile[0] = $size.",".$errorlevel.",".$alt.",".$title.",\n";
		fputs($fp1, implode('', $inifile));
	}else{
		$inifile = $size.",".$errorlevel.",".$alt.",".$title.",\n";
		fputs($fp1, $inifile);
	}
	fclose($fp1);
	// 設定ファイルがアンロック出来なかった場合
	if (!blogn_mod_qrcode_file_unlock($lockkey)) {
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
function blogn_mod_qrcode_file_lock() {
	$id = uniqid('lock');
	for ($i = 0; $i < 5; $i++) {
		if (@rename(BLOGN_MODDIR.'/qrcode/lock', BLOGN_MODDIR.'/qrcode/'.$id)) {
			return $id;
		}
		sleep(1);
	}
	return false;
}

// 設定ファイルのアンロック
function blogn_mod_qrcode_file_unlock($id) {
	if (@rename(BLOGN_MODDIR.'/qrcode/'.$id, BLOGN_MODDIR.'/qrcode/lock')) {
		return true;
	}else{
		return false;
	}
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
