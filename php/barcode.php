<?php

$servername = "localhost";
$username = "root";
$password = "";

try {
  $conn = new PDO("mysql:host=$servername;dbname=GiftVouchers", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

// set GET values in variables
$numberAmount = $_GET["numberAmount"]; // INT
$serienummerCount = $_GET["serienummerCount"]; // INT

// barcode kan max 23 nummers zijn
// create unique serialnumbers with given number amount
// set the minimun and maximum range of serialnumbers
$min = '';
for ($x = 0; $x < $numberAmount; $x++) {
  $min .= '1';
}
$max = str_replace("1", "9", $min);

// make chekable database and import existing serielnumbers
// create array of unique serialnumbers
$uniqueSerialnumbers = array();
for ($x = 0; $x < $serienummerCount; $x++) {
  $uniqueSerialnumber = rand($min,$max);
  //TODO check if unique

  // if unique add to array
  array_push($uniqueSerialnumbers, $uniqueSerialnumber);
}

// create svg html nodes to put in the html
$svgHtmlElements = '';
$svgElement = '';
foreach ($uniqueSerialnumbers as $key => $value) {
  $svgElement = '<svg id="barcode' . $key . '" serialnumber="' . $value . '" ></svg>';
  $svgHtmlElements .= $svgElement;
}

// generate html with barcodes
$doc = new DOMDocument();
$doc->loadHTML('
<!DOCTYPE html>
<html>
<head>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jsbarcode/3.11.3/JsBarcode.all.min.js"></script>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div id="content">
    ' . $svgHtmlElements . '
</div>

<script src="../javascript/main.js"></script>

</body>
</html>
  ');

echo $doc->saveHTML();

?>