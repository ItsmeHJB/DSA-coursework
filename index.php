<!DOCTYPE html>
<html>
<meta charset="UTF-8">
    <head>
        <title>Hull - Rotterdam Information</title>
        <link rel = "stylesheet" href = "mainstyle.css?v1.4"/>
        <link rel="stylesheet" href="https://openlayers.org/en/v5.3.0/css/ol.css" type="text/css">
        <link href='https://fonts.googleapis.com/css?family=Istok+Web' rel='stylesheet'>
        <script src="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/build/ol.js"></script>
    </head>
    <body>
        <div class = "navbar">
          <a href = "">Home</a>
          <a href = "hull/">Hull</a>
          <a href = "rotterdam/">Rotterdam</a>
        </div>
        <?php

        $hull_info_string = file_get_contents("http://www.ewwa.net/wx/clientraw.txt");
        $hull_info_array = explode(" ", $hull_info_string);

        $rotterdam_info_string = file_get_contents("http://www.erkamp.eu/wdl/clientraw.txt");
        $rotterdam_info_array = explode(" ", $rotterdam_info_string);

        $hull_temp = $hull_info_array[4];
        $hull_windspeed = $hull_info_array[1] * 1.151;
        $hull_icon = $hull_info_array[48];
        $hull_temp = $hull_info_array[4];
        $hull_windspeed = $hull_info_array[1] * 1.151;

        $rotterdam_temp = $rotterdam_info_array[4];
        $rotterdam_windspeed = $rotterdam_info_array[1] * 1.151;
        $rotterdam_icon = $rotterdam_info_array[48];

        try{
          $db = new PDO('mysql:host=51.75.162.4;port=3306;dbname=db_twincities', "username", "password");
          $dbq = $db->query("SELECT * FROM `tb_cities` WHERE `name` = 'Kingston-Upon Hull'");
          $row = $dbq->fetch(PDO::FETCH_ASSOC);
          $hull_lat = $row['latitude'];
          $hull_long = $row['longitude'];
          $hull_country = $row['country'];
          $hull_pop = $row['population'];
          $hull_curr = $row['currency'];
          $hull_prov = $row['province'];
          $hull_area = $row['area'];
          $hull_web = $row['website'];

          $db = null;
          $dbq = null;
        }
        catch (PDOException $e){
          echo "Error!: " . $e->getMessage() . "<br/>";
          die();
        }

        try{
          $db = new PDO('mysql:host=51.75.162.4;port=3306;dbname=db_twincities', "username", "password");
          $dbq = $db->query("SELECT * FROM `tb_cities` WHERE `name` = 'Rotterdam'");
          $row = $dbq->fetch(PDO::FETCH_ASSOC);
          $rotterdam_lat = $row['latitude'];
          $rotterdam_long = $row['longitude'];
          $rotterdam_country = $row['country'];
          $rotterdam_pop = $row['population'];
          $rotterdam_curr = $row['currency'];
          $rotterdam_prov = $row['province'];
          $rotterdam_area = $row['area'];
          $rotterdam_web = $row['website'];

          $db = null;
          $dbq = null;
        }
        catch (PDOException $e){
          echo "Error!: " . $e->getMessage() . "<br/>";
          die();
        }

        $dark_sky_api_key = 'f5d3e696f6c590a25f1de6811d30d390';

        $hull_url = 'https://api.darksky.net/forecast/'.$dark_sky_api_key.'/'.$hull_lat.','.$hull_long;
        $rotterdam_url = 'https://api.darksky.net/forecast/'.$dark_sky_api_key.'/'.$rotterdam_lat.','.$rotterdam_long;

        $hull_response = json_decode(file_get_contents($hull_url));
        $rotterdam_response = json_decode(file_get_contents($rotterdam_url));

        // for($i = 0; $i < 5; $i++){
        //   echo $hull_response->daily->data[$i]->temperature . "<br/>";
        // }
    ?>
    <div class = "city">
        <span class = "cityname">Kingston-Upon Hull</span>
        <br/>
        <span class = "temp"><?php echo "Now: " . $hull_temp;?>°C</span>
        <br/>
        <span class = "temp">
          <?php
          for($i = 0; $i < 5; $i++){
            switch($i){
              case 0:
                continue;
                break;
              case 1:
                echo "Tomorrow: Hi: " . (string)substr(((($hull_response->daily->data[$i]->temperatureHigh) - 32) / 1.8), 0, 4) . "°C Low: " . (string)substr(((($hull_response->daily->data[$i]->temperatureMin) - 32) / 1.8), 0, 4) . "°C <br/>";
                break;
              default:
                echo date('D', $hull_response->daily->data[$i]->time) . ": Hi: " . (string)substr(((($hull_response->daily->data[$i]->temperatureHigh) - 32) / 1.8), 0, 4) . "°C Low: " . (string)substr(((($hull_response->daily->data[$i]->temperatureMin) - 32) / 1.8), 0, 4) . "°C <br/>";
                break;
            }
          }
          ?></span>
          <br/>
        <span class = "windspeed"><?php echo substr($hull_windspeed, 0, 4);?>mph</span>
        <br/>
        <img class = "icon" src = "imageresources/<?php
        switch($hull_icon) {
            case 0:
                echo "sunny.png";
                break;
            case 1:
                echo "clearnight.png";
                break;
            case 2:
            case 3:
                echo "cloudy.png";
                break;
            case 4:
                echo "cloudynight.png";
                break;
            case 5:
                echo "sunny.png";
                break;
            case 6:
                echo "fog.png";
                break;
            case 7:
                echo "hazy.png";
                break;
            case 8:
                echo "heavyrain.png";
                break;
            case 9:
                echo "overcast.png";
                break;
            case 10:
                echo "fog.png";
                break;
            case 11:
                echo "nightfog.png";
                break;
            case 12:
                echo "nightheavyrain.png";
                break;
            case 13:
                echo "cloudynight.png";
                break;
            case 14:
            case 15:
                echo "nightheavyrain.png";
                break;
            case 16:
                echo "nightsnow.png";
                break;
            case 17:
                echo "nightthinder.png";
                break;
            case 18:
            case 19:
                echo "overcast.png";
                break;
            case 20:
                echo "rain.png";
                break;
            case 21:
            case 22:
                echo "heavyrain.png";
                break;
            case 23:
                echo "sleet.png";
                break;
            case 24:
                echo "sleet.png";
                break;
            case 25:
                echo "snow.png";
                break;
            case 26:
                echo "snowmelt.png";
                break;
            case 27:
                echo "snow.png";
                break;
            case 28:
                echo "sunny.png";
                break;
            case 29:
                echo "thunder.png";
                break;
            case 30:
                echo "thunder.png";
                break;
            case 31:
                echo "thunder.png";
                break;
            case 32:
                echo "tornadowarning.png";
                break;
            case 33:
                echo "windy.png";
                break;
            case 34:
                echo "stoppedraining.png";
                break;
            case 35:
                echo "windyrain.png";
                break;
        }
        ?>"/>
        <br/>
        <span class = "link"><a href = "hull/">More Info</a></span>
    </div>
    <hr style="width: 1px; height: 50%; display: inline-block; float: left;">
    <div class = "city">
        <span class = "cityname">Rotterdam</span>
        <br/>
        <span class = "temp"><?php echo "Now: " . $rotterdam_temp;?>°C</span>
        <br/>
        <span class = "temp">
          <?php
          for($i = 0; $i < 5; $i++){
            switch($i){
              case 0:
                continue;
                break;
              case 1:
                echo "Tomorrow: Hi: " . (string)substr(((($rotterdam_response->daily->data[$i]->temperatureHigh) - 32) / 1.8), 0, 4) . "°C Low: " . (string)substr(((($rotterdam_response->daily->data[$i]->temperatureMin) - 32) / 1.8), 0, 4) . "°C <br/>";
                break;
              default:
                echo date('D', $rotterdam_response->daily->data[$i]->time) . ": Hi: " . (string)substr(((($rotterdam_response->daily->data[$i]->temperatureHigh) - 32) / 1.8), 0, 4) . "°C Low: " . (string)substr(((($rotterdam_response->daily->data[$i]->temperatureMin) - 32) / 1.8), 0, 4) . "°C <br/>";
                break;
            }
          }
          ?></span>
          <br/>
        <span class = "windspeed"><?php echo substr($rotterdam_windspeed, 0, 4);?>mph</span>
        <br/>
        <img class = "icon" src = "imageresources/<?php
        switch($rotterdam_icon) {
            case 0:
                echo "sunny.png";
                break;
            case 1:
                echo "clearnight.png";
                break;
            case 2:
            case 3:
                echo "cloudy.png";
                break;
            case 4:
                echo "cloudynight.png";
                break;
            case 5:
                echo "sunny.png";
                break;
            case 6:
                echo "fog.png";
                break;
            case 7:
                echo "hazy.png";
                break;
            case 8:
                echo "heavyrain.png";
                break;
            case 9:
                echo "overcast.png";
                break;
            case 10:
                echo "fog.png";
                break;
            case 11:
                echo "nightfog.png";
                break;
            case 12:
                echo "nightheavyrain.png";
                break;
            case 13:
                echo "cloudynight.png";
                break;
            case 14:
            case 15:
                echo "nightheavyrain.png";
                break;
            case 16:
                echo "nightsnow.png";
                break;
            case 17:
                echo "nightthinder.png";
                break;
            case 18:
            case 19:
                echo "overcast.png";
                break;
            case 20:
                echo "rain.png";
                break;
            case 21:
            case 22:
                echo "heavyrain.png";
                break;
            case 23:
                echo "sleet.png";
                break;
            case 24:
                echo "sleet.png";
                break;
            case 25:
                echo "snow.png";
                break;
            case 26:
                echo "snowmelt.png";
                break;
            case 27:
                echo "snow.png";
                break;
            case 28:
                echo "sunny.png";
                break;
            case 29:
                echo "thunder.png";
                break;
            case 30:
                echo "thunder.png";
                break;
            case 31:
                echo "thunder.png";
                break;
            case 32:
                echo "tornadowarning.png";
                break;
            case 33:
                echo "windy.png";
                break;
            case 34:
                echo "stoppedraining.png";
                break;
            case 35:
                echo "windyrain.png";
                break;
        }
        ?>"/>
        <br/>
        <span class = "link"><a href = "rotterdam/">More Info</a></span>
        </div>
        <?php
        $rotterdam_temp = $rotterdam_info_array[4];
        $rotterdam_windspeed = $rotterdam_info_array[1] * 1.151;
        ?>
        <br/>

        <div id="map" class="map"></div>
        <div id="popup" class="ol-popup">
            <a href="#" id="popup-closer" class="ol-popup-closer"></a>
            <div id="popup-content"></div>
        </div>

        <script type="text/javascript">
            // Elements used in the popup
            var container = document.getElementById('popup');
            var content = document.getElementById('popup-content');
            var closer = document.getElementById('popup-closer');

            // Create overlay too attach popup to map
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
                layers: [
                    new ol.layer.Tile({
                        source: new ol.source.OSM()
                    })
                ],
                overlays: [overlay],
                target: 'map',
                view: new ol.View({
                    center: ol.proj.fromLonLat([2.397168, 52.75]),
                    zoom: 6
                })
            });

            var hullLon = parseFloat("<?php echo $hull_long ?>");
            var hullLat = parseFloat("<?php echo $hull_lat ?>");

            //Adding markers on the map
            var marker1 = new ol.Feature({
                geometry: new ol.geom.Point(
                    ol.proj.fromLonLat([hullLon, hullLat])
                ),  // Cordinates of Hull's city centre
            });

            marker1.setStyle(new ol.style.Style({
                image: new ol.style.Icon(({
                    color: '#ff0000',
                    crossOrigin: 'anonymous',
                    src: 'imageresources/dot.png'
                }))
            }));

            var rottLon = parseFloat("<?php echo $rotterdam_long ?>");
            var rottLat = parseFloat("<?php echo $rotterdam_lat ?>");

            var marker2 = new ol.Feature({
                geometry: new ol.geom.Point(
                    ol.proj.fromLonLat([rottLon, rottLat])
                ),  // Cordinates of Rotterdam's city centre
            });

            marker2.setStyle(new ol.style.Style({
                image: new ol.style.Icon(({
                    color: '#ff0000',
                    crossOrigin: 'anonymous',
                    src: 'imageresources/dot.png'
                }))
            }));

            var vectorSource = new ol.source.Vector({
                features: [marker1, marker2]
            });
            var markerVectorLayer = new ol.layer.Vector({
                source: vectorSource,
            });
            map.addLayer(markerVectorLayer);

            var hull_popup = '<h3>Hull Info</h3>\
            Country: <?php echo $hull_country;?><br/>\
            Population: <?php echo $hull_pop;?><br/>\
            Currency: <?php echo $hull_curr;?><br/>\
            Province: <?php echo $hull_prov;?><br/>\
            Area: <?php echo $hull_area;?>km\xB2<br/>\
            Wesbite: <a href="<?php echo $hull_web;?>">hull.gov.uk</a>';

            var rotterdam_popup = '<h3>Rotterdam Info</h3>\
            Country: <?php echo $rotterdam_country;?><br/>\
            Population: <?php echo $rotterdam_pop;?><br/>\
            Currency: <?php echo $rotterdam_curr;?><br/>\
            Province: <?php echo $rotterdam_prov;?><br/>\
            Area: <?php echo $rotterdam_area;?>km\xB2<br/>\
            Wesbite: <a href="<?php echo $rotterdam_web;?>">rotterdam.nl</a>';

            // Click handler for map to create the popup
            map.on('pointermove', function(evt) {
                var coordinate = evt.coordinate;
                var string_coor = ol.proj.toLonLat(coordinate);
                console.log(string_coor);
                if(string_coor[0] > -0.6 && string_coor[0] < -0.01){
                  if(string_coor[1] > 53.6 && string_coor[1] < 53.9){
                    content.innerHTML = hull_popup;
                    overlay.setPosition(ol.proj.fromLonLat([-0.339206, 53.743749]));
                  }
                }
                else if(string_coor[0] > 4.2 && string_coor[0] < 4.6){
                  if(string_coor[1] > 51.7 && string_coor[1] < 52.09){
                    content.innerHTML = rotterdam_popup;
                    overlay.setPosition(ol.proj.fromLonLat([4.469634, 51.923936]));
                  }
                }
            });

        </script>
    </body>
</html>
