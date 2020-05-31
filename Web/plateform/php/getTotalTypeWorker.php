<?php
    session_start();
    require_once('../inc/db_connect.php');
    require_once('utils.php');
    

    $toReturn = array(
        'labels' => [],
        'data' => []
    );

    $Query = $dbh->query("SELECT name, count(work.id) as count
                            FROM work
                            JOIN type_work on work.id_type = type_work.id
                            WHERE finish = 1 AND paid = 1 AND cancelled = 0 AND id_worker = '".$_SESSION['idTypeAccount']."'
                            group by name");

    $works = $Query->fetchAll(PDO::FETCH_ASSOC);
    $Query->closeCursor();

    foreach ($works as $key => $work) {
       array_push($toReturn['labels'],$work['name']);
       array_push($toReturn['data'],$work['count']);


    }


    print_r(json_encode($toReturn));