<html>
    <head>
        <title>Hull - Rotterdam Information</title>
        <link rel = "stylesheet" href = "mainstyle.css"/>
        <link rel="stylesheet" href="https://openlayers.org/en/v5.3.0/css/ol.css" type="text/css">
        <script src="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/build/ol.js"></script>
        <script src="https://code.jquery.com/jquery-2.2.3.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <style>
            #marker {
                width: 20px;
                height: 20px;
                border: 1px solid #088;
                border-radius: 10px;
                background-color: #0FF;
                opacity: 0.5;
            }
            #hull {
                text-decoration: none;
                color: white;
                font-size: 11pt;
                font-weight: bold;
                text-shadow: black 0.1em 0.1em 0.2em;
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
                echo "overcase.png";
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
                echo "overcase.png";
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
</body>
        $rotterdam_temp = $rotterdam_info_array[4];
        $rotterdam_windspeed = $rotterdam_info_array[1] * 1.151;
        ?>
        <div class = "city">
            <span class = "cityname">Kingston-Upon Hull</span>
            <br/>
            <span class = "temp"><?php echo $hull_temp;?>°C</span>
            <br/>
            <span class = "windspeed"><?php echo $hull_windspeed;?>mph</span>
            <br/>
            <span class = "link"><a href = "/hull/">More Info</a></span>
        </div>
        <div class = "city">
            <span class = "cityname">Rotterdam</span>
            <br/>
            <span class = "temp"><?php echo $rotterdam_temp;?>°C</span>
            <br/>
            <span class = "windspeed"><?php echo $rotterdam_windspeed;?>mph</span>
            <br/>
            <span class = "link"><a href = "/rotterdam/">More Info</a></span>
        </div>

        <div id="map" class="map"></div>

        <script type="text/javascript">

            var map = new ol.Map({
                layers: [
                    new ol.layer.Tile({
                        source: new ol.source.OSM()
                    })
                ],
                target: 'map',
                view: new ol.View({
                    center: ol.proj.fromLonLat([2.397168, 52.75]),
                    zoom: 6
                })
            });

            var pos = ol.proj.fromLonLat([-0.3367413, 53.7456709]);

            var marker = new ol.Overlay({
                position: pos,
                positioning: 'center-center',
                element: document.getElementById('marker'),
                stopEvent: false
            });
            map.addOverlay(marker);

            // Vienna label
            var hull = new Overlay({
                position: pos,
                element: document.getElementById('hull')
            });
            map.addOverlay(hull);

            var popup = new ol.Overlay({
                element: document.getElementById('popup')
            });
            map.addOverlay(popup);

            map.on('click', function(evt) {
                var element = popup.getElement();
                var coordinate = evt.coordinate;
                var hdms = toStringHDMS(toLonLat(coordinate));

                $(element).popover('destroy');
                popup.setPosition(coordinate);
                $(element).popover({
                    placement: 'top',
                    animation: false,
                    html: true,
                    content: '<p>The location you clicked was:</p><code>' + hdms + '</code>'
                });
                $(element).popover('show');
            });

        </script>
    </body>
</html>
