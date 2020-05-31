<?php
    session_start();
    require_once('../inc/db_connect.php');
    require_once('utils.php');


    $toReturn = array(
        'labels' => [],
        'data' => []
    );

    $Query = $dbh->query("SELECT city, count(work.id) as count
                            FROM work
                            JOIN requester on id_requester = requester.id
                            JOIN account on requester.id_account = account.id
                            WHERE finish = 1 AND paid = 1 AND cancelled = 0 AND id_worker = '".$_SESSION['idTypeAccount']."'
                            group by city
                            order by count desc");

    $works = $Query->fetchAll(PDO::FETCH_ASSOC);
    $Query->closeCursor();

    foreach ($works as $key => $work) {
       array_push($toReturn['labels'],$work['city']);
       array_push($toReturn['data'],$work['count']);


    }


    print_r(json_encode($toReturn));