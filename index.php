<!DOCTYPE html>
<html>
    <head>
        <title>Hull - Rotterdam Information</title>
        <link rel = "stylesheet" href = "mainstyle.css?v1.3"/>
        <link rel="stylesheet" href="https://openlayers.org/en/v5.3.0/css/ol.css" type="text/css">
        <script src="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/build/ol.js"></script>
        <style type="text/css">
            #map{
                width:100%;
                height:45%;
            }
        </style>
    </head>
    <body>
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
    ?>
    <div class = "city">
        <span class = "cityname">Kingston-Upon Hull</span>
        <br/>
        <span class = "temp"><?php echo $hull_temp;?>°C</span>
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
    <hr style="width: 1px; height: 100%; display: inline-block; float: left; color: black;">
    <div class = "city">
        <span class = "cityname">Rotterdam</span>
        <br/>
        <span class = "temp"><?php echo $rotterdam_temp;?>°C</span>
        <br/>
        <span class = "windspeed"><?php echo substr($rotterdam_windspeed, 0, 4);?>mph</span>
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
        <span class = "link"><a href = "rotterdam/">More Info</a></span>
        </div>
        <?php
        $rotterdam_temp = $rotterdam_info_array[4];
        $rotterdam_windspeed = $rotterdam_info_array[1] * 1.151;
        ?>

        <div id="map" class="map"></div>

        <script type="text/javascript">

            var baseMapLayer = new ol.layer.Tile({
                source: new ol.source.OSM()
            });
            var map = new ol.Map({
                target: 'map',
                layers: [ baseMapLayer],
                view: new ol.View({
                    center: ol.proj.fromLonLat([2.397168, 52.75]),
                    zoom: 6
                })
            });

            //Adding markers on the map
            var marker1 = new ol.Feature({
                geometry: new ol.geom.Point(
                    ol.proj.fromLonLat([-0.339206, 53.743749])
                ),  // Cordinates of Hull's city centre
            });

            marker1.setStyle(new ol.style.Style({
                image: new ol.style.Icon(({
                    color: '#ff0000',
                    crossOrigin: 'anonymous',
                    src: 'dot.png'
                }))
            }));

            var marker2 = new ol.Feature({
                geometry: new ol.geom.Point(
                    ol.proj.fromLonLat([4.469634, 51.923936])
                ),  // Cordinates of Rotterdam's city centre
            });

            marker2.setStyle(new ol.style.Style({
                image: new ol.style.Icon(({
                    color: '#ff0000',
                    crossOrigin: 'anonymous',
                    src: 'dot.png'
                }))
            }));

            var vectorSource = new ol.source.Vector({
                features: [marker1, marker2]
            });
            var markerVectorLayer = new ol.layer.Vector({
                source: vectorSource,
            });
            map.addLayer(markerVectorLayer);

        </script>
    </body>
</html>
