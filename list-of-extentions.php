<?php
function getSrc($fileName) {
	$ext = explode(".", $fileName);
	$ext = end($ext);
	$src = 'unknown.png';
	switch ($ext) {
		case 'php':
		case 'html':
		case 'htm':
		case 'js':
		case 'css':
			$src = 'chrome.png';
			break;
		case 'txt':
		case 'rtf':
		case 'doc':
		case 'docx':
			$src = 'text.png';
			break;
		case 'jpg':
		case 'png':
		case 'gif':
		case 'jpeg':
		case 'bmp':
			$src = 'img.png';
			break;
	}
	return $src;
}
