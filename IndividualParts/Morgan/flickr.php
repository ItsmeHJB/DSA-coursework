<?php

$flickr_api_key = "6647e9a4c111684d91bf2c6d99bb176a";
$flickr_api_secret = "07b974fac2c176a1";

$woe_id = "25211";

$url = "https://api.flickr.com/services/rest/?method=flickr.photos.search&api_key={$flickr_api_key}&format=json&woe_id={$woe_id}";

$response = file_get_contents($url);

$response = str_replace("jsonFlickrApi(", "", $response);
$response = str_replace("})", "}", $response);

$response = json_decode($response);

//print_r($response);

for($i = 0; $i < 50; $i++){
  $farmid = $response->photos->photo[$i]->farm;
  $serverid = $response->photos->photo[$i]->server;
  $id = $response->photos->photo[$i]->id;
  $secret = $response->photos->photo[$i]->secret;
  $picture_url = "https://farm{$farmid}.staticflickr.com/{$serverid}/{$id}_{$secret}.jpg";
  echo "<img src='{$picture_url}'/>";
  echo $picture_url;
  echo "<br/>";
}
?>
