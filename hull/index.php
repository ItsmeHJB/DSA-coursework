<html>
<head>
    <title>Kingston-Upon Hull Information</title>
    <link rel = "stylesheet" href = "hullstyle.css?v1.1"/>
    <script src="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/build/ol.js"></script>
</head>
<body>
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
    <span class = "temp"><?php echo $temp;?>°C</span>
    <br/>
    <span class = "rain"><?php echo $rain_amount;?>mm</span>
    <br/>
    <span class = "windspeed"><?php echo $windspeed;?>mph</span>
    <br/>
    <span class = "winddir"><?php echo $wind_direction;?>°</span>
    <br/>
    <span class = "humidity"><?php echo $humidity;?>%</span>
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