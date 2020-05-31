<?php
    session_start();
    require_once('../inc/db_connect.php');
    require_once('utils.php');


    $toReturn = [0,0,0,0,0,0,0,0,0,0,0,0];

    $Query = $dbh->query("SELECT date_start
                            FROM work 
                            WHERE finish = 1 AND paid = 1 AND cancelled = 0 AND id_requester = ".$_SESSION['idTypeAccount']);

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
        
        $time =  strtotime($work['date_start']);
        $month=date("n",$time);

        $toReturn[$month -1] += 1;
    }



    print_r(json_encode($toReturn));