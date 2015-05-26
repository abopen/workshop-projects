<html>

<LINK href="index.css" rel="stylesheet" type="text/css">

<head>
<title>Kiosk Browser Control</title>
</head>

<body bgcolor="white" text="black">
<center><h1>Kiosk Browser Control</h1></center>


<form action="camsel.php" method="get">

<?php
if ($handle = fopen("/tmp/camcurr", "r")) {
	$cam = fgets($handle);
	fclose($handle);
} else {
	$cam = "";
}

if ($handle = fopen("camlist", "r")) {
	$count = 1;
	while (($line = fgets($handle)) !== false) {
		$label = preg_split("/[\s]+/", $line);

		if ($label[0] === $cam) {
			$colouropen = "<span style=\"color:red\">";
			$colourclose = "</span>";
		} else {
			$colouropen = "<span style=\"color:white\">";
			$colourclose = "</span>";
		}

		echo "$colouropen";
		if ($label[1] !== "") {
			echo "$count <input type=\"radio\" name=\"cam\" value=\"$label[0]\" />$label[0] ($label[1])<p>";
		} else {
			echo "$count $label[0] <input type=\"text\" name=\"url\"/><p>";
		}
		echo "$colourclose";

		$count = $count + 1;
	}
	fclose($handle);
}
?>

<p>

<p><input type="submit" value="Select"></p>
</form>


</body>

</html>
