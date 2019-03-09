<?php

header("Content-Type: application/rss+xml; charset=ISO-8859-1");

try{
    $db = new PDO('mysql:host=51.75.162.4;port=3306;dbname=db_twincities', "username", "password");
}
catch(PDOException $e){
    echo $e->getMessage();
}

$rssfeed = '<?xml version="1.0" encoding="ISO-8859-1"?>
<rss version="2.0">
	<channel>
		<title>Hull-Rotterdam Information</title>
		<description>RSS detailing the information for Hull and Rotterdam</description>
		<language>en-gb</language>';

$statement = $db->prepare("SELECT * FROM `tb_cities`");
$statement->execute();
$statement->setFetchMode(PDO::FETCH_ASSOC);

# Check we've got some results
if($statement->rowCount() > 0) {

    # Loop over the rows
    while($row = $statement->fetch()) {

        $rssfeed .= '<item>
        <title>'.$row['name'].'</title>
        <description>'.$row['woeid_city'].'</description>
        <link>'.$row['website'].'</link>
        <latitude>'.$row['latitude'].'</latitude>
        <longitude>'.$row['longitude'].'</longitude>
        <country>'.$row['country'].'</country>
        <population>'.$row['population'].'</population>
        <currency>'.$row['currency'].'</currency>
        <province>'.$row['province'].'</province>
        <city_area>'.$row['area'].'</city_area>
        <time_zone>'.$row['time_zone'].'</time_zone>
    </item>';

    }

}

$rssfeed .= '
	</channel>
</rss>';

echo $rssfeed;