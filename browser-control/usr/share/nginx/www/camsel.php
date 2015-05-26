<?php

$url = "";

# Check for direct url from form
if (isset($_GET["url"])) {
  if ($_GET["url"] != "") {
	$url = $_GET["url"];
	$cam = "";
  }
}

# No url, compare cam label value passed from list file
if (($url === "") && (isset($_GET["cam"]))) {
	$cam = $_GET["cam"];
	if ($handle = fopen("camlist", "r")) {
		while (($line = fgets($handle)) !== false) {
			$label = preg_split("/[\s]+/", $line);
			if ($label[0] === $cam || $cam === "default") {
				$url = $label[1];
				$cam = $label[0];
				break;
			}
		}
		fclose($handle);
	}
}

if ($url === "") {
	exit("no url");
}

#echo "$url";

# Store current selection
if ($handle = fopen("/tmp/camcurr", "w")) {
	fputs($handle, $cam);
	fclose($handle);
}

# Call sudo to run script
exec("sudo -u pi /home/pi/camsel ". $url ."> /dev/null");

# Redirect
header('Location: /', true, 303);
die();

?>
