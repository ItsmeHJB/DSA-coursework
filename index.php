<?php

session_start();
$config = simplexml_load_file("config.xml");
$_SESSION['db-hostname'] = $config->dbhostname->__toString();
$_SESSION['db-port'] = $config->dbport->__toString();
$_SESSION['db-username'] = $config->dbusername->__toString();
$_SESSION['db-password'] = $config->dbpassword->__toString();
$_SESSION['dark-sky-api-key'] = $config->darkskyapikey->__toString();

?>

<html>
<meta charset="UTF-8">
    <head>
        <title>Hull - Rotterdam Information</title>
        <link rel = "stylesheet" href = "mainstyle.css?v1.3"/>
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

        /// holds the content of the hull weather (from clientraw.txt) as a string.
        $hull_info_string = file_get_contents("http://www.ewwa.net/wx/clientraw.txt");

        if($hull_info_string == ""){
            $hull_info_string = file_get_contents("StaticData/hull.txt");
        }

        /// holds the hull weather in an array, each index has unique info.
        $hull_info_array = explode(" ", $hull_info_string);

        ///  holds the content of the rotterdam weather (from clientraw.txt) as a string.
        $rotterdam_info_string = file_get_contents("http://www.erkamp.eu/wdl/clientraw.txt");

        if($rotterdam_info_string == ""){
            $rotterdam_info_string = file_get_contents("StaticData/rotterdam.txt");
        }

        /// holds the rotterdam weather in an array, each index has unique info.
        $rotterdam_info_array = explode(" ", $rotterdam_info_string);

        /// current temperature in hull.
        $hull_temp = $hull_info_array[4];
        /// current windspeed in hull.
        $hull_windspeed = $hull_info_array[1] * 1.151;
        /// current weather type as an icon in hull.
        $hull_icon = $hull_info_array[48];

        /// current temperature in rotterdam.
        $rotterdam_temp = $rotterdam_info_array[4];
        /// current windspeed in rotterdam.
        $rotterdam_windspeed = $rotterdam_info_array[1] * 1.151;
        /// current weather type as an icon in rotterdam.
        $rotterdam_icon = $rotterdam_info_array[48];

        try{
            $db = new PDO('mysql:host='.$_SESSION['db-hostname'].';port='.$_SESSION['db-port'].';dbname=db_twincities', $_SESSION['db-username'], $_SESSION['db-password']);
            $dbq = $db->query("SELECT * FROM `tb_cities` WHERE `name` = 'Kingston-Upon Hull'");
            $row = $dbq->fetch(PDO::FETCH_ASSOC);
            $hull_woeid = $row['woeid_city'];
            $hull_name = $row['name'];
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
            $db = new PDO('mysql:host='.$_SESSION['db-hostname'].';port='.$_SESSION['db-port'].';dbname=db_twincities', $_SESSION['db-username'], $_SESSION['db-password']);
            $dbq = $db->query("SELECT * FROM `tb_cities` WHERE `name` = 'Rotterdam'");
            $row = $dbq->fetch(PDO::FETCH_ASSOC);
            $rotterdam_woeid = $row['woeid_city'];
            $rotterdam_name = $row['name'];
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

        $hull_url = 'https://api.darksky.net/forecast/'.$_SESSION['dark-sky-api-key'].'/'.$hull_lat.','.$hull_long;
        $rotterdam_url = 'https://api.darksky.net/forecast/'.$_SESSION['dark-sky-api-key'].'/'.$rotterdam_lat.','.$rotterdam_long;

        $hull_response = json_decode(file_get_contents($hull_url));
        $rotterdam_response = json_decode(file_get_contents($rotterdam_url));
    ?>
    <div class = "city">
        <span class = "cityname">Kingston-Upon Hull</span>
        <br/>
        <span class = "temp"><?php echo "Now: " . $hull_temp;?>°C</span>
        <br/>
        <span class = "temp">
          <?php
          for($i = 0; $i < 4; $i++){
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
          for($i = 0; $i < 4; $i++){
              switch($i){
                  case 0:
                      continue;
                      break;
                  case 1:
                      echo "Tomorrow: Hi: " . (string)substr(((($rotterdam_response->daily->data[$i]->temperatureHigh) - 32) / 1.8), 0, 4) . "°C Low: " . (string)substr(((($hull_response->daily->data[$i]->temperatureMin) - 32) / 1.8), 0, 4) . "°C <br/>";
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
            var clicked = false;
            var clickedName;

            // Create overlay to attach popup to map
            var overlay = new ol.Overlay({
                element: container,
                autoPan: false
            });

            // Click handler to hide popups
            closer.onclick = function() {
                overlay.setPosition(undefined);
                closer.blur();
                clicked = false;
                clickedName = null;
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

            //Adding markers on the map
            var marker1 = new ol.Feature({
                geometry: new ol.geom.Point(
                    ol.proj.fromLonLat([<?php echo $hull_long ?>, <?php echo $hull_lat ?>])
                ), // Cordinates of Hull's city centre from database
                name: "<?php echo $hull_name ?>",
                woeid: <?php echo $hull_woeid ?>,
                country: "<?php echo $hull_country ?>",
                population: "<?php echo $hull_pop ?>",
                currency: "<?php echo $hull_curr ?>",
                province: "<?php echo $hull_prov ?>",
                area: "<?php echo $hull_area ?>",
                website: "<?php echo $hull_web ?>"
            });

            marker1.setStyle(new ol.style.Style({
                image: new ol.style.Icon(({
                    color: '#ff0000',
                    crossOrigin: 'anonymous',
                    src: 'imageresources/dot.png'
                }))
            }));

            var marker2 = new ol.Feature({
                geometry: new ol.geom.Point(
                    ol.proj.fromLonLat([<?php echo $rotterdam_long ?>, <?php echo $rotterdam_lat ?>])
                ),  // Coordinates of Rotterdam's city centre
                name: "<?php echo $rotterdam_name ?>",
                woeid: <?php echo $rotterdam_woeid ?>,
                country: "<?php echo $rotterdam_country ?>",
                population: "<?php echo $rotterdam_pop ?>",
                currency: "<?php echo $rotterdam_curr ?>",
                province: "<?php echo $rotterdam_prov ?>",
                area: "<?php echo $rotterdam_area ?>",
                website: "<?php echo $rotterdam_web ?>"
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

            var hitTolerance = 0;

            // Click handler for map to create the popup
            map.on('pointermove', function(evt) {
                var hit = false;
                map.forEachFeatureAtPixel(evt.pixel, function(){
                  hit = true;
                }, {
                  hitTolerance: hitTolerance
                });
                if(hit) {
                    var featuresArray = map.getFeaturesAtPixel(evt.pixel, {
                        hitTolerance: hitTolerance
                    });

                    var featName = featuresArray[0].get('name');

                    if (featName != clickedName) {
                        clicked = false;
                        clickedName = null;

                        var featCountry = featuresArray[0].get('country');
                        var featPop = featuresArray[0].get('population');
                        var featCurr = featuresArray[0].get('currency');
                        var featProv = featuresArray[0].get('province');
                        var featArea = featuresArray[0].get('area');
                        var featWeb = featuresArray[0].get('website');

                        var featureCoords = featuresArray[0].getGeometry().getCoordinates();

                        content.innerHTML = "<h3>" + featName + "</h3>" +
                            "Country: " + featCountry + "<br/>Population: " + featPop + "<br/>" +
                            "Currency: " + featCurr + "<br/>Province: " + featProv + "<br/>" +
                            "Area: " + featArea + "km\xB2<br/>Website: <a href=" + featWeb + ">" + featWeb + "</a>";
                        overlay.setPosition(featureCoords);
                    }
                }
                else if (clicked == false) {
                    overlay.setPosition(null);
                }
            });

            map.on('singleclick', function(evt) {
                var hit = false;
                map.forEachFeatureAtPixel(evt.pixel, function(){
                    hit = true;
                }, {
                    hitTolerance: hitTolerance
                });
                if(hit) {
                    clicked = true;
                    var featuresArray = map.getFeaturesAtPixel(evt.pixel, {
                        hitTolerance: hitTolerance
                    });
                    var featName = featuresArray[0].get('name');
                    var featCountry = featuresArray[0].get('country');
                    var featPop = featuresArray[0].get('population');
                    var featCurr = featuresArray[0].get('currency');
                    var featProv = featuresArray[0].get('province');
                    var featArea = featuresArray[0].get('area');
                    var featWeb = featuresArray[0].get('website');

                    var featureCoords = featuresArray[0].getGeometry().getCoordinates();

                    clickedName = featName;

                    content.innerHTML = "<h3>" + featName + "</h3>" +
                        "Country: " + featCountry + "<br/>Population: " + featPop + "<br/>" +
                        "Currency: " + featCurr + "<br/>Province: " + featProv + "<br/>" +
                        "Area: " + featArea + "km\xB2<br/>Website: <a href=" + featWeb + ">" + featWeb + "</a>";
                    overlay.setPosition(featureCoords);
                }
            });
        </script>
    </body>
</html>
