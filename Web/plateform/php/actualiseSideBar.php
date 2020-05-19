<?php
    session_start();
    require_once('../inc/db_connect.php');

    $toReturn = array(
        'messages' => null,
        'notifications' => null,
    );


    //         ACTUALISE MESSAGES

    if($_SESSION['typeAccount'] == "requester"){
        $Query = $dbh->query("SELECT count(id) as count FROM message WHERE isRead = 0 AND id_sender != ".$_SESSION['idTypeAccount']." AND  id_work in
                                (SELECT id FROM work WHERE id_requester = ".$_SESSION['idTypeAccount']." AND finish = 0 AND cancelled = 0 AND paid = 0 AND id_worker is not null)");

        $newMessages = $Query->fetch(PDO::FETCH_ASSOC);
        $Query->closeCursor();
        $toReturn['messages'] = $newMessages['count'];
        
    }

    else if($_SESSION['typeAccount'] == "worker"){
        $Query = $dbh->query("SELECT count(id) as count FROM message WHERE isRead = 0 AND id_sender != ".$_SESSION['idTypeAccount']." AND  id_work in
                                (SELECT id FROM work WHERE id_worker = ".$_SESSION['idTypeAccount']." AND finish = 0 AND cancelled = 0 AND paid = 0)");

        $newMessages = $Query->fetch(PDO::FETCH_ASSOC);
        $Query->closeCursor();
        $toReturn['messages'] = $newMessages['count'];
    }

    if($toReturn['messages']  < 1){
        $toReturn['messages'] ="";
    }
    
    print_r(json_encode($toReturn));

    //ACTUALISE NOTIFICATIONS


?>