<html>
<head>
    <title>Rotterdam</title>
    <link rel = "stylesheet" href = "rotterdamstyle.css?v1.1"/>
    <script src="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/build/ol.js"></script>
</head>
<body>
    <?php
    $weather_info_array = explode(" ", file_get_contents("http://www.erkamp.eu/wdl/clientraw.txt"));
    $temp = $weather_info_array[4];
    $rain_amount = $weather_info_array[7];
    $windspeed = $weather_info_array[1] * 1.151;
    $wind_direction = $weather_info_array[3];
    $humidity = $weather_info_array[5];
    ?>
    <div class = "title">
    <span class = "cityname">Rotterdam Information</span>
    </div>
    <div class = "content">
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
                center: ol.proj.fromLonLat([4.4818, 51.9242]),
                zoom: 12
            })
        });
    </script>
</body>
</html>