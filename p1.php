<?php
/**
* P1 is the client page from where the user clicks the unknown link
* For more details about it, please visit: http://blogspot.codijuana.com
* Code and simulation: Pradeep Samuel
* Algorithm and code review: Landry Kouajiep
*/
?>
<html>
<head>
    <title>P1 Page</title>
</head>
<body>
<!-- Client page -->
<a href="p2.php?link=<?php echo urlencode("http://www.google.com") ?>">www.google.com</a><br/>
<a href="p2.php?link=<?php echo urlencode("http://www.yahoo.com") ?>">www.yahoo.com</a><br/>
<a href="p2.php?link=<?php echo urlencode("http://www.aol.com") ?>">www.aol.com</a><br/>
<a href="p2.php?link=<?php echo urlencode("http://www.sypware-attack.com") ?>">www.sypware-attack.com</a><br/>

<?php

session_start();
if (isset($_SESSION['urlToRedirect'])) {
    $urlToRedirect = $_SESSION['urlToRedirect'];
}
session_destroy();

if (isset($urlToRedirect)) {
    echo "<script type='text/javascript'>";
    echo "var redirectStatus = confirm('the website " . $urlToRedirect . " might be harmful/malicious, do you want to continue?');";
    echo "if(redirectStatus){ window.location.replace('p2.php?redirectStatus=true&link=".$urlToRedirect."');}";
    echo "</script>";
}
?>
</body>
</html>
