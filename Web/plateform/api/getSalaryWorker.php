<?php

    require_once('../inc/db_connect.php');
    require_once('../php/utils.php');


    $json = file_get_contents('php://input'); 	
    $obj = json_decode($json,true);

    $idWorker = trim(htmlspecialchars($obj['idWorker']));
    $idAccount = trim(htmlspecialchars($obj['idAccount']));
    $jwt = trim(htmlspecialchars($obj['jwt']));

    if($jwt == null){
        print_r('access denied');
        die();
    }

    $Query = $dbh->query("SELECT jwt FROM account WHERE id = ".$idAccount);
    $jwtAccount = $Query->fetch(PDO::FETCH_ASSOC);
    $Query->closeCursor();

    if($jwtAccount['jwt'] == $jwt){
        $toReturn = [0,0,0,0,0,0,0,0,0,0,0,0];

        $Query = $dbh->query("SELECT date_start,time_start,time_end,price
                                FROM work 
                                WHERE finish = 1 AND paid = 1 AND cancelled = 0 AND id_worker = ".$idWorker);

        $works = $Query->fetchAll(PDO::FETCH_ASSOC);
        $Query->closeCursor();

        $workDateOK=array();
        foreach ($works as $key => $work) {
        $time =  strtotime($work['date_start']);
        $nowtime = strtotime("now");

        $year=date("Y",$time);
        $yearNow=date("Y",$nowtime);

        if($year == $yearNow){
                array_push($workDateOK,$work);
        }
        }

        foreach ($workDateOK as $key => $work) {
            $minutesWork = timeSpace($work['time_start'],$work['time_end']);
            $price = $minutesWork * ($work['price']/60);
            $price= (float)round($price,2);

            $time =  strtotime($work['date_start']);
            $month=date("n",$time);

            $toReturn[$month -1] += $price;

        
        }

        echo json_encode($toReturn);

    }
    else{
        print_r('access denied');
    }

    