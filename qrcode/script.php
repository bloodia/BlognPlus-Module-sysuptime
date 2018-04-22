<?php

//--------------------------------------------------------------------
// BlognPlus Module
// http://www.blogn.org/
//--------------------------------------------------------------------
// *** QR CODE Generate Module ***
//
// script.php
//
// Last Update: 2012/03/07
// Version    : 1.0
// Copyright  : Yuta Akama
// URL        : https://www.bloodia.net/
//--------------------------------------------------------------------

?>

function pressedChar(event) {
	var code = 0;
	if (event.charCode === 0) {	// Firefox, Safari control code
		code = 0;
	} else if (!event.keyCode && event.charCode) {	// Firefox
		code = event.charCode;
	} else if (event.keyCode && !event.charCode) {	// IE
		code = event.keyCode;
	} else if (event.keyCode == event.charCode) {	// Safari
		code = event.keyCode;
	}
	if (32 <= code && code <= 126) {	// ASCII文字の範囲内
		return String.fromCharCode(code);
	} else {
		return null;
	}
}

function numberonly(event) {
	var char = pressedChar(event);
	if (char && !char.match(/\d/)) {
		return false;
	} else {
		return true;
	}
}

function wordonly(event) {
	var char = pressedChar(event);
	if (char && !char.match(/\w/)) {
		return false;
	} else {
		return true;
	}
}
