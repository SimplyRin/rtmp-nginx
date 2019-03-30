<?php
/**
 * Created by SimplyRin on 2019/03/30.
 *
 * Copyright (c) 2019 SimplyRin
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

$result = "";

$dhandle = opendir("./nginx/list/");
if ($dhandle) {
	$count = 0;
	while ($fname = readdir($dhandle)) {
		$spl = split(file_get_contents("./nginx/list/" . $fname), " ");

		$application = trim($spl[0]);
		$url = trim($spl[1]);
		$streamKey = trim($spl[2]);

		if ($application !== "" && $url !== "" && $streamKey !== "") {
$result .= '
			push ' . $url . $streamKey . ';';
		}
	}
}

$nginxConf = split(file_get_contents("./nginx/rtmp-nginx/nginx.conf"), "rtmp {")[0];

$output = $nginxConf . 
"rtmp {
	server {
		listen 1935;
		chunk_size 8192;
		
		application VtpuThYDxfND {
			live on;
			record off;
" . $result . "
		}
	}
}
";

$fp = fopen("./nginx/rtmp-nginx/nginx.conf", "w");
fwrite($fp, $output);
fclose($fp);

shell_exec("cd nginx && ./nginx -s stop && ../");
shell_exec("cd nginx && ./nginx && ../");

function startsWith($content, $needle) {
	return (strpos($content, $needle) === 0);
}

function split($content, $split) {
	return explode($split, $content);
}

function endsWith($content, $needle) {
	return (strlen($content) > strlen($needle)) ? (substr($content, -strlen($needle)) == $needle) : false;
}

function contains($content, $needle) {
	return strpos($content, $needle) !== false;
}
?>
