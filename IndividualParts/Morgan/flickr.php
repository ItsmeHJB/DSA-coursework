<?php

echo "<link rel='stylesheet' href='../flickr.css?v1.2'/>";
echo "<link href='https://fonts.googleapis.com/css?family=Istok+Web' rel='stylesheet'>";

$flickr_api_key = "6647e9a4c111684d91bf2c6d99bb176a";
$flickr_api_secret = "07b974fac2c176a1";

$url = "https://api.flickr.com/services/rest/?method=flickr.photos.search&api_key={$flickr_api_key}&format=json&woe_id={$woeid_city}";

$response = file_get_contents($url);

$response = str_replace("jsonFlickrApi(", "", $response);
$response = str_replace("})", "}", $response);

$response = json_decode($response);

//print_r($response);

$images = array();

echo "<div class = 'flickr'>";
echo "<div class = 'flickrtitle'>";
echo "<span class = 'flickrtitle'>Photos of {$name} from <a href = 'https://www.flickr.com'><span class = 'flick'>flick</span><span class = 'r'>r</span></a></span>";
echo "</div>";
echo "<div class = 'flickrcontent'>";
echo "<section id = 'photos'>";
for($i = 0; $i < 50; $i++){
  $farmid = $response->photos->photo[$i]->farm;
  $serverid = $response->photos->photo[$i]->server;
  $id = $response->photos->photo[$i]->id;
  $secret = $response->photos->photo[$i]->secret;
  $picture_url = "https://farm{$farmid}.staticflickr.com/{$serverid}/{$id}_{$secret}.jpg";
  array_push($images, $picture_url);
  echo "<img crossorigin='anonymous' id ='flickrImage{$name}{$i}' class = 'flickrimage' src='{$picture_url}'/>";
}
echo "</div>";
echo "</div>";

$images = json_encode($images);

print <<<EOT

  <script>
      images = [];
      imageURLs = {$images};
      str = "flickrImage";
      
      for(i = 0; i < 50; i++){
          thisID = str.concat("{$name}", i.toString());
          images.push(document.getElementById(thisID));
          console.log(images[i]);
          var storageFile = localStorage.getItem(thisID) || {},
            thisIDdate = "dateStored" + thisID,
            storageFileDate = localStorage.getItem(thisIDdate),
            date = new Date(),
            todaysDate = (date.getMonth() + 1).toString() + date.getDate().toString();
            
          // console.log("Typeof date: " + typeof storageFileDate);
          // console.log("storageDate: " + storageFileDate);
          // console.log("todaysDate: " + todaysDate);
          
          if(typeof storageFileDate === "undefined" || storageFileDate < todaysDate){
              

                  var imgCanvas = document.createElement("canvas"),
                      imgContext = imgCanvas.getContext("2d");
                  
                  imgCanvas.width = images[i].width;
                  imgCanvas.height = images[i].height;
                  
                  imgContext.drawImage(images[i], 0, 0, images[i].width, images[i].height);
                  
                  var imgAsDataURL = imgCanvas.toDataURL("image/jpeg");
                  
                  try{
                      localStorage.setItem(thisID, imgAsDataURL);
                      localStorage.setItem(thisIDdate, todaysDate);
                  }
                  catch(e){
                      console.log("Storage failed: " + e);
                  }
              
              images[i].setAttribute("src", imageURLs[i]);
              console.log("Saved image: " + (i + 1));
          }
          else{
              images[i].setAttribute("src", storageFile);
              console.log("Loaded image: " + (i + 1));
          }
      }
      
  </script>
EOT;

?>

