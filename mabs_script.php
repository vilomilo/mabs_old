<?php
//
// maBS PHP Script
//

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");

$update = false;

$handle = fopen("info.dat", "r");
$name1 = fgets($handle, 4096);
$name2 = fgets($handle, 4096);
$uid = fgets($handle, 4096);
$rdstitle = fgets($handle, 4096);
$mediatype = fgets($handle, 4096);

fclose($handle);

if (isset($_POST['name1'])) {
	$name1 = $_POST['name1'];
	$update = true;
}

if (isset($_POST['name2'])) {
	$name2 = $_POST['name2'];
	$update = true;
}

if (isset($_POST['uid'])) {
	$uid = $_POST['uid'];
	$update = true;
}

if (isset($_POST['rdstitle'])) {
	$rdstitle = $_POST['rdstitle'];
	$update = true;
}

if (isset($_POST['mediatype'])) {
	$mediatype = $_POST['mediatype'];
	$update = true;
}

if ($update == true) {
	$handle = fopen("info.dat", "w");
	fwrite($handle, $name1 . "\n");
	fwrite($handle, $name2 . "\n");
	fwrite($handle, $uid . "\n");
	fwrite($handle, $rdstitle . "\n");
	fwrite($handle, $mediatype. "\n");

	fclose($handle);

	echo "updated";
}

$sh = fopen("sql.dat", "w");

try {
	if ($update == false){ 
		fwrite($sh, "{".$name1 . "- " . $name2."} \n");
		if($mediatype == 1){
			$time_now = time();
			$artist = str_replace("\"","'", $name1);
			$song = str_replace("\"","'", $name2);
			$sql_sel_last = "SELECT s.id, s.artist, s.song, s.uid, p.start_time FROM song_list AS s INNER JOIN playlist AS p ON s.id = p.song_id ORDER BY start_time DESC LIMIT 1";
			$sql_contains = "SELECT id FROM ((".$sql_sel_last.") AS sellast) WHERE `artist` = '" . $name1 . "' AND `song` = '" . $name2 . "' AND `uid` = " . $uid . ";";
			$sql_get_song_id = "SELECT id FROM song_list WHERE `artist` = '" . $name1 . "' AND `song` = '" . $name2 . "' AND `uid` = " . $uid . ";";
			$sql_add_song = 'INSERT INTO song_list(artist, song, uid) VALUES ("' . $artist . '", "' . $song . '", ' . $uid . ');';
			
			fwrite($sh, "Update on " . date('l jS \of F Y h:i:s A', $time_now) . "\n");
			$mysqli = new mysqli('91.211.244.127', 'mabs', 'XjbjzBeben3vnD2e', 'mabs');
			
			if ($mysqli->connect_error) {
				fwrite($sh, "Connection failed: " . $mysqli->connect_error . "\n");
			} else {
				fwrite($sh, "Connected!\n");
			}
			
			fwrite($sh, $sql_contains."\n");
			$res_contains = $mysqli->query($sql_contains);
				if($res_contains->num_rows > 0) {
					fwrite($sh, "Already in DB\n");
				} else {
					fwrite($sh, $sql_get_song_id."\n");
					$try=3;
					$found = false;
					while(!$found && $try > 0) {
						$res_song_id = $mysqli->query($sql_get_song_id);
						if ($res_song_id->num_rows == 0){
							$try -= 1;
							$res_add_song = $mysqli->query($sql_add_song);
							if ($res_add_song) {
								fwrite($sh, "Added Song: " . $name1 . "\n");
							} else {
								fwrite($sh, "Error adding\n");
								fwrite($sh, $mysqli->error . " |\n");
							}
						}else{
							fwrite($sh, "Song '" . $name1 . "' found\n");
							$found = true;
							$song_id = $res_song_id->fetch_array(MYSQLI_ASSOC)['id'];
						}
					}
					if($try == 0){
						fwrite($sh, "Tried 0 times to add song without results :(");
					} else {
						$sql_add_to_playlist = 'INSERT INTO playlist(song_id, start_time) VALUES(' . $song_id . ', NOW());';
						$res_add_to_playlist = $mysqli->query($sql_add_to_playlist);
						if ($res_add_to_playlist) {
							fwrite($sh, "Added song to playlist: " . $name1 . "\n");
						} else {
							fwrite($sh, "Error adding song to playlist! \n");
							fwrite($sh, $mysqli->error . " | \n");
						}	
					}
				}
			$mysqli->close();
			fwrite($sh, "Disconnecting\n");
		} else {
			fwrite($sh, "Media type wrong [".$mediatype."]. Not saving.\n");
		}
	}
} catch (Exception $e) { 
	fwrite($sh, var_dump($e));
} 
fclose($sh);

$f1 = file_get_contents("http://extrafm:h29zqj@82.135.234.195:8001/proxy.icecast?mount=/extrafm.aac&mode=updinfo&song=".urlencode(file_get_contents('http://www.extrafm.eu/mabs/example.php')));
$f2 = file_get_contents("http://extrafm:h29zqj@82.135.234.195:8001/proxy.icecast?mount=/extrafm.mp3&mode=updinfo&song=".urlencode(file_get_contents('http://www.extrafm.eu/mabs/example.php')));
exit;
?>