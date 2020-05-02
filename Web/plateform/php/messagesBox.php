<div class="container mt-6 px-4">
    <div class="row rounded-lg overflow-hidden shadow">
        <!-- Users box-->
        <div class="col-5 px-0 bg-white list-group-item">
            <div class="bg-white">

                <div class="bg-gray px-4 py-2 bg-light">
                    <p class="h5 mb-0 py-1">Mes conversations</p>
                </div>

                <div class="messages-box">
                    <?php
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
                        else{
                            echo "Error";
                        }

                        

                       
                    ?>
                    <div class="list-group rounded-0">

                    
                        <?php
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
                                        <div class='media'><img src='".$work['profile_path']."' alt='user' width='60px' class='rounded-circle'>
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

                    </div>
                </div>
            </div>
        </div>

        
        <!-- Chat Box-->
        <div class="col-7 px-0">
            <div class="px-4 py-5 chat-box bg-white" id="chatBox">
               
            </div>


             <!-- Typing area -->
             <form id="formSendMessage" onsubmit="event.preventDefault(); sendMessage();" class="bg-light">
                <div class="row" >
                    <div class="col-md-10" >
                        <textarea id="textareaSend" type="text" placeholder="Ecrivez un message" class="form-control "></textarea>
                    </div>
                    <div class="col-md-2">
                        <div class="input-group-append">
                            <button  type="submit" class="btn btn-link"> <i class="text-primary fa fa-paper-plane"></i></button>
                        </div>
                    </div>
                </div>
            </form>

            

        </div>
    </div>
</div>