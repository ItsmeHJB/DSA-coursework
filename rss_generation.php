<?php

header("Content-Type: application/xml; charset=utf-8");

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

        $rssfeed .= '<city>
        <name>'.$row['name'].'</name>
        <woeid_city>'.$row['woeid_city'].'</woeid_city>
        <link>'.$row['website'].'</link>
        <latitude>'.$row['latitude'].'</latitude>
        <longitude>'.$row['longitude'].'</longitude>
        <country>'.$row['country'].'</country>
        <population>'.$row['population'].'</population>
        <currency>'.$row['currency'].'</currency>
        <province>'.$row['province'].'</province>
        <city_area>'.$row['area'].'</city_area>
        <time_zone>'.$row['time_zone'].'</time_zone>
    </city>';
    }
}

$statement = $db->prepare("SELECT * FROM `tb_pois`");
$statement->execute();
$statement->setFetchMode(PDO::FETCH_ASSOC);

# Check we've got some results
if($statement->rowCount() > 0) {

    # Loop over the rows
    while($row = $statement->fetch()) {

        $rssfeed .= '<poi>
        <name>'.$row['name'].'</name>
        <woeid_poi>'.$row['woeid_poi'].'</woeid_poi>
        <latitude>'.$row['latitude'].'/</latitude>
        <longitude>'.$row['longitude'].'</longitude>
        <capacity>'.$row['capacity'].'</capacity>
        <cost>'.$row['cost'].'</cost>
        <launch>'.$row['launch'].'</launch>
        <website>'.$row['website'].'</website>
        <opening_time>'.$row['opening_time'].'</opening_time>
        <closing_time>'.$row['closing_time'].'</closing_time>
        <woeid_city>'.$row['woeid_city'].'</woeid_city>
    </poi>';
    }
}

$statement = $db->prepare("SELECT * FROM `tb_photos`");
$statement->execute();
$statement->setFetchMode(PDO::FETCH_ASSOC);

# Check we've got some results
if($statement->rowCount() > 0) {

    # Loop over the rows
    while($row = $statement->fetch()) {

        $rssfeed .= '<photo>
        <name>'.$row['name'].'</name>
        <photo_id>'.$row['photo_id'].'</photo_id>
        <woeid_poi>'.$row['woeid_poi'].'</woeid_poi>
        <woeid_city>'.$row['woeid_city'].'</woeid_city>
        <link>'.$row['link'].'</link>
    </photo>';
    }
}

$rssfeed .= '
	</channel>
</rss>';

echo $rssfeed;
