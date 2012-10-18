<html>
<head>
<title>
Central SQL Database
</title>
</head>
<body>

<?php

$connect=mysql_connect('localhost','track','12charm34');
if(!$connect) echo "DB NOT CONNECTED";
$connect2=mysql_select_db('tt_db');
if(!$connect2) echo "DB NOT SEL";
$cnt = $str=explode("|",$_REQUEST["cnt"]);
$t = time()+19800;

$query="SELECT `time` from `".$_REQUEST["db"]."` WHERE  `sex`=1 AND `age`=4 AND HOUR(`time`)=".date("G",$t)." AND DAY(`time`)=".date("j",$t)." AND MONTH(`time`)=".date("n",$t)." AND YEAR(`time`)=".date("Y",$t);
$result = mysql_query($query);
if (mysql_num_rows($result)==0)
{
	$query="INSERT INTO `".$_REQUEST["db"]."` values (1,4,'".date("Y-n-j G:00:00",$t)."',".$cnt[0].",".$cnt[8].")";
	$s12 = mysql_query($query);
}
else
{
	$query="UPDATE `".$_REQUEST["db"]."` SET `walkin`=`walkin`+".$cnt[0].",`purchase`=`purchase`+".$cnt[8]." WHERE  `sex`=1 AND `age`=4 AND HOUR(`time`)=".date("G",$t)." AND DAY(`time`)=".date("j",$t)." AND MONTH(`time`)=".date("n",$t)." AND YEAR(`time`)=".date("Y",$t);
	$s11 = mysql_query($query);
}

$query="SELECT `time` from `".$_REQUEST["db"]."` WHERE  `sex`=1 AND `age`=3 AND HOUR(`time`)=".date("G",$t)." AND DAY(`time`)=".date("j",$t)." AND MONTH(`time`)=".date("n",$t)." AND YEAR(`time`)=".date("Y",$t);
$result = mysql_query($query);
if (mysql_num_rows($result)==0) 
{
	$query="INSERT INTO `".$_REQUEST["db"]."` values (1,3,'".date("Y-n-j G:00:00",$t)."',".$cnt[1].",".$cnt[9].")";
	$s12 = mysql_query($query);
}
else
{
$query="UPDATE `".$_REQUEST["db"]."` SET `walkin`=`walkin`+".$cnt[1].",`purchase`=`purchase`+".$cnt[9]." WHERE  `sex`=1 AND `age`=3 AND HOUR(`time`)=".date("G",$t)." AND DAY(`time`)=".date("j",$t)." AND MONTH(`time`)=".date("n",$t)." AND YEAR(`time`)=".date("Y",$t);
$s11 = mysql_query($query);
}

$query="SELECT `time` from `".$_REQUEST["db"]."` WHERE  `sex`=1 AND `age`=2 AND HOUR(`time`)=".date("G",$t)." AND DAY(`time`)=".date("j",$t)." AND MONTH(`time`)=".date("n",$t)." AND YEAR(`time`)=".date("Y",$t);
$result = mysql_query($query);
if (mysql_num_rows($result)==0) 
{
$query="INSERT INTO `".$_REQUEST["db"]."` values (1,2,'".date("Y-n-j G:00:00",$t)."',".$cnt[2].",".$cnt[10].")";
$s22 = mysql_query($query);
}
else
{
$query="UPDATE `".$_REQUEST["db"]."` SET `walkin`=`walkin`+".$cnt[2].",`purchase`=`purchase`+".$cnt[10]." WHERE  `sex`=1 AND `age`=2 AND HOUR(`time`)=".date("G",$t)." AND DAY(`time`)=".date("j",$t)." AND MONTH(`time`)=".date("n",$t)." AND YEAR(`time`)=".date("Y",$t);
$s21 = mysql_query($query);
}


$query="SELECT `time` from `".$_REQUEST["db"]."` WHERE  `sex`=1 AND `age`=1 AND HOUR(`time`)=".date("G",$t)." AND DAY(`time`)=".date("j",$t)." AND MONTH(`time`)=".date("n",$t)." AND YEAR(`time`)=".date("Y",$t);
$result = mysql_query($query);
if (mysql_num_rows($result)==0) 
{
$query="INSERT INTO `".$_REQUEST["db"]."` values (1,1,'".date("Y-n-j G:00:00",$t)."',".$cnt[3].",".$cnt[11].")";
$s32 = mysql_query($query);
}
else
{
$query="UPDATE `".$_REQUEST["db"]."` SET `walkin`=`walkin`+".$cnt[3].",`purchase`=`purchase`+".$cnt[11]." WHERE  `sex`=1 AND `age`=1 AND HOUR(`time`)=".date("G",$t)." AND DAY(`time`)=".date("j",$t)." AND MONTH(`time`)=".date("n",$t)." AND YEAR(`time`)=".date("Y",$t);
$s31 = mysql_query($query);
}


$query="SELECT `time` from `".$_REQUEST["db"]."` WHERE  `sex`=2 AND `age`=4 AND HOUR(`time`)=".date("G",$t)." AND DAY(`time`)=".date("j",$t)." AND MONTH(`time`)=".date("n",$t)." AND YEAR(`time`)=".date("Y",$t);
$result = mysql_query($query);
if (mysql_num_rows($result)==0)
{
	$query="INSERT INTO `".$_REQUEST["db"]."` values (2,4,'".date("Y-n-j G:00:00",$t)."',".$cnt[4].",".$cnt[12].")";
	$s42 = mysql_query($query);
}
else
{
	$query="UPDATE `".$_REQUEST["db"]."` SET `walkin`=`walkin`+".$cnt[4].",`purchase`=`purchase`+".$cnt[12]." WHERE  `sex`=2 AND `age`=4 AND HOUR(`time`)=".date("G",$t)." AND DAY(`time`)=".date("j",$t)." AND MONTH(`time`)=".date("n",$t)." AND YEAR(`time`)=".date("Y",$t);
	$s41 = mysql_query($query);
}

$query="SELECT `time` from `".$_REQUEST["db"]."` WHERE  `sex`=2 AND `age`=3 AND HOUR(`time`)=".date("G",$t)." AND DAY(`time`)=".date("j",$t)." AND MONTH(`time`)=".date("n",$t)." AND YEAR(`time`)=".date("Y",$t);
$result = mysql_query($query);
if (mysql_num_rows($result)==0) 
{
$query="INSERT INTO `".$_REQUEST["db"]."` values (2,3,'".date("Y-n-j G:00:00",$t)."',".$cnt[5].",".$cnt[13].")";
$s42 = mysql_query($query);
}
else
{
$query="UPDATE `".$_REQUEST["db"]."` SET `walkin`=`walkin`+".$cnt[5].",`purchase`=`purchase`+".$cnt[13]." WHERE  `sex`=2 AND `age`=3 AND HOUR(`time`)=".date("G",$t)." AND DAY(`time`)=".date("j",$t)." AND MONTH(`time`)=".date("n",$t)." AND YEAR(`time`)=".date("Y",$t);
$s41 = mysql_query($query);
}

$query="SELECT `time` from `".$_REQUEST["db"]."` WHERE  `sex`=2 AND `age`=2 AND HOUR(`time`)=".date("G",$t)." AND DAY(`time`)=".date("j",$t)." AND MONTH(`time`)=".date("n",$t)." AND YEAR(`time`)=".date("Y",$t);
$result = mysql_query($query);
if (mysql_num_rows($result)==0) 
{
$query="INSERT INTO `".$_REQUEST["db"]."` values (2,2,'".date("Y-n-j G:00:00",$t)."',".$cnt[6].",".$cnt[14].")";
$s52 = mysql_query($query);
}
else
{
$query="UPDATE `".$_REQUEST["db"]."` SET `walkin`=`walkin`+".$cnt[6].",`purchase`=`purchase`+".$cnt[14]." WHERE  `sex`=2 AND `age`=2 AND HOUR(`time`)=".date("G",$t)." AND DAY(`time`)=".date("j",$t)." AND MONTH(`time`)=".date("n",$t)." AND YEAR(`time`)=".date("Y",$t);
$s51 = mysql_query($query);
}

$query="SELECT `time` from `".$_REQUEST["db"]."` WHERE  `sex`=2 AND `age`=1 AND HOUR(`time`)=".date("G",$t)." AND DAY(`time`)=".date("j",$t)." AND MONTH(`time`)=".date("n",$t)." AND YEAR(`time`)=".date("Y",$t);
$result = mysql_query($query);
if (mysql_num_rows($result)==0) 
{
$query="INSERT INTO `".$_REQUEST["db"]."` values (2,1,'".date("Y-n-j G:00:00",$t)."',".$cnt[7].",".$cnt[15].")";
$s62 = mysql_query($query);
}
else
{
$query="UPDATE `".$_REQUEST["db"]."` SET `walkin`=`walkin`+".$cnt[7].",`purchase`=`purchase`+".$cnt[15]." WHERE  `sex`=2 AND `age`=1 AND HOUR(`time`)=".date("G",$t)." AND DAY(`time`)=".date("j",$t)." AND MONTH(`time`)=".date("n",$t)." AND YEAR(`time`)=".date("Y",$t);
$s61 = mysql_query($query);
}

?>

</body>
</html>