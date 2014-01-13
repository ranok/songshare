<?php
require('db.class.php');
$db = new DB();
$time = time();
$day = 'Today';
if (isset($_GET['timestamp']))
{
  $time = $_GET['timestamp'];
  $day = date('l', $time);
}
$today = date("F j, Y", $time);
$midnight = strtotime("12:00AM ".$today." EST");
$midnight2 = $midnight + 86400;
$db->query("SELECT * FROM `songshare` WHERE `date` > '$midnight' AND `date` < '$midnight2';");
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
      <h2><?php print $day; ?>'s songs:</h2>
      <a href="index.php?timestamp=<?php print $time - 86400; ?>">Previous Day</a> - <a href="index.php">Return to Today</a>
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
