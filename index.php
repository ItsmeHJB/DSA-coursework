<html>
<head>
    <title>Hull - Rotterdam Information</title>
    <link rel = "stylesheet" href = "mainstyle.css"/>
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
</body>
</html>