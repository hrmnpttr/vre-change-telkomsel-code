
<html>
<head>
<meta http-equiv="refresh" content="60;URL='<?php echo $_SERVER['PHP_SELF']; ?>'">
</head>


<?PHP
$server = "192.168.1.2"; //ganti sesuai server Anda
$username = "root"; //ganti sesuai username Anda
$password = ""; //ganti sesuai password Anda
$db_name = "refill_mlm"; //ganti sesuatu nama database Anda
$dbs = mysqli_connect($server,$username,$password) or DIE("koneksi ke database1 gagal !!");
mysqli_select_db($db_name, $dbs) or DIE("nama database1 tersebut tidak ada !!");


//gateway server
$sql = "select * from sms_outbox where text like'%code%' or  text like'%kode%' limit 10";
$result = mysqli_query($sql,$dbs);
//gateway client
$ubah = array();
$sqls ="";
try
{
 // do something that can go wrong
	while($row = mysql_fetch_array($result)){
		$text = $row['text'];
		$text = str_replace("kode ","",$text);
		$text = str_replace("code ","",$text);
		array_push($ubah," update sms_outbox set text = '" . $text . "' where id = " . $row['id'] . "; ");
		echo $row['no_hp'] . "<br>";
	}
}
catch (Exception $e)
{
 throw new Exception( 'Set ERROR', 0, $e);
}
foreach ($ubah as $sql) {
	try
	{
	mysql_query($sql,$dbs);
	}
	catch (Exception $e)
	{
	 throw new Exception( 'Sending ERROR', 0, $e);
	}
}


echo "UPDATE DONE<br>";



	mysqli_close();


?>
