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
                                echo "<a onclick='getMessages($id);' class='list-group-item list-group-item-action list-group-item-light rounded-0'>
                                        <div class='media'><img src='img/user-1.jpg' alt='user' width='50' class='rounded-circle'>
                                            <div class='media-body ml-4'>
                                                <div class='d-flex align-items-center justify-content-between mb-1'>
                                                    <h6 class='mb-0'>".$work['title']."</h6><small class='small font-weight-bold'>25 Dec</small>
                                                </div>
                                                <p class='font-italic text-muted mb-0 text-small'>Ok for 16888</p>
                                            </div>
                                        </div>
                                    </a>";
                            }
                        
                        ?>
                        <!--
                        <a class="list-group-item list-group-item-action active text-white rounded-0">
                            <div class="media"><img src="img/user-1.jpg" alt="user" width="50" class="rounded-circle">
                                <div class="media-body ml-4">
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <h6 class="mb-0">Thibaut Hermant</h6><small class="small font-weight-bold">25 Dec</small>
                                    </div>
                                    <p class="font-italic mb-0 text-small">Ok for 16h30</p>
                                </div>
                            </div>
                        </a>

                        <a href="#" class="list-group-item list-group-item-action list-group-item-light rounded-0">
                            <div class="media"><img src="https://res.cloudinary.com/mhmd/image/upload/v1564960395/avatar_usae7z.svg" alt="user" width="50" class="rounded-circle">
                                <div class="media-body ml-4">
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <h6 class="mb-0">Jason Doe</h6><small class="small font-weight-bold">9 Nov</small>
                                    </div>
                                    <p class="font-italic text-muted mb-0 text-small">consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>
                                </div>
                            </div>
                        </a>-->

                    </div>
                </div>
            </div>
        </div>


        <!-- Chat Box-->
        <div class="col-7 px-0">
            <div class="px-4 py-5 chat-box bg-white" id="chatBox">
               
            </div>


             <!-- Typing area -->
             <form onsubmit="event.preventDefault(); sendMessage();" class="bg-light">
                <div class="row" >
                    <div class="col-md-10" >
                        <textarea id="textareaSend" type="text" placeholder="Ecrivez un message" class="form-control "></textarea>
                    </div>
                    <div class="col-md-2">
                        <div class="input-group-append">
                            <button  type="submit" class="btn btn-link"> <i class="fa fa-paper-plane"></i></button>
                        </div>
                    </div>
                </div>
            </form>

            

        </div>
    </div>
</div>