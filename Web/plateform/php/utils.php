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

function calculStars($stars){
    $total;
    if(sizeof($stars) < 1){
        return -1;
    }
    else{
        foreach ($stars as $key => $star) {
            $total += (int)$star['star'];
            
        }
        return intval($total/sizeof($stars));
    }
    
}
