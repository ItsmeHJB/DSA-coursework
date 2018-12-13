<html>
<head>
    <title>Rotterdam</title>
    <link rel = "stylesheet" href = "rotterdamstyle.css"/>
    <script src="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/build/ol.js"></script>
</head>
<body>
    <span class = "cityname">Rotterdam Information</span>
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