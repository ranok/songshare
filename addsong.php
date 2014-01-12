<?php
require('db.class.php');
if ($_POST['name'] == "" || $_POST['track'] == "" || $_POST['artist'] == "" || $_POST['link'] == "")
{
	die("Not all values filled in!");
}
$name = mysql_real_escape_string($_POST['name']);
$artist = mysql_real_escape_string($_POST['artist']);
$track = mysql_real_escape_string($_POST['track']);
$link = mysql_real_escape_string($_POST['link']);
$time = time();

$db = new DB();
$db->query("INSERT INTO `songshare` (`name`, `track`, `artist`, `link`, `date`) VALUES ('$name', '$track', '$artist', '$link', '$time');");

header('Location: index.php');
exit();
?>