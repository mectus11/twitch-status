<!DOCTYPE html>
<html lang="en">
<?php
// The settings for the kraken twitch API.
$channels = array('TheSimSupply');
// You can set a sound of your own to play if the stream is online
$file='ding.mp3';
$callAPI = implode(",",$channels);
$arrContextOptions=array(
"ssl"=>array(
"verify_peer"=>false,
"verify_peer_name"=>false,
),
);
$dataArray = json_decode(file_get_contents('https://api.twitch.tv/kraken/streams?channel=' . $callAPI, false, stream_context_create($arrContextOptions)), true);

foreach($dataArray['streams'] as $mydata){

if($mydata['_id'] != null){
    $name      = $mydata['channel']['display_name'];
    $game      = $mydata['channel']['game'];
    $url       = $mydata['channel']['url'];       
  
  // If the stream is online, this message will be sent plus a button to the channel
  $reply2= "<p>There is currently a stream going on: &nbsp;
  <img src='online.png' title='Offline' alt='Offline' height='15' width='15' /></br>
  <a class='normalbutton' href='https://twitch.tv/channelname'>Check it out now!</a>
  </p>
  <audio controls autoplay loop>
  <source src='ding.mp3' type='audio/mpeg'>
  </audio>
  ";
}
else{
    echo "<p>Offline</p>";
}

}
if($dataArray['streams'] == null or $dataArray['streams'] == "")
  {
  // If the stream is offlien this message will be sent
  $reply1 = "
  <p>There is currently no live stream: &nbsp;
  <img src='offline.png' title='Offline' alt='Offline' height='15' width='15' /></br>
  This page will refresh each 5 minutes or you can do it manually!
  </p>";
  }
?>

    <head>
        <meta http-equiv="refresh" content="300">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Twitch Status</title>
        <link href="css/essentials.css" rel="stylesheet">
		<link href="css/menu.css" rel="stylesheet">
		<link href="css/buttons.css" rel="stylesheet">
		<link href="css/columns.css" rel="stylesheet">
        <script src="js/script.js"></script>
		<script src="js/tabs.js"></script>
		<link href='http://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>
    </head>
	
	
	<body>
		<div id="nav">
		    <!-- If you want to you can have a logo here just replace the link and the image -->
			<div class="logo">
			<a class="" href="#">
			<img src="http://placehold.it/350x150"
			alt="Website" height="120" width="300">
			</a>
			</div>
			
			<!-- Here go the statuses depends if it's online or offline -->
			<div class="box-b">
			<?php echo $reply1 ?>
			<?php echo $reply2 ?>
			</div>
			
			<!-- If you want to link people to youtube channels feel free to do so. -->
			<div class="box-a">
			<div class="container">
			<p> Check out these youtube channels </p>
			<a class="youtubebutton" href="#">Channel 1</a>
			<a class="youtubebutton" href="#">Channel 2</a>
			<a class="youtubebutton" href="#">Channel 3</a>
			</div>
			</div>
		</div>
	</body>
							
</html>							