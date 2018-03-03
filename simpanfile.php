<?php
$folder = "upload/";
if (file_exists($folder.$_GET['file'])) {
	header("Content-Type: octet/stream");
	header("Content-Disposition: attachment;
		filename=\"".$_GET['file']."\"");
	$fp = fopen($folder.$_GET['file'], "r");
	$data = fread($fp, filesize($folder.$_GET['file']));
	fclose($fp);
	print $data;
}
?>