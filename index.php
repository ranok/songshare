<?php
require('db.class.php');
$db = new DB();
$today = date("F j, Y");
$midnight = strtotime("12:00AM ".$today);
$db->query("SELECT * FROM `songshare` WHERE `date` > '$midnight';");
$tracks = Array();
while($row = $db->get_row()) {
  $tracks[] = $row;
}
?>
<html>
  <head>
    <title>SongShare</title>
  </head>
  <body>
    <div id="songs">
      <h2>Today's songs:</h2>
      <ul>
	<?php foreach($tracks as $track) { ?>
	<li><?php print $track['name'];?> - <a href="<?php print $track['link']; ?>"><?php print "{$track['track']} by {$track['artist']}"; ?></a></li>
	<?php } ?>
      </ul>
    </div>
    <div id="addsong">
      <h2>Add a song:</h2>
      <form action="addsong.php" method="POST">
	Your name: <input type="text" name="name" /><br />
	Track name: <input type="text" name="track" /><br />
	Artist: <input type="text" name="artist" /><br />
	Link: <input type="text" name="link" /><br />
	<input type="submit" value="Add your track!" />
      </form>
  </body>
</html>
