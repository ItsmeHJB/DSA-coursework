<?php
header("Content-Type: application/xml; charset=utf-8");
function linkElementCity($woeid_city, $name, $latitude , $longitude, $country, $population, $currency, $province, $area, $time_zone, $website) {
    echo    '<item>'. PHP_EOL;
    echo        '<name>'.$name.'</name>'. PHP_EOL;
    echo        '<woeid_city>'.$woeid_city.'</woeid_city>'. PHP_EOL;
    echo        '<latitude>'.$latitude.'/</latitude>'. PHP_EOL;
    echo        '<longitude>'.$longitude.'</longitude>'. PHP_EOL;
    echo        '<country>'.$country.'</country>'. PHP_EOL;
    echo        '<population>'.$population.'</population>'. PHP_EOL;
    echo        '<currency>'.$currency.'</currency>'. PHP_EOL;
    echo        '<province>'.$province.'</province>'. PHP_EOL;
    echo        '<area>'.$area.'</area>'. PHP_EOL;
    echo        '<time_zone>'.$time_zone.'</time_zone>'. PHP_EOL;
    echo        '<website>'.$website.'</website>'. PHP_EOL;
    echo    '</item>'. PHP_EOL;
}
//start rss output
echo '<?xml version="1.0" encoding="utf-8"?>'. PHP_EOL;
echo '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">'. PHP_EOL;
echo    '<channel>'. PHP_EOL;
echo    "<title>Web Design and Development Tutorials</title>". PHP_EOL;
echo    '<link>http://www.afterhoursprogramming.com</link>'. PHP_EOL;
echo    '<description></description>'. PHP_EOL;
echo    '<language>en-us</language>'. PHP_EOL;
echo    '<copyright></copyright>'. PHP_EOL;
echo    '<atom:link href="http://www.afterhoursprogramming.com/services/rss/" rel="self" type="application/rss+xml" />'. PHP_EOL;

//add elements here
// $hostName = '51.75.162.4';
// $dbName = 'db_twincities';
// $username = 'username';
// $password = 'password';
// $dbConnection = new PDO("mysql:host=".$hostName.";port=8090;dbname=".$dbName, $username, $password);
// $sql = 'SELECT * FROM tb_city';
// $query = $dbConnection->prepare($sql);
// $query->execute();
// $queryResults = $query->fetchAll();
// foreach ($queryResults as $result) {
//    linkElementCity($result['woeid_city'], $result['name'], $result['latitude'], $result['longitude'], $result['country'], $result['population'], $result['currency'], $result['province'], $result['area'], $result['time_zone'], $result['website']);
// }


$db = new PDO('mysql:host=51.75.162.4;port=3306;dbname=db_twincities', "username", "password");
for($i = 0;$i < 2; $i++){

  $dbq = $db->query("SELECT * FROM `tb_cities` WHERE 'time_zone' = $i");

  $row = $dbq->fetch(PDO::FETCH_ASSOC);
  $woe = $row['woeid_city'];
  $name = $row['name'];
  $lat = $row['latitude'];
  $long = $row['longitude'];
  $country = $row['country'];
  $pop = $row['population'];
  $cur = $row['currency'];
  $prov = $row['province'];
  $area = $row['area'];
  $tz = $row['time_zone'];
  $website = $row['website'];

  linkElementCity($woe, $name, $lat, $long, $country, $pop, $cur, $prov, $area, $tz, $website);
}

$db = null;
$dbq = null;
//end of adding elements

echo    '</channel>'. PHP_EOL;
echo '</rss>'. PHP_EOL;
?>
