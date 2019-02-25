<html>
<head>
    <title>Kingston-Upon Hull Information</title>
    <link rel = "stylesheet" href = "hullstyle.css?v1.1"/>
    <script src="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/build/ol.js"></script>
</head>
<body>
    <?php try{
      $db = new PDO('mysql:host=51.75.162.4;port=3306;dbname=db_twincities', "username", "password");
      $dbq = $db->query("SELECT * FROM `tb_cities` WHERE `name` = 'Kingston-Upon Hull'");
      $row = $dbq->fetch(PDO::FETCH_ASSOC);
      $woeid_city = $row['woeid_city'];
      $name = $row['name'];
      $lat = $row['latitude'];
      $long = $row['longitude'];
      $country = $row['country'];
      $population = $row['population'];
      $currency = $row['currency'];
      $province = $row['province'];
      $area = $row['area'];
      $time_zone = $row['time_zone'];
      $website = $row['website'];

      $db = null;
      $dbq = null;

      echo "This is the city of {$name} ({$lat}, {$long}). ";
      echo "It is in {$province} ({$country}). There is a ";
      echo "population of {$population}. It has an area of {$area}km2.";

    }
    catch (PDOException $e){
      echo "Error!: " . $e->getMessage() . "<br/>";
      die();
    }
    ?>
    <div class = "title">
    <span class = "cityname">Kingston-Upon Hull Information</span>
    </div>
    <div class = "content">
    <?php
    $weather_info_array = explode( " ", file_get_contents("http://www.ewwa.net/wx/clientraw.txt"));
    $temp = $weather_info_array[4];
    $rain_amount = $weather_info_array[7];
    $windspeed = $weather_info_array[1] * 1.151;
    $wind_direction = $weather_info_array[3];
    $humidity = $weather_info_array[5];
    ?>
    <br/>
    <span class = "temp">Temperature: <?php echo $temp;?>°C</span>
    <br/>
    <span class = "rain">Rain Today: <?php echo $rain_amount;?>mm</span>
    <br/>
    <span class = "windspeed">Wind Speed: <?php echo $windspeed;?>mph</span>
    <br/>
    <span class = "winddir">Wind Direction: <?php echo $wind_direction."°";
    if($wind_direction >= 337.5 || $wind_direction < 22.5){
        echo " (N)";
    }
    elseif($wind_direction >= 22.5 && $wind_direction < 67.5){
        echo " (NE)";
    }
    elseif($wind_direction >= 67.5 && $wind_direction < 112.5){
        echo " (E)";
    }
    elseif($wind_direction >= 112.5 && $wind_direction < 157.5){
        echo " (SE)";
    }
    elseif($wind_direction >= 157.5 && $wind_direction < 202.5){
        echo " (S)";
    }
    elseif($wind_direction >= 202.5 && $wind_direction < 247.5){
        echo " (SW)";
    }
    elseif($wind_direction >= 247.5 && $wind_direction < 292.5){
        echo " (W)";
    }
    elseif($wind_direction >= 292.5 && $wind_direction < 337.5){
        echo " (NW)";
    }
    ?></span>
    <br/>
    <span class = "humidity">Outside Humidity: <?php echo $humidity;?>%</span>
    <br/>
    </div>
    <div id="map1" class="map"></div>
    <script type="text/javascript">
        var map1 = new ol.Map({
            target: 'map1',
            layers: [
                new ol.layer.Tile({
                    source: new ol.source.OSM()
                })
            ],
            view: new ol.View({
                center: ol.proj.fromLonLat([-0.3367413, 53.7456709]),
                zoom: 13
            })
        });
    </script>
</body>
</html>
