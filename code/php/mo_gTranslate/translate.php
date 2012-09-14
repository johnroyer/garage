<html>
<head>
<style type="text/css">

table {
   border-style: solid;
   border-width: 1px;
}

td {
   border-style: solid;
   border-width: 1px;
}
</style>

</head>
<body>
<?php

$key = "your-google-api-key";
//$url = "https://www.googleapis.com/language/translate/v2?key=$key&source=fr&target=zh-TW&q=";
$url = "https://www.googleapis.com/language/translate/v2?key=$key&target=zh-TW&q=";

$str = "check it out";
//$json = getUrl($url . urlencode($str));
//getResult($json);
?>
<table style="border-style:solid; border-width: 1px;">

<?php
require("file_to_translate.mo");
foreach( $lang as $key => $val ){
   echo "<tr>";
   echo "<td>$key";
   echo "<td>$val";
   echo "<td>". getResult( getUrl($url.urlencode($val)) );
}
echo "</table>";

function getResult($in)
{
   $a = json_decode($in);
   $a = $a->data;
   $a = $a->translations;
   $out = $a[0]->translatedText;
   return $out;
}


function getUrl($url)
{
   //curl
   $cu = curl_init($url);
   curl_setopt($cu, CURLOPT_RETURNTRANSFER, true);
   $out = curl_exec($cu);
   return $out;
}

?>

</body>
</html>
