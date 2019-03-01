<!DOCTYPE html>
<meta charset="UTF-8">
<head>
    <title>Kingston-Upon Hull Information</title>
    <link rel = "stylesheet" href = "hullstyle.css?v1.2"/>
    <link href='https://fonts.googleapis.com/css?family=Istok+Web' rel='stylesheet'>
    <script src="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/build/ol.js"></script>
</head>
<body>
    <div class = "navbar">
      <a href = "../">Home</a>
      <a href = "">Hull</a>
      <a href = "../rotterdam/">Rotterdam</a>
    </div>
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

      $poiCount= $db->query("SELECT COUNT(woeid_city) FROM tb_pois WHERE woeid_city = $woeid_city")->fetchColumn();
      $poiQuery = $db->query("SELECT * FROM `tb_pois` WHERE woeid_city = $woeid_city");

      $poisArray = array();

      for ($i = 0; $i < $poiCount; $i++) {
          $pois = $poiQuery->fetch(PDO::FETCH_ASSOC);

          $tempPoi = array(
              $pois['longitude'],
              $pois['latitude'],
              $pois['name'],
              $pois['capacity'],
              $pois['cost'],
              $pois['launch'],
              $pois['website'],
              $pois['opening_time'],
              $pois['closing_time']
          );

          $poisArray[] = $tempPoi;
      }

      $db = null;
      $dbq = null;

      /*echo "This is the city of {$name} ({$lat}, {$long}). ";
      echo "It is in {$province} ({$country}). There is a ";
      echo "population of {$population}. It has an area of {$area}km2.";*/

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

    <div id="map" class="map"></div>
    <div id="popup" class="ol-popup">
        <a href="#" id="popup-closer" class="ol-popup-closer"></a>
        <div id="popup-content"></div>
    </div>

    <script type="text/javascript">
        var container = document.getElementById('popup');
        var content = document.getElementById('popup-content');
        var closer = document.getElementById('popup-closer');

        // Create overlay to attach popup to map
        var overlay = new ol.Overlay({
            element: container,
            autoPan: false
        });

        // Click handler to hide popups
        closer.onclick = function() {
            overlay.setPosition(undefined);
            closer.blur();
            return false;
        };

        // Create the map
        var map = new ol.Map({
            target: 'map',
            layers: [
                new ol.layer.Tile({
                    source: new ol.source.OSM()
                })
            ],
            overlays: [overlay],
            view: new ol.View({
                center: ol.proj.fromLonLat([<?php echo $long ?>, <?php echo $lat ?>]),
                zoom: 13
            })
        });

        //convert pois array in php to js
        var pois = <?php echo json_encode($poisArray); ?>;

        //Adding markers on the map in a for...in loop
        var x;
        var markers = [];
        for (x in pois) {
            var feature = new ol.Feature({
                geometry: new ol.geom.Point(
                    ol.proj.fromLonLat([pois[x][0], pois[x][1]])
                ),  // Add's point to the coordinates from the database
                name: pois[x][2],
                capacity: pois[x][3],
                cost: pois[x][4],
                launch: pois[x][5],
                website: pois[x][6],
                opening: pois[x][7],
                closing: pois[x][8]
            });

            feature.setStyle(new ol.style.Style({
                image: new ol.style.Icon(({
                    color: '#ff0000',
                    crossOrigin: 'anonymous',
                    src: 'imageresources/dot.png'
                }))
            }));

            markers.push(feature);
        }

        //console.log(markers[0].get('name'));

        var vectorSource = new ol.source.Vector({
            features: []
        });
        for (i in markers){
            vectorSource.addFeature(markers[i]);
        }

        var markerVectorLayer = new ol.layer.Vector({
            source: vectorSource,
        });
        map.addLayer(markerVectorLayer);

    </script>
</body>
</html>
