<?php
    session_start();
    require_once('../inc/db_connect.php');

    if($_SESSION['typeAccount'] == "worker"){
        $Query = $dbh->query("SELECT work.id as id, profile_path,work.title as title
                                FROM work
                                JOIN requester on work.id_requester = requester.id
                                JOIN account on requester.id_account = account.id
                                WHERE finish = 0 AND cancelled = 0 AND id_worker =".$_SESSION['idTypeAccount']);

        $works = $Query->fetchAll(PDO::FETCH_ASSOC);
        $Query->closeCursor();
    }
    else if($_SESSION['typeAccount'] == "requester"){
        $Query = $dbh->query("SELECT work.id as id, profile_path,work.title as title
                                FROM work
                                JOIN worker on work.id_worker = worker.id
                                JOIN account on worker.id_account = account.id
                                WHERE finish = 0 AND cancelled = 0 AND id_requester =".$_SESSION['idTypeAccount']);

        $works = $Query->fetchAll(PDO::FETCH_ASSOC);
        $Query->closeCursor();
    }


    foreach($works as $work){
        $id=$work['id'];

        $Query = $dbh->query(" SELECT * FROM message WHERE id_work = '$id' ORDER BY sendtime desc LIMIT 1");
        $lastMessage = $Query->fetch(PDO::FETCH_ASSOC);
        $Query->closeCursor();
        $lastcontent = $lastMessage['content'];

        setlocale (LC_TIME, 'fr_FR.utf8','fra');

        $tmstp =  strtotime($lastMessage['sendtime']);
        $lastdate = strftime("%e %b", $tmstp);

        if($work['profile_path'] == null){
            $work['profile_path'] = 'img/user-1.jpg';  
        }

        if($lastMessage['isRead'] == 0 && $lastMessage['id_sender'] != $_SESSION['idTypeAccount']){
            $lastcontent = "<strong>".$lastcontent."</strong>";
        }
        echo "<a onclick='getMessages($id);' class='conv list-group-item list-group-item-action list-group-item-light rounded-0'>
                <div class='media'><img src='".$work['profile_path']."' onerror=\"this.onerror=null; this.src='img/default-user.png'\" alt='user' width='60px' class='rounded-circle'>
                    <div class='media-body ml-4'>
                        <div class='d-flex align-items-center justify-content-between mb-1'>
                            <h6 class='mb-0'>".$work['title']."</h6><small class='small font-weight-bold'>".$lastdate."</small>
                        </div>
                        <p class='font-italic text-muted mb-0 text-small'>".$lastcontent."</p>
                    </div>
                </div>
            </a>";
    }


?>