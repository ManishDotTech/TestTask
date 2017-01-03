<?php
/*
  /*
 * @function name	: index
 * @purpose			: It purpose
 * @arguments		: none
 * @return			: none
 * @created by		: Dot Team
 * @created on		: NA
 * @description		: NA
*/
 
 
 * 
*/

class TestTask{

function arrayDiffToHtmlTable( $prevArray, $currArray) {
  // Convert json array to object array
   $prevArrayObj = json_decode($prevArray);
   $currArrayObj = json_decode($currArray);
  
   $headerkeys=array();
   
   foreach($currArrayObj as $level1=>$levelval)
   {
	    
    
	 foreach($levelval->meta as $level2=>$levelval2)
	 {
	  $headerkeys[]=$level2;
	 }
   }
 
    $headerkeys=array_unique($headerkeys);
	$htmlString='<table  border="1"><tr>';	
	$htmlString.='<th>_id</th>';
	$htmlString.='<th>someKey</th>';
	foreach($headerkeys as $level3=>$levelval3)
	{
	$htmlString.='<th>'.$levelval3.'</th>';
	}
	$htmlString.='</tr>';
	
	
	foreach($currArrayObj as $level4=>$levelval4)
	{
	$bold='';
		if($level4==1){ $bold='font-weight:bold;'; }
		$htmlString.='<tr style='.$bold.'>';
		$htmlString.='<td>'.$levelval4->_id.'</td>';
		$htmlString.='<td>'.$levelval4->someKey.'</td>';
			foreach($headerkeys as $keyname)
			{
			 $htmlString.='<td>';
			 if($levelval4->meta->$keyname)
			 $htmlString.=$levelval4->meta->$keyname;
			 else 
			 {
		
			 if($prevArrayObj[$level4]->meta->$keyname)
			 $htmlString.='<b>Deleted</b>';
			 }
			 $htmlString.='</td>';
			}
		$htmlString.='</tr>';
	}
	
	$htmlString.='</table>';
    return $htmlString;
}
}

/*------------Previous and current array which is being passed in a function as an argument-----------------*/
$prevArray = '[{"_id":1,"someKey":"RINGING","meta":{"subKey1":1234,"subKey2":52}}]';
$currArray = '[{"_id":1,"someKey":"HANGUP","meta":{"subKey1":1234}},{"_id":2,"someKey":"RINGING","meta":{"subKey1":5678,"subKey2":207,"subKey3":52}}]';
/*-----------------------------*/


$taskObj=new TestTask();
echo $taskObj->arrayDiffToHtmlTable( $prevArray, $currArray);// function called here

?>

