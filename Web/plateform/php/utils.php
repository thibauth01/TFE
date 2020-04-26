<?php
function age($date){
    $today = date("Y-m-d");
    $diff = date_diff(date_create($date), date_create($today));
    return $diff->format('%y');
}
function timeSpace($start,$end){
    $starttimestamp = strtotime($start);
	$endtimestamp = strtotime($end);
	$difference = abs($endtimestamp - $starttimestamp)/60;
	return $difference;
    
}
function notPassedWorks($all){
    $notPassed=array();
    foreach($all as $work){
        $tmstp =  strtotime($work['date_start']);
        $date =  date("Ymd", $tmstp);
        $now = date("Ymd");
        
        if($date >= $now){
            array_push($notPassed,$work);
        }
    }
    return $notPassed;

}