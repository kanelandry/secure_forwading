<?php
/**
 * P2 is the script of the black-list check
 * For more details about it, please visit: http://blogspot.codijuana.com
 */
$redirectStatus = false;

if (isset($_GET["link"])) {
    $url = $_GET["link"];
   // $redirectStatus = $_GET["redirectStatus"];
   // if ($redirectStatus) {
    if (isset($_GET["redirectStatus"])) {
	    $redirectStatus = $_GET["redirectStatus"];
        error_log($url . "\n", 3, "../SecuredForwarding/bannedVisits.log");
        header("Location: " . $url);
        die();
    } else {
        $reputationStatus = blacklistAccessPoint($url);
        if ($reputationStatus) {
            redirectToClient($url);
        } else {
            header("Location: " . $url);
            die();
        }
    }
}


function redirectToClient($url)
{
    session_start();
    $_SESSION['urlToRedirect'] = $url;
    session_write_close();
    header("Location: p1.php");
    die();
}

function blacklistAccessPoint($url)
{
    $host = "localhost";
    $username = "root";
    $password = "No@dm1n";
    $schema = "mydb";

    $conn = mysql_connect($host, $username, $password);

    if (!$conn) {
        echo "Could not connect to database server \n";
        trigger_error(mysql_error(), E_USER_ERROR);
    } else {
        $db = mysql_select_db($schema);
        if ($db) {
            $domain = parse_url($url, PHP_URL_HOST);
            $query = "SELECT domain FROM urlindex where domain='" . $domain . "'";
            $resultSet = mysql_query($query);
            if ($resultSet) {
                if (mysql_num_rows($resultSet) > 0) {
                    return true;
                } else {
                    return false;
                }
            } else {
                echo "Could not get result set from database. \n";
                trigger_error(mysql_error(), E_USER_ERROR);
            }
        } else {
            echo "Could not find database schema. \n";
            trigger_error(mysql_error(), E_USER_ERROR);
        }
    }
    mysql_close();
}
