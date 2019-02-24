<?php

echo "<link rel='stylesheet' href='flickr.css'/>";
echo "<link href='https://fonts.googleapis.com/css?family=Istok+Web' rel='stylesheet'>";

$flickr_api_key = "6647e9a4c111684d91bf2c6d99bb176a";
$flickr_api_secret = "07b974fac2c176a1";

$woe_id = "25211";
$cityname = "Kingston-Upon Hull";

$url = "https://api.flickr.com/services/rest/?method=flickr.photos.search&api_key={$flickr_api_key}&format=json&woe_id={$woe_id}";

$response = file_get_contents($url);

$response = str_replace("jsonFlickrApi(", "", $response);
$response = str_replace("})", "}", $response);

$response = json_decode($response);

//print_r($response);

echo "<div class = 'flickr'>";
echo "<div class = 'title'>";
echo "<span class = 'flickrtitle'>Photos of {$cityname} from <a href = 'https://www.flickr.com'><span class = 'flick'>flick</span><span class = 'r'>r</span></a></span>";
echo "</div>";
echo "<div class = 'flickrcontent'>";
for($i = 0; $i < 50; $i++){
  $farmid = $response->photos->photo[$i]->farm;
  $serverid = $response->photos->photo[$i]->server;
  $id = $response->photos->photo[$i]->id;
  $secret = $response->photos->photo[$i]->secret;
  $picture_url = "https://farm{$farmid}.staticflickr.com/{$serverid}/{$id}_{$secret}.jpg";
  echo "<img class = 'flickrimage' src='{$picture_url}'/>";
}
echo "</div>";
echo "</div>";
?>
