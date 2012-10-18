<?php
mysql_connect("localhost","track","12charm34") or die(mysql_error());
mysql_select_db("tt_db") or die(mysql_error());
if(isset($_COOKIE['wordpress_logged_in_1d0e475bbfae7800f7febbde6ab729e8']))
{	
	echo "	<html>
			<head><title>TrendView</title>
			</head>
			<body>
			<P ALIGN='right'><a href='http://radsinnovativesolutions.com/wp-login.php?action=logout&redirect_to=http://radsinnovativesolutions.com'>Logout</a></P>
			";
	if(isset($_GET['db']))
	{
		$result = mysql_query("select * from db_info where `DataBase` = '".$_GET['db']."'") or die(mysql_error());
		$row = mysql_fetch_array($result);
		$val=explode("|",$_COOKIE['wordpress_logged_in_1d0e475bbfae7800f7febbde6ab729e8']);
		if($row[5]==$val[0])
		{
			echo "<h2>Store : ".$row[1]."</h2>";
			echo "<div id='container'>";
		    echo "<table><tr>";
		    echo "<td><div id='bar_view'></div></td>";
		    echo "<td><div id='pie_view'></div>";
		    echo "<div id ='con_view'></div></td>";
		    echo "</tr></table>";
		    echo "</div>";
			echo "<form name='form1' action='TrendView.php' method='get'>";
		    $curdat=getdate();
			echo "<table align='center'>";
		    echo "<tr><td><label>Year  ";
		    echo "<select name='yearsel' onChange='document.form1.submit();'>";
		    if(isset($_GET['yearsel']))
		        $ych=$_GET['yearsel'];
		    else
		        $ych=$curdat['year'];
		    $result = mysql_query("select distinct year(time) from ".$_GET['db']) or die(mysql_error());
		    echo "<option>Select</option>";
			$flag = 0;
		    while($row = mysql_fetch_array($result))
		    {
		        echo "<option";
		        if(strcmp($ych,$row[0])==0)
				{
		            echo " selected = 'selected'";
					$flag=1;
				}
		        echo">".$row[0]."</option>";
		    }
			if($flag==0)
				$ych="Select";
		    echo "</select>";
		    echo "</label></td>";
		    echo "<td><label>Month  ";
		    echo "<select name='monthsel' onChange='document.form1.submit();'>";
		    if(strcmp($ych,"Select")!=0)
		    {
		        if(isset($_GET['monthsel']))
		            $mch=$_GET['monthsel'];
		        else
		            $mch=$curdat['month'];
		        echo "<option>Select</option>";
		        $result = mysql_query("select distinct monthname(time) from `".$_GET['db']."` where year(time) = ".$ych."") or die(mysql_error());
				$flag=0;
		        while($row = mysql_fetch_array($result))
		        {
		            echo "<option";
		            if(strcmp($mch,$row[0])==0)
					{
		                echo " selected = 'selected'";
						$flag=1;
					}
		            echo">".$row[0]."</option>";
		        }
				if($flag==0)
					$mch="Select";
		    }
		    else
		        echo "<option selected = 'selected'>Select</option>";
		    echo "</select>";
		    echo "</label></td>";
		    echo "<td><label>Day  ";
		    echo "<select name='daysel' onChange='document.form1.submit();'>";
		    if(isset($_GET['daysel']))
		        $dch=$_GET['daysel'];
		    else
		        $dch=$curdat['mday'];
		    if(isset($mch))
		    if(strcmp($mch,"Select")!=0)
		    {
		        $result = mysql_query("select distinct day(time) from `".$_GET['db']."` where year(time) = ".$ych." and monthname(time) = '".$mch."'") or die(mysql_error());
		        echo "<option>Select</option>";
				$flag=0;
		        while($row = mysql_fetch_array($result))
		        {
		            echo "<option";
		            if(strcmp($dch,$row[0])==0)
					{
		                echo " selected = 'selected'";
						$flag=1;
					}
		            echo">".$row[0]."</option>";
		        }
				if($flag==0)
					$dch="Select";
		    }
		    else
		        echo "<option selected = 'selected'>Select</option>";
		    echo "</select>";
		    echo "</label></td></tr></table>";
		    echo "<input type='hidden' name='db' value='".$_GET['db']."'>";
		    echo "<table align='center'><tr align='center'><td><input type='checkbox' name='sex' value='Yes' onChange='document.form1.submit();' ";
			if(isset($_GET['sex']))
				echo "checked";
			echo "/> Sex </td>";
		    echo "<td><input type='checkbox' name='age' value='Yes' onChange='document.form1.submit();' ";
			if(isset($_GET['age']))
				echo "checked";
			echo "/> Age </td></tr>";
		    echo "</form></table>";
		
		    echo "<script type='text/javascript' src='https://www.google.com/jsapi'></script>";
		    echo "<script type='text/javascript'>";
		    echo "google.load('visualization', '1', {'packages':['corechart']});";
		    echo "google.load('visualization', '1', {packages:['imagebarchart']});";
		    echo "google.setOnLoadCallback(drawChart);";
		    echo "function drawChart()";
		    echo "{";
		    $curdat=getdate();
		    $t=0;
		    if(isset($_GET['daysel']))
		    {
		        if(strcmp($_GET['daysel'],"Select")!=0)
		            $q3=" AND DAY(TIME) = ".$_GET['daysel'];
		        else
		        {
		            $q3=" ";
		            $t=3;
		        }
		    }
		    else
			{	
				if(strcmp($dch,"Select")!=0)
		        	$q3=" AND DAY(TIME) = ".$curdat['mday'];
				else
		        {
		            $q3=" ";
		            $t=3;
		        }
					
			}
		    if(isset($_GET['monthsel']))
		    {
		        if(strcmp($_GET['monthsel'],"Select")!=0)
		            $q2=" AND MONTHNAME(TIME) = '".$_GET['monthsel']."'";
		        else
		        {
		            $q2=" ";
		            $t=2;
		        }
		    }
		    else
			{	
				if(strcmp($mch,"Select")!=0)
		        	$q2=" AND MONTHNAME(TIME) = '".$curdat['month']."'";
				else
		        {
		            $q2=" ";
		            $t=2;
		        }
					
			}
		    if(isset($_GET['yearsel']))
		    {
		        if(strcmp($_GET['yearsel'],"Select")!=0)
		            $q1=" AND YEAR(TIME) = ".$_GET['yearsel'];
		        else
		        {
		            $q1=" ";
		            $t=1;
		        }
		    }
		    else
			{	
				if(strcmp($ych,"Select")!=0)
		        	$q1=" AND YEAR(TIME) = ".$curdat['year'];
				else
		        {
		            $q1=" ";
		            $t=1;
		        }
					
			}
		    switch ($t)
		    {
		    case 0:
		    {
		        $query=$q1.$q2.$q3." AND HOUR(TIME) = ";
		        $sub=mysql_query("select distinct hour(time) from `".$_GET['db']."` where 1".$q1.$q2.$q3." order by hour(time)") or die(mysql_error());
		    }
		    break;
		    case 1:
		    {
		        $query=" AND YEAR(TIME) = ";
		        $sub=mysql_query("select distinct year(time) from `".$_GET['db']."` where 1 order by year(time)") or die(mysql_error());
		    }
		    break;
		    case 2:
		    {
		        $query=$q1." AND MONTH(TIME) = ";
		        $sub=mysql_query("select distinct month(time) from `".$_GET['db']."` where 1".$q1." order by month(time)") or die(mysql_error());
		    }
		    break;
		    case 3:
		    {
		        $query=$q1.$q2." AND DAY(TIME) = ";
		        $sub=mysql_query("select distinct day(time) from `".$_GET['db']."` where 1".$q1.$q2." order by day(time)") or die(mysql_error());
		    }
		    break;
		    }
			
			
			if(isset($_GET['sex']))
			{
				if(isset($_GET['age']))
				{
					echo "var data2 = google.visualization.arrayToDataTable([";
					echo "['Time', 'Male Kids','Male Teens', 'Male Adult', 'Male Senior', 'Female Kids','Female Teens', 'Female Adult', 'Female Senior', 'Total-Walkins','Total-Purchased']";
					if($row2 = mysql_fetch_array($sub))
					{
						$cnt = 1;echo ",";
					}
					else
						$cnt=0;
					$array = array(1,2,3,4,5,6,7,8);
					$catsum = array(1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0);
					$catsum2 = array(1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0);
					$totsum = 0;
					$totsum2 = 0;
					while($cnt==1)
					{
						$sum = 0;
						$sum2 = 0;
						$result = mysql_query("select 0+sex,0+age,sum(walkin),sum(purchase) from `".$_GET['db']."` where 1".$query.$row2[0]." group by sex,age") or die(mysql_error());
						echo "['".$row2[0]."',";
						$array[1]=0;
						$array[2]=0;
						$array[3]=0;
						$array[4]=0;
						$array[5]=0;
						$array[6]=0;
						$array[7]=0;
						$array[8]=0;
						while($row = mysql_fetch_array($result))
						{
							$ar = (($row[0]-1)*4)+$row[1];
							$array[$ar] = $row[2];
							$catsum[$ar] = $catsum[$ar] + $row[2];
							$totsum = $totsum + $row[2];
							$catsum2[$ar] = $catsum2[$ar] + $row[3];
							$totsum2 = $totsum2 + $row[3];
							$sum = $sum + $row[2];
							$sum2 = $sum2 + $row[3];
						}
						for ($i=1; $i<=8; $i++)
							echo $array[$i].",";
						echo $sum.",".$sum2."]";
				
						if($row2 = mysql_fetch_array($sub))
						{
							$cnt = 1;
							echo ",";
						}
						else
							$cnt=0;
					}
					echo "]);";
					echo "var data = new google.visualization.DataTable();";
					echo "data.addColumn('string', 'Category');";
					echo "data.addColumn('number', 'Walkins');";
					echo "data.addRows([";
					echo "['MaleKids',".$catsum[1]."],";
					echo "['MaleTeens',".$catsum[2]."],";
					echo "['MaleAdult',".$catsum[3]."],";
					echo "['MaleSenior',".$catsum[4]."],";
					echo "['FemaleKids',".$catsum[5]."],";
					echo "['FemaleTeens',".$catsum[6]."],";
					echo "['FemaleAdult',".$catsum[7]."],";
					echo "['FemaleSenior',".$catsum[8]."]";
					echo "]);";
				
					echo "var data3 = google.visualization.arrayToDataTable([['Male Kids','Male Teens', 'Male Adult', 'Male Senior', 'Female Kids','Female Teens','Female Adult', 'Female Senior', 'Average'],[";
					if($catsum[1]==0)
						echo "0,";
					else
						echo intval($catsum2[1]*100/$catsum[1]).",";
					if($catsum[2]==0)
						echo "0,";
					else
						echo intval($catsum2[2]*100/$catsum[2]).",";
					if($catsum[3]==0)
						echo "0,";
					else
						echo intval($catsum2[3]*100/$catsum[3]).",";
					if($catsum[4]==0)
						echo "0,";
					else
						echo intval($catsum2[4]*100/$catsum[4]).",";
					if($catsum[5]==0)
						echo "0,";
					else
						echo intval($catsum2[5]*100/$catsum[5]).",";
					if($catsum[6]==0)
						echo "0,";
					else
						echo intval($catsum2[6]*100/$catsum[6]).",";
					if($catsum[7]==0)
						echo "0,";
					else
						echo intval($catsum2[7]*100/$catsum[7]).",";
					if($catsum[8]==0)
						echo "0,";
					else
						echo intval($catsum2[8]*100/$catsum[8]).",";
					if($totsum==0)
						echo "0";
					else
						echo intval($totsum2*100/$totsum);
					echo "]]);";
					$nm=8;
				}
				else
				{
					//just sex
					echo "var data2 = google.visualization.arrayToDataTable([";
					echo "['Time', 'Male','Female','Total-Walkins','Total-Purchased']";
					if($row2 = mysql_fetch_array($sub))
					{
						$cnt = 1;echo ",";
					}
					else
						$cnt=0;
					$array = array(1,2);
					$catsum = array(1=>0,2=>0);
					$catsum2 = array(1=>0,2=>0);
					$totsum = 0;
					$totsum2 = 0;
					while($cnt==1)
					{
						$sum = 0;
						$sum2 = 0;
						$result = mysql_query("select 0+sex,sum(walkin),sum(purchase) from `".$_GET['db']."` where 1".$query.$row2[0]." group by sex") or die(mysql_error());
						echo "['".$row2[0]."',";
						$array[1]=0;
						$array[2]=0;
						while($row = mysql_fetch_array($result))
						{
							$ar = $row[0];
							$array[$ar] = $row[1];
							$catsum[$ar] = $catsum[$ar] + $row[1];
							$totsum = $totsum + $row[1];
							$catsum2[$ar] = $catsum2[$ar] + $row[2];
							$totsum2 = $totsum2 + $row[2];
							$sum = $sum + $row[1];
							$sum2 = $sum2 + $row[2];
						}
						for ($i=1; $i<=2; $i++)
							echo $array[$i].",";
						echo $sum.",".$sum2."]";
				
						if($row2 = mysql_fetch_array($sub))
						{
							$cnt = 1;
							echo ",";
						}
						else
							$cnt=0;
					}
					echo "]);";
					echo "var data = new google.visualization.DataTable();";
					echo "data.addColumn('string', 'Category');";
					echo "data.addColumn('number', 'Walkins');";
					echo "data.addRows([";
					echo "['Male',".$catsum[1]."],";
					echo "['Female',".$catsum[2]."]";
					echo "]);";
				
					echo "var data3 = google.visualization.arrayToDataTable([['Male', 'Female', 'Average'],[";
					if($catsum[1]==0)
						echo "0,";
					else
						echo intval($catsum2[1]*100/$catsum[1]).",";
					if($catsum[2]==0)
						echo "0,";
					else
						echo intval($catsum2[2]*100/$catsum[2]).",";
					if($totsum==0)
						echo "0";
					else
						echo intval($totsum2*100/$totsum);
					echo "]]);";
					$nm=2;
					//just sex
				}
			}
			else
			{
				if(isset($_GET['age']))
				{
					//just age			
					echo "var data2 = google.visualization.arrayToDataTable([";
					echo "['Time', 'Kids','Teens', 'Adult', 'Senior', 'Total-Walkins','Total-Purchased']";
					if($row2 = mysql_fetch_array($sub))
					{
						$cnt = 1;echo ",";
					}
					else
						$cnt=0;
					$array = array(1,2,3,4);
					$catsum = array(1=>0,2=>0,3=>0,4=>0);
					$catsum2 = array(1=>0,2=>0,3=>0,4=>0);
					$totsum = 0;
					$totsum2 = 0;
					while($cnt==1)
					{
						$sum = 0;
						$sum2 = 0;
						$result = mysql_query("select 0+age,sum(walkin),sum(purchase) from `".$_GET['db']."` where 1".$query.$row2[0]." group by age") or die(mysql_error());
						echo "['".$row2[0]."',";
						$array[1]=0;
						$array[2]=0;
						$array[3]=0;
						$array[4]=0;
						while($row = mysql_fetch_array($result))
						{
							$ar = $row[0];
							$array[$ar] = $row[1];
							$catsum[$ar] = $catsum[$ar] + $row[1];
							$totsum = $totsum + $row[1];
							$catsum2[$ar] = $catsum2[$ar] + $row[2];
							$totsum2 = $totsum2 + $row[2];
							$sum = $sum + $row[1];
							$sum2 = $sum2 + $row[2];
						}
						for ($i=1; $i<=4; $i++)
							echo $array[$i].",";
						echo $sum.",".$sum2."]";
				
						if($row2 = mysql_fetch_array($sub))
						{
							$cnt = 1;
							echo ",";
						}
						else
							$cnt=0;
					}
					echo "]);";
					echo "var data = new google.visualization.DataTable();";
					echo "data.addColumn('string', 'Category');";
					echo "data.addColumn('number', 'Walkins');";
					echo "data.addRows([";
					echo "['Kids',".$catsum[1]."],";
					echo "['Teens',".$catsum[2]."],";
					echo "['Adult',".$catsum[3]."],";
					echo "['Senior',".$catsum[4]."]";
					echo "]);";
				
					echo "var data3 = google.visualization.arrayToDataTable([['Kids','Teens', 'Adult', 'Senior',  'Average'],[";
					if($catsum[1]==0)
						echo "0,";
					else
						echo intval($catsum2[1]*100/$catsum[1]).",";
					if($catsum[2]==0)
						echo "0,";
					else
						echo intval($catsum2[2]*100/$catsum[2]).",";
					if($catsum[3]==0)
						echo "0,";
					else
						echo intval($catsum2[3]*100/$catsum[3]).",";
					if($catsum[4]==0)
						echo "0,";
					else
						echo intval($catsum2[4]*100/$catsum[4]).",";
					if($totsum==0)
						echo "0";
					else
						echo intval($totsum2*100/$totsum);
					echo "]]);";
					$nm=4;
				}
				else
				{
					//just total
					echo "var data2 = google.visualization.arrayToDataTable([";
					echo "['Time', 'Walkin', 'Total-Walkins','Total-Purchased']";
					if($row2 = mysql_fetch_array($sub))
					{
						$cnt = 1;echo ",";
					}
					else
						$cnt=0;
					$catsum = 0;
					$catsum2 = 0;
					$totsum = 0;
					$totsum2 = 0;
					while($cnt==1)
					{
						$sum = 0;
						$sum2 = 0;
						$result = mysql_query("select sum(walkin),sum(purchase) from `".$_GET['db']."` where 1".$query.$row2[0]) or die(mysql_error());
						echo "['".$row2[0]."',";
						$array=0;
						while($row = mysql_fetch_array($result))
						{
							$array = $row[0];
							$catsum = $catsum + $row[0];
							$totsum = $totsum + $row[0];
							$catsum2 = $catsum2 + $row[1];
							$totsum2 = $totsum2 + $row[1];
							$sum = $sum + $row[0];
							$sum2 = $sum2 + $row[1];
						}
						echo $array.",";
						echo $sum.",".$sum2."]";
				
						if($row2 = mysql_fetch_array($sub))
						{
							$cnt = 1;
							echo ",";
						}
						else
							$cnt=0;
					}
					echo "]);";
					echo "var data = new google.visualization.DataTable();";
					echo "data.addColumn('string', 'Category');";
					echo "data.addColumn('number', 'Walkins');";
					echo "data.addRows([";
					echo "['Walkin',".$catsum."]";
					echo "]);";
				
					echo "var data3 = google.visualization.arrayToDataTable([['Walkin', 'Average'],[";
					if($catsum==0)
						echo "0,";
					else
						echo intval($catsum2*100/$catsum).",";
					if($totsum==0)
						echo "0";
					else
						echo intval($totsum2*100/$totsum);
					echo "]]);";
					$nm=1;
					//only total
				}
			}
			
		    echo "var pie_chart = new google.visualization.PieChart(document.getElementById('pie_view'));";
		    echo "pie_chart.draw(data, {";
		    echo "title: 'Total',";
		    echo "width: 400, height: 275,";
		    echo "legend: 'none',";
		    echo "is3D: true,";
		    echo "pieSliceText: 'value'";
		    echo "});";
		    echo "var bar_chart = new google.visualization.ComboChart(document.getElementById('bar_view'));";
		    echo "bar_chart.draw(data2, {";
		    echo "width: 600, height: 450,";
		    echo "title : 'Walkins',";
		    echo "vAxis: {title: 'Walkins'},";
		    echo "hAxis: {title: 'Time'},";
		    echo "seriesType: 'bars',"; 
			echo "series: {".$nm.": {type: 'line'}, ".($nm+1).": {type: 'area'}},";
			echo "legend: 'right'";
		    echo "});";
		    echo "var con_chart = new google.visualization.ComboChart(document.getElementById('con_view'));";
		    echo "con_chart.draw(data3, {strictFirstColumnType: false,";
		    echo "width: 400, height: 175, ";
		    echo "title: 'Conversion',";
		    echo "seriesType: 'bars',";
			echo "series: {".$nm.": {type: 'area'}},";
			echo "hAxis: {title: 'Category'},";
		    echo "vAxis: {title: 'Percent', baseline: 0},";
		    echo "legend: 'none'";
		    echo "});";
		    echo "}";
		    echo "</script>";
			echo "<button type='button' onClick=window.open('export.php?ych=".$ych."&mch=".$mch."&dch=".$dch."&db=".$_GET['db'];
			if(isset($_GET['sex']))
				echo "&sex=Yes";
			if(isset($_GET['age']))
				echo "&age=Yes";
			echo "');>Export data to Excel</button>";
		}
		else
		{
			echo "<h1>DONT TRY TO CRACK THE SOFTWARE -- YOUR IP WILL BE REPORTED</h1>";
		}
	}
	else
	{
		$val=explode("|",$_COOKIE['wordpress_logged_in_1d0e475bbfae7800f7febbde6ab729e8']);
		$result = mysql_query("select `store_info`,`Database` from `db_info` where `login` = '".$val[0]."'") or die(mysql_error());
		echo "<form name='form1' action='TrendView.php' method='get'><br \><br \><br \><br \><br \>";
		echo "<br \><br \><br \><br \><br \><br \><table align='center' border='1'>";
		echo "<tr><td></td><td  align='center'>Store</td><td  align='center'>DataBase</td></tr>";
		while($row = mysql_fetch_array($result))
		echo "<tr><td><input type='radio' name='db' value='".$row[1]."' /></td><td  align='center'>".$row[0]."</td><td  align='center'>".$row[1]."</td></tr>";
		echo "<tr><td align='center'><input type='submit' value='Go!!' /></td></tr></table>";
		echo "</form>";
	}
}
else
{
    //require_once(dirname(__FILE__) . '/wp-login.php');
	//auth_redirect();
	header("Location:http://radsinnovativesolutions.com/wp-login.php?redirect_to=http://radsinnovativesolutions.com/TrendView.php");
	echo "
	<html>
	<head><title>TrendView</title>
	</head>
	<body>
	";
}
?>
</body>
</html>
