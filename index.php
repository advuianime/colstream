<?php
if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != 'colstream.net') {
function decrypt($string) {
	$key = '6kkuv7722hsbsjsisi9&3jV39sA!H#uZC33';
	$result = '';
	$string = strtr($string, '-_', '+/');
	$string = base64_decode($string);
	for($i=0; $i<strlen($string); $i++) {
		$char = substr($string, $i, 1);
		$keychar = substr($key, ($i % strlen($key))-1, 1);
		$char = chr(ord($char)-ord($keychar));
		$result.=$char;
	}
	return $result;
}
$url = decrypt($_GET['data']);
$cookie = decrypt($_GET['expire']);

function size($url, $cookie) { 
 
 
 $ch = curl_init();
 $useragent = "Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.96 Safari/537.36";
 curl_setopt($ch, CURLOPT_HTTPHEADER, array("Cookie: DRIVE_STREAM=".$cookie));
 curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 222222);
 
 curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
 curl_setopt($ch, CURLOPT_HEADER, true);
 curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
 curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
 curl_setopt($ch, CURLOPT_NOBODY, true);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
 $info = curl_exec($ch);


$size = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
  
 
 
 
return $size;
}


function stream($url, $cookie) { 
 $ch = curl_init();
 $useragent = "Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.96 Safari/537.36";
 curl_setopt($ch, CURLOPT_HTTPHEADER, array("Cookie: DRIVE_STREAM=".$cookie));
 curl_setopt($ch, CURLOPT_VERBOSE, 1);
 curl_setopt($ch, CURLOPT_TIMEOUT, 222222);
 curl_setopt($ch, CURLOPT_URL, $url);
 curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
 curl_setopt($ch, CURLOPT_HEADER, true);
 curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
 curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
 curl_setopt($ch, CURLOPT_NOBODY, true);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
 $info = curl_exec($ch);


$size2 = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
 


 

header("Content-Type: video/mp4"); 
$filesize = $size2;

$offset = 0;
$length = $filesize;
if ( isset($_SERVER['HTTP_RANGE']) ) {
    $partialContent = "true";
    preg_match('/bytes=(\d+)-(\d+)?/', $_SERVER['HTTP_RANGE'], $matches);
    $offset = intval($matches[1]);
    $length = $size2 - $offset -1;
} else {
    $partialContent = "false";
} 
if ( $partialContent =="true") {
    header('HTTP/1.1 206 Partial Content');
    header('Accept-Ranges: bytes'); 
    header('Content-Range: bytes ' . $offset . '-' . ($offset + $length) . '/' . $filesize);
} else {
header('Accept-Ranges: bytes'); 
}
header("Content-length: ".$size2);
 
 
 
 
 
 
}
 

function StartsWith($Haystack, $Needle){
    // Recommended version, using strpos
    return strpos($Haystack, $Needle);
}
echo stream($url,$cookie);
$fsize = size($url,$cookie);
 $ch = curl_init();
 $useragent = "Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.96 Safari/537.36";
 if ( isset($_SERVER['HTTP_RANGE']) ) {
    // if the HTTP_RANGE header is set we're dealing with partial content

    $partialContent = true;

    // find the requested range
    // this might be too simplistic, apparently the client can request
    // multiple ranges, which can become pretty complex, so ignore it for now
    preg_match('/bytes=(\d+)-(\d+)?/', $_SERVER['HTTP_RANGE'], $matches);

    $offset = intval($matches[1]);
    $length = $fsize - $offset -1;

$headers = array(
    'Cookie: DRIVE_STREAM='.$cookie,
    'Range: bytes=' . $offset . '-' . ($offset + $length) . '',
);
 curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

} else {
 curl_setopt($ch, CURLOPT_HTTPHEADER, array("Cookie: DRIVE_STREAM=".$cookie));

}
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 222222);
curl_setopt($ch, CURLOPT_TCP_FASTOPEN, 1);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
curl_setopt($ch, CURLOPT_NOBODY, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
curl_exec($ch);
}
else { echo("<html><head><title>403 Forbidden</title><link href='//fonts.googleapis.com/css?family=Rubik:300,400,500' rel='stylesheet' type='text/css'><style>html, body { width: 100%; margin: 0; padding: 0; text-align: center; font-family: 'Rubik'; background-image: url('data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz4KPHN2ZyB3aWR0aD0iMjg4MHB4IiBoZWlnaHQ9IjE0MjRweCIgdmlld0JveD0iMCAwIDI4ODAgMTQyNCIgdmVyc2lvbj0iMS4xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIj4KICAgIDxkZWZzPgogICAgICAgIDxyYWRpYWxHcmFkaWVudCBjeD0iNDguNDU0MDQyMiUiIGN5PSIyNy4wMTE5NjQ1JSIgZng9IjQ4LjQ1NDA0MjIlIiBmeT0iMjcuMDExOTY0NSUiIHI9IjcwLjg3MDg1MTQlIiBncmFkaWVudFRyYW5zZm9ybT0idHJhbnNsYXRlKDAuNDg0NTQwLDAuMjcwMTIwKSxzY2FsZSgwLjQ5NDQ0NCwxKSxyb3RhdGUoOTApLHRyYW5zbGF0ZSgtMC40ODQ1NDAsLTAuMjcwMTIwKSIgaWQ9InJhZGlhbEdyYWRpZW50LTEiPgogICAgICAgICAgICA8c3RvcCBzdG9wLWNvbG9yPSIjMDAyNjQ5IiBvZmZzZXQ9IjAlIj48L3N0b3A+CiAgICAgICAgICAgIDxzdG9wIHN0b3AtY29sb3I9IiMwNTFGMzciIG9mZnNldD0iMTAwJSI+PC9zdG9wPgogICAgICAgIDwvcmFkaWFsR3JhZGllbnQ+CiAgICAgICAgPHJlY3QgaWQ9InBhdGgtMiIgeD0iMCIgeT0iMCIgd2lkdGg9IjI4ODAiIGhlaWdodD0iMTQyNCI+PC9yZWN0PgogICAgPC9kZWZzPgogICAgPGcgaWQ9IlBhZ2UtMSIgc3Ryb2tlPSJub25lIiBzdHJva2Utd2lkdGg9IjEiIGZpbGw9Im5vbmUiIGZpbGwtcnVsZT0iZXZlbm9kZCI+CiAgICAgICAgPGcgaWQ9IkhvbWVwYWdlLUNvcHkiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDAsIC01Mjk1KSI+CiAgICAgICAgICAgIDxnIGlkPSJHcm91cC0xNyIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMCwgNTI5NSkiPgogICAgICAgICAgICAgICAgPGcgaWQ9Ikdyb3VwLTM0Ij4KICAgICAgICAgICAgICAgICAgICA8bWFzayBpZD0ibWFzay0zIiBmaWxsPSJ3aGl0ZSI+CiAgICAgICAgICAgICAgICAgICAgICAgIDx1c2UgeGxpbms6aHJlZj0iI3BhdGgtMiI+PC91c2U+CiAgICAgICAgICAgICAgICAgICAgPC9tYXNrPgogICAgICAgICAgICAgICAgICAgIDx1c2UgaWQ9Ik1hc2siIGZpbGw9InVybCgjcmFkaWFsR3JhZGllbnQtMSkiIHhsaW5rOmhyZWY9IiNwYXRoLTIiPjwvdXNlPgogICAgICAgICAgICAgICAgPC9nPgogICAgICAgICAgICA8L2c+CiAgICAgICAgPC9nPgogICAgPC9nPgo8L3N2Zz4='); background-repeat: no-repeat; background-position: bottom center; background-size: cover; color: white; height: 100%; background-color: #051f37; } h1 {margin-bottom: 0px;font-weight: bold;font-size: 140px;font-weight: 500;padding-top: 130px;margin-bottom: -35px;}h2 {font-size: 45px;color: white; font-weight: 200;}</style></head><body><div id='content'><h1 style='margin-bottom: -35px;'>403</h1><h2>Forbidden</h2></div></body></html>");} 
?>
