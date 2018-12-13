<html>
<head>
    <title>Kingston-Upon Hull Information</title>
    <link rel = "stylesheet" href = "hullstyle.css"/>
    <script src="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/build/ol.js"></script>
</head>
<body>
    <span class = "cityname">Kingston-Upon Hull Information</span>
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