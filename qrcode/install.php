<?php

//--------------------------------------------------------------------
// BlognPlus Module
// http://www.blogn.org/
//--------------------------------------------------------------------
// *** QR CODE Generate Module ***
//
// install.php
//
// Last Update: 2012/03/07
// Version    : 1.0
// Copyright  : Yuta Akama
// URL        : https://www.bloodia.net/
//--------------------------------------------------------------------

$mod = array(
	"ver"	=>	"1.0",
	"id"	=>	"qrcode",
	"name"	=>	"QRコード生成モジュール"
);

if (isset($objBlognPlus)) {
	// v2.6.2用
	if (!$objBlognPlus->is_login) {
		header("Content-Type: text/html; charset=UTF-8");
		echo 'セッションエラー。管理画面に入りなおしてください。';
		exit;
	}
} else {
	// v2.6.1以前用
	if (!$_COOKIE["blogn_cookie_pw"]) {
		$blogn_error = blogn_mod_db_user_check($_SESSION["blogn_session_id"], $_SESSION["blogn_session_pw"]);
		if (!$blogn_error[0]) {
			header("Content-Type: text/html; charset=UTF-8");
			echo 'セッションエラー。管理画面に入りなおしてください。';
			exit;
		}
	} else {
		$blogn_error = blogn_mod_db_user_check($_COOKIE["blogn_cookie_id"], $_COOKIE["blogn_cookie_pw"]);
		if (!$blogn_error[0]) {
			header("Content-Type: text/html; charset=UTF-8");
			echo 'セッションエラー。管理画面に入りなおしてください。';
			exit;
		}
	}
}

$information = '
<div style="margin: 0 2em;">
<h2 style="color: #0000ff; font-size: 120%;">'.$mod["name"].' ver '.$mod["ver"].'</h2>
<div style="border-left: 2px solid #aaaaff; margin-left: 2em; padding: 0 2em;">
<p><span style="color:#008000">■</span> モジュールのインストールが完了しました。</p>';

// ファイルに書き込めるかチェック
$filename = BLOGN_MODDIR.$mod["id"].'/ini.cgi';
if (!is_writable($filename)) {
	$information .= '<p><span style="color: #ff0000">■</span> /'.$mod["id"].'/ini.cgi のパーミッションに書き込み属性を与えてください（「666」「
606」等）。</p>';
} else {
	$information .= '<p><span style="color: #008000">■</span> /'.$mod["id"].'/ini.cgi のパーミッション OK</p>';
}

?>
