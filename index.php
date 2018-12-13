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
