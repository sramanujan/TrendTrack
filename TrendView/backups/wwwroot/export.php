<?php
	
    //error_reporting(E_ALL);
    //date_default_timezone_set('Europe/London');
    
    require_once 'PHPExcel.php';
    $objPHPExcel = new PHPExcel();
    // Set properties
    $objPHPExcel->getProperties()->setCreator("TrendView")
    							 ->setLastModifiedBy("TrendTrack")
    							 ->setTitle("TrendView Office 2007 XLSX Document")
    							 ->setSubject("TrendView Data")
    							 ->setDescription("TrendView data is excel format.")
    							 ->setKeywords("office 2007 openxml php TrendView")
    							 ->setCategory("Test result file");
    $colors = array(1=>"FF3366CC",2=>"FFDC3912",3=>"FFFF9900",4=>"FF109618",5=>"FF990099",6=>"FF0099C6",7=>"FFDD4477",8=>"FF66AA00");
    mysql_connect("localhost","track","12charm34") or die(mysql_error());
    mysql_select_db("tt_db") or die(mysql_error());
    $t=0;
	if(strcmp($_GET['ych'],"Select")!=0)
		$q1=" AND YEAR(TIME) = ".$_GET['ych'];
	else
	{
		$q1=" ";
		$t=1;
	}
	if(strcmp($_GET['mch'],"Select")!=0)
		$q2=" AND MONTHNAME(TIME) = '".$_GET['mch']."'";
	else
	{
		$q2=" ";
		$t=2;
	}
	if(strcmp($_GET['dch'],"Select")!=0)
		$q3=" AND DAY(TIME) = ".$_GET['dch'];
	else
	{
		$q3=" ";
		$t=3;
	}
    switch ($t)
    {
    case 0:
    {
        $query=$q1.$q2.$q3." AND HOUR(TIME) = ";
        $sub=mysql_query("select distinct hour(time) from `".$_GET['db']."` where 1".$q1.$q2.$q3." order by hour(time)") or die(mysql_error());
		$objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'Category/Hour');
        $fname = "-".$_GET['dch']."-".$_GET['mch']."-".$_GET['ych'];
    }
    break;
    case 1:
    {
        $query=" AND YEAR(TIME) = ";
        $sub=mysql_query("select distinct year(time) from `".$_GET['db']."` where 1 order by year(time)") or die(mysql_error());
	    $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'Category/Year');
        $fname = "-ALL";
    }
    break;
    case 2:
    {
        $query=$q1." AND MONTHNAME(TIME) = ";
        $sub=mysql_query("select distinct monthname(time) from `".$_GET['db']."` where 1".$q1." order by month(time)") or die(mysql_error());
		$objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'Category/Month');
        $fname = "-".$_GET['ych'];
    }
    break;
    case 3:
    {
        $query=$q1.$q2." AND DAY(TIME) = ";
        $sub=mysql_query("select distinct day(time) from `".$_GET['db']."` where 1".$q1.$q2." order by day(time)") or die(mysql_error());
		$objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'Category/Day');
        $fname = "-".$_GET['mch']."-".$_GET['ych'];
    }
    break;
	}
    $styleTBBO = array(
    	'borders' => array(
    		'outline' => array(
    			'style' => PHPExcel_Style_Border::BORDER_THICK,
    			'color' => array('argb' => 'FF993300'),
    		),
    	),
    );
    $styleTBBI = array(
    	'borders' => array(
    		'outline' => array(
    			'style' => PHPExcel_Style_Border::BORDER_THIN,
    			'color' => array('argb' => 'FF000000'),
    		),
    	),
    );
	if(isset($_GET['sex']))
	{
		if(isset($_GET['age']))
		{
		//both
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A3', 'Male-Kids')
                    ->setCellValue('A6', 'Male-Teens')
                    ->setCellValue('A9', 'Male-Adult')
            		->setCellValue('A12', 'Male-Senior')
                    ->setCellValue('A15', 'Female-Kids')
                    ->setCellValue('A18', 'Female-Teens')
            		->setCellValue('A21', 'Female-Adult')
                    ->setCellValue('A24', 'Female-Senior');
            for ($i=2; $i<=25; $i+=3)
            {
                $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue("B".$i,'W')
                            ->setCellValue("B".($i+1),'P')
                            ->setCellValue("B".($i+2),'C');
            }
			if($row2 = mysql_fetch_array($sub))
				$cnt = 67;
			else
				$cnt=-67;
			while($cnt>0)
			{
				$result = mysql_query("select 0+sex,0+age,sum(walkin),sum(purchase) from `".$_GET['db']."` where 1".$query.$row2[0]." group by sex,age") or die(mysql_error());
				$array = array(1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0);
				$array2 = array(1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0);
				$conv = array(1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0);
				$catsum = array(1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0);
				$catsum2 = array(1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0);
				$totsum = 0;
				$totsum2 = 0;
				while($row = mysql_fetch_array($result))
				{
					$ar = (($row[0]-1)*4)+$row[1];
					$array[$ar] = $row[2];
					$array2[$ar] = $row[3];
					if($row[2]!=0)
					$conv[$ar] = intval(($row[3]/$row[2])*100);
					else
					$conv[$ar] = "NA";
					$catsum[$ar]+=$row[2];
					$catsum2[$ar]+=$row[3];
					$totsum+=$row[2];
					$totsum2+=$row[3];
				}
                $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue(chr($cnt)."1",$row2[0]);
                $objPHPExcel->getActiveSheet()->getStyle(chr($cnt)."1")->applyFromArray($styleTBBI);
				for ($i=1; $i<=8; $i++)
                {
                    $objPHPExcel->setActiveSheetIndex(0)
                                ->setCellValue(chr($cnt).(3*$i-1),$array[$i])
                                ->setCellValue(chr($cnt).(3*$i),$array2[$i])
                                ->setCellValue(chr($cnt).(3*$i+1),$conv[$i]);
                    $objPHPExcel->getActiveSheet()->getStyle(chr($cnt).(3*$i-1))->applyFromArray($styleTBBI);
                    $objPHPExcel->getActiveSheet()->getStyle(chr($cnt).(3*$i))->applyFromArray($styleTBBI);
                    $objPHPExcel->getActiveSheet()->getStyle(chr($cnt).(3*$i+1))->applyFromArray($styleTBBI);
                }
				if($row2 = mysql_fetch_array($sub))
					$cnt++;
				else
					$cnt=-$cnt;
			}
			
			for ($i=1; $i<=8; $i++)
			{
			$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue(chr(1-$cnt).(3*$i-1),$catsum[$i])
				->setCellValue(chr(1-$cnt).(3*$i),$catsum2[$i]);
			if($catsum[$i]==0)
			{
				$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue(chr(1-$cnt).(3*$i+1),"NA");
			}
			else
			{
				$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue(chr(1-$cnt).(3*$i+1),intval($catsum2[$i]*100/$catsum[$i]));
			}
			$objPHPExcel->getActiveSheet()->getStyle(chr(1-$cnt).(3*$i-1))->applyFromArray($styleTBBI);
			$objPHPExcel->getActiveSheet()->getStyle(chr(1-$cnt).(3*$i))->applyFromArray($styleTBBI);
			$objPHPExcel->getActiveSheet()->getStyle(chr(1-$cnt).(3*$i+1))->applyFromArray($styleTBBI);
			}
			$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue(chr(2-$cnt).(3*9-1),$totsum)
			->setCellValue(chr(2-$cnt).(3*9),$totsum2)
			->setCellValue(chr(2-$cnt).(3*9+1),intval($totsum2*100/$totsum));
			$objPHPExcel->getActiveSheet()->getStyle(chr(2-$cnt).(3*9-1))->applyFromArray($styleTBBI);
			$objPHPExcel->getActiveSheet()->getStyle(chr(2-$cnt).(3*9))->applyFromArray($styleTBBI);
			$objPHPExcel->getActiveSheet()->getStyle(chr(2-$cnt).(3*9+1))->applyFromArray($styleTBBI);
			
            $objPHPExcel->getActiveSheet()->getStyle("A1:".chr(-$cnt)."1")->applyFromArray($styleTBBO);
            $objPHPExcel->getActiveSheet()->getStyle("A1:".chr(-$cnt)."25")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
            $objPHPExcel->getActiveSheet()->getStyle("A1:".chr(-$cnt)."1")->getFill()->getStartColor()->setARGB("FFFFFF00");
            for($i=1;$i<=8;$i++)
            {
                $objPHPExcel->getActiveSheet()->getStyle("A".(3*$i-1).":".chr(-$cnt).(3*$i+1))->getFill()->getStartColor()->setARGB($colors[$i]);
                $objPHPExcel->getActiveSheet()->getStyle("A".(3*$i-1).":".chr(-$cnt).(3*$i+1))->applyFromArray($styleTBBO);
            }
                 
		}
		else
		{
		//just sex
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A3', 'Male')
                    ->setCellValue('A6', 'Female');
            for ($i=2; $i<=7; $i+=3)
            {
                $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue("B".$i,'W')
                            ->setCellValue("B".($i+1),'P')
                            ->setCellValue("B".($i+2),'C');
            }
			if($row2 = mysql_fetch_array($sub))
				$cnt = 67;
			else
				$cnt=-67;
			while($cnt>0)
			{
				$result = mysql_query("select 0+sex,sum(walkin),sum(purchase) from `".$_GET['db']."` where 1".$query.$row2[0]." group by sex") or die(mysql_error());
				$array = array(1=>0,2=>0);
				$array2 = array(1=>0,2=>0);
				$conv = array(1=>0,2=>0);
				$catsum = array(1=>0,2=>0);
				$catsum2 = array(1=>0,2=>0);
				$totsum = 0;
				$totsum2 = 0;
				while($row = mysql_fetch_array($result))
				{
					$ar = $row[0];
					$array[$ar] = $row[1];
					$array2[$ar] = $row[2];
					if($row[1]!=0)
					$conv[$ar] = intval(($row[2]/$row[1])*100);
					else
					$conv[$ar] = "NA";
					$catsum[$ar]+=$row[2];
					$catsum2[$ar]+=$row[3];
					$totsum+=$row[2];
					$totsum2+=$row[3];
				}
                $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue(chr($cnt)."1",$row2[0]);
                $objPHPExcel->getActiveSheet()->getStyle(chr($cnt)."1")->applyFromArray($styleTBBI);
				for ($i=1; $i<=2; $i++)
                {
                    $objPHPExcel->setActiveSheetIndex(0)
                                ->setCellValue(chr($cnt).(3*$i-1),$array[$i])
                                ->setCellValue(chr($cnt).(3*$i),$array2[$i])
                                ->setCellValue(chr($cnt).(3*$i+1),$conv[$i]);
                    $objPHPExcel->getActiveSheet()->getStyle(chr($cnt).(3*$i-1))->applyFromArray($styleTBBI);
                    $objPHPExcel->getActiveSheet()->getStyle(chr($cnt).(3*$i))->applyFromArray($styleTBBI);
                    $objPHPExcel->getActiveSheet()->getStyle(chr($cnt).(3*$i+1))->applyFromArray($styleTBBI);
                }
				if($row2 = mysql_fetch_array($sub))
					$cnt++;
				else
					$cnt=-$cnt;
			}
			$cnt++;
			for ($i=1; $i<=2; $i++)
			{
			$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue(chr(1-$cnt).(3*$i-1),$catsum[$i])
			->setCellValue(chr(1-$cnt).(3*$i),$catsum2[$i]);
			if($catsum[$i]==0)
			{
				$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue(chr(1-$cnt).(3*$i+1),"NA");
			}
			else
			{
				$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue(chr(1-$cnt).(3*$i+1),intval($catsum2[$i]*100/$catsum[$i]));
			}
			$objPHPExcel->getActiveSheet()->getStyle(chr(1-$cnt).(3*$i-1))->applyFromArray($styleTBBI);
			$objPHPExcel->getActiveSheet()->getStyle(chr(1-$cnt).(3*$i))->applyFromArray($styleTBBI);
			$objPHPExcel->getActiveSheet()->getStyle(chr(1-$cnt).(3*$i+1))->applyFromArray($styleTBBI);
			}
			$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue(chr(2-$cnt).(3*3-1),$totsum)
			->setCellValue(chr(2-$cnt).(3*3),$totsum2)
			->setCellValue(chr(2-$cnt).(3*3+1),intval($totsum2*100/$totsum));
			$objPHPExcel->getActiveSheet()->getStyle(chr(2-$cnt).(3*3-1))->applyFromArray($styleTBBI);
			$objPHPExcel->getActiveSheet()->getStyle(chr(2-$cnt).(3*3))->applyFromArray($styleTBBI);
			$objPHPExcel->getActiveSheet()->getStyle(chr(2-$cnt).(3*3+1))->applyFromArray($styleTBBI);
			
            $objPHPExcel->getActiveSheet()->getStyle("A1:".chr(-$cnt)."1")->applyFromArray($styleTBBO);
            $objPHPExcel->getActiveSheet()->getStyle("A1:".chr(-$cnt)."7")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
            $objPHPExcel->getActiveSheet()->getStyle("A1:".chr(-$cnt)."1")->getFill()->getStartColor()->setARGB("FFFFFF00");
            for($i=1;$i<=2;$i++)
            {    
                $objPHPExcel->getActiveSheet()->getStyle("A".(3*$i-1).":".chr(-$cnt).(3*$i+1))->getFill()->getStartColor()->setARGB($colors[$i]);
                $objPHPExcel->getActiveSheet()->getStyle("A".(3*$i-1).":".chr(-$cnt).(3*$i+1))->applyFromArray($styleTBBO);
            }
		}
	}
	else
	{
		if(isset($_GET['age']))
		{
		//just age
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A3', 'Kids')
                    ->setCellValue('A6', 'Teens')
            		->setCellValue('A9', 'Adult')
                    ->setCellValue('A12', 'Senior');
            for ($i=2; $i<=13; $i+=3)
            {
                $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue("B".$i,'W')
                            ->setCellValue("B".($i+1),'P')
                            ->setCellValue("B".($i+2),'C');
            }
			if($row2 = mysql_fetch_array($sub))
				$cnt = 67;
			else
				$cnt=-67;
			while($cnt>0)
			{
				$result = mysql_query("select 0+age,sum(walkin),sum(purchase) from `".$_GET['db']."` where 1".$query.$row2[0]." group by age") or die(mysql_error());
				$array = array(1=>0,2=>0,3=>0,4=>0);
				$array2 = array(1=>0,2=>0,3=>0,4=>0);
				$conv = array(1=>0,2=>0,3=>0,4=>0);
				$catsum = array(1=>0,2=>0,3=>0,4=>0);
				$catsum2 = array(1=>0,2=>0,3=>0,4=>0);
				$totsum = 0;
				$totsum2 = 0;
				while($row = mysql_fetch_array($result))
				{
					$ar = $row[0];
					$array[$ar] = $row[1];
					$array2[$ar] = $row[2];
					if($row[1]!=0)
					$conv[$ar] = intval(($row[2]/$row[1])*100);
					else
					$conv[$ar] = "NA";
					$catsum[$ar]+=$row[2];
					$catsum2[$ar]+=$row[3];
					$totsum+=$row[2];
					$totsum2+=$row[3];
				}
                $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue(chr($cnt)."1",$row2[0]);
                $objPHPExcel->getActiveSheet()->getStyle(chr($cnt)."1")->applyFromArray($styleTBBI);
				for ($i=1; $i<=4; $i++)
                {
                    $objPHPExcel->setActiveSheetIndex(0)
                                ->setCellValue(chr($cnt).(3*$i-1),$array[$i])
                                ->setCellValue(chr($cnt).(3*$i),$array2[$i])
                                ->setCellValue(chr($cnt).(3*$i+1),$conv[$i]);
                    $objPHPExcel->getActiveSheet()->getStyle(chr($cnt).(3*$i-1))->applyFromArray($styleTBBI);
                    $objPHPExcel->getActiveSheet()->getStyle(chr($cnt).(3*$i))->applyFromArray($styleTBBI);
                    $objPHPExcel->getActiveSheet()->getStyle(chr($cnt).(3*$i+1))->applyFromArray($styleTBBI);
                }
				if($row2 = mysql_fetch_array($sub))
					$cnt++;
				else
					$cnt=-$cnt;
			}
			$cnt++;
			for ($i=1; $i<=4; $i++)
			{
			$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue(chr(1-$cnt).(3*$i-1),$catsum[$i])
			->setCellValue(chr(1-$cnt).(3*$i),$catsum2[$i]);
			if($catsum[$i]==0)
			{
				$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue(chr(1-$cnt).(3*$i+1),"NA");
			}
			else
			{
				$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue(chr(1-$cnt).(3*$i+1),intval($catsum2[$i]*100/$catsum[$i]));
			}
			$objPHPExcel->getActiveSheet()->getStyle(chr(1-$cnt).(3*$i-1))->applyFromArray($styleTBBI);
			$objPHPExcel->getActiveSheet()->getStyle(chr(1-$cnt).(3*$i))->applyFromArray($styleTBBI);
			$objPHPExcel->getActiveSheet()->getStyle(chr(1-$cnt).(3*$i+1))->applyFromArray($styleTBBI);
			}
			$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue(chr(2-$cnt).(3*4-1),$totsum)
			->setCellValue(chr(2-$cnt).(3*4),$totsum2)
			->setCellValue(chr(2-$cnt).(3*4+1),intval($totsum2*100/$totsum));
			$objPHPExcel->getActiveSheet()->getStyle(chr(2-$cnt).(3*4-1))->applyFromArray($styleTBBI);
			$objPHPExcel->getActiveSheet()->getStyle(chr(2-$cnt).(3*4))->applyFromArray($styleTBBI);
			$objPHPExcel->getActiveSheet()->getStyle(chr(2-$cnt).(3*4+1))->applyFromArray($styleTBBI);
			
            $objPHPExcel->getActiveSheet()->getStyle("A1:".chr(-$cnt)."1")->applyFromArray($styleTBBO);
            $objPHPExcel->getActiveSheet()->getStyle("A1:".chr(-$cnt)."13")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
            $objPHPExcel->getActiveSheet()->getStyle("A1:".chr(-$cnt)."1")->getFill()->getStartColor()->setARGB("FFFFFF00");
            for($i=1;$i<=4;$i++)
            {
                $objPHPExcel->getActiveSheet()->getStyle("A".(3*$i-1).":".chr(-$cnt).(3*$i+1))->getFill()->getStartColor()->setARGB($colors[$i]);
                $objPHPExcel->getActiveSheet()->getStyle("A".(3*$i-1).":".chr(-$cnt).(3*$i+1))->applyFromArray($styleTBBO);
            }
		}
		else
		{
		//just total
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A3', 'Total');
            $i=2;
            $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("B".$i,'W')
                        ->setCellValue("B".($i+1),'P')
                        ->setCellValue("B".($i+2),'C');
			if($row2 = mysql_fetch_array($sub))
				$cnt = 67;
			else
				$cnt=-67;
			while($cnt>0)
			{
				$result = mysql_query("select sum(walkin),sum(purchase) from `".$_GET['db']."` where 1".$query.$row2[0]) or die(mysql_error());
				$array = array(1=>0);
				$array2 = array(1=>0);
				$conv = array(1=>0);
				$totsum = 0;
				$totsum2 = 0;
				while($row = mysql_fetch_array($result))
				{
					$array[1] = $row[0];
					$array2[1] = $row[1];
					if($row[0]!=0)
					$conv[1] = intval(($row[1]/$row[0])*100);
					else
					$conv[1] = "NA";
					$totsum+=$row[2];
					$totsum2+=$row[3];
				}
                $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue(chr($cnt)."1",$row2[0]);
                $objPHPExcel->getActiveSheet()->getStyle(chr($cnt)."1")->applyFromArray($styleTBBI);
				$i=1;
                $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue(chr($cnt).(3*$i-1),$array[$i])
                            ->setCellValue(chr($cnt).(3*$i),$array2[$i])
                            ->setCellValue(chr($cnt).(3*$i+1),$conv[$i]);
                $objPHPExcel->getActiveSheet()->getStyle(chr($cnt).(3*$i-1))->applyFromArray($styleTBBI);
                $objPHPExcel->getActiveSheet()->getStyle(chr($cnt).(3*$i))->applyFromArray($styleTBBI);
                $objPHPExcel->getActiveSheet()->getStyle(chr($cnt).(3*$i+1))->applyFromArray($styleTBBI);
				if($row2 = mysql_fetch_array($sub))
					$cnt++;
				else
					$cnt=-$cnt;
			}
			$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue(chr(2-$cnt).(3*1-1),$totsum)
			->setCellValue(chr(2-$cnt).(3*1),$totsum2)
			->setCellValue(chr(2-$cnt).(3*1+1),intval($totsum2*100/$totsum));
			$objPHPExcel->getActiveSheet()->getStyle(chr(2-$cnt).(3*1-1))->applyFromArray($styleTBBI);
			$objPHPExcel->getActiveSheet()->getStyle(chr(2-$cnt).(3*1))->applyFromArray($styleTBBI);
			$objPHPExcel->getActiveSheet()->getStyle(chr(2-$cnt).(3*1+1))->applyFromArray($styleTBBI);
			
            $objPHPExcel->getActiveSheet()->getStyle("A1:".chr(-$cnt)."1")->applyFromArray($styleTBBO);
            $objPHPExcel->getActiveSheet()->getStyle("A1:".chr(-$cnt)."4")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
            $objPHPExcel->getActiveSheet()->getStyle("A1:".chr(-$cnt)."1")->getFill()->getStartColor()->setARGB("FFFFFF00");
            $i=1;
            $objPHPExcel->getActiveSheet()->getStyle("A".(3*$i-1).":".chr(-$cnt).(3*$i+1))->applyFromArray($styleTBBO);
            $objPHPExcel->getActiveSheet()->getStyle("A".(3*$i-1).":".chr(-$cnt).(3*$i+1))->getFill()->getStartColor()->setARGB($colors[$i]);
		}
	}
    $fname = "TrendView-".$_GET['db'].$fname;    
    $objPHPExcel->getActiveSheet()->setShowGridlines(false);

    $objPHPExcel->getActiveSheet()->setTitle('TrendView');
    
    $objPHPExcel->setActiveSheetIndex(0);
    
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment;filename=".$fname);
    header('Cache-Control: max-age=0');
    
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('php://output');
exit();
?>