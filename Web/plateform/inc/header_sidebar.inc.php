<?php
    require_once('inc/db_connect.php');
    if($_SESSION['typeAccount'] == "requester"){
        $Query = $dbh->query("SELECT count(id) as count FROM message WHERE isRead = 0 AND id_sender != ".$_SESSION['idTypeAccount']." AND  id_work in
                                (SELECT id FROM work WHERE id_requester = ".$_SESSION['idTypeAccount']." AND finish = 0 AND cancelled = 0 AND paid = 0 AND id_worker is not null)");

        $newMessages = $Query->fetch(PDO::FETCH_ASSOC);
        $Query->closeCursor();
        $newMessages = $newMessages['count'];
        
    }

    else if($_SESSION['typeAccount'] == "worker"){
        $Query = $dbh->query("SELECT count(id) as count FROM message WHERE isRead = 0 AND id_sender != ".$_SESSION['idTypeAccount']." AND  id_work in
                                (SELECT id FROM work WHERE id_worker = ".$_SESSION['idTypeAccount']." AND finish = 0 AND cancelled = 0 AND paid = 0)");

        $newMessages = $Query->fetch(PDO::FETCH_ASSOC);
        $Query->closeCursor();
        $newMessages = $newMessages['count'];
    }

    if($newMessages < 1){
        $newMessages ="";
    }
?>

<div class="sidebar" data-color="orange" id="headerSidebar">
            <!--
            Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
            -->
            <div class="logo text-center">
                
                <a href="http://www.creative-tim.com" class="simple-text logo-normal">
                    Youngr
                </a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li>
                        <a href="dashboard.php">
                            <i class="now-ui-icons business_chart-bar-32"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li>
                        <a href="works.php">
                            <i class="now-ui-icons ui-2_settings-90"></i>
                            <p>Works</p>
                        </a>
                    </li>
                    <li>
                        <a href="messages.php">
                            <i class="now-ui-icons ui-1_send"></i>
                            <p>Messages <strong class="pl-5"><?php echo $newMessages ?></strong></p> 
                        </a>
                    </li>
                    
                    <li>
                        <a href="account.php">
                            <i class="now-ui-icons users_single-02"></i>
                            <p>Mon compte</p>
                        </a>
                    </li>
                    <li>
                        <a href="icons.html">
                            <i class="now-ui-icons education_atom"></i>
                            <p>Icons</p>
                        </a>
                    </li>
                    <li>
                        <a href="map.html">
                            <i class="now-ui-icons location_map-big"></i>
                            <p>Maps</p>
                        </a>
                    </li>
                    
                    <li>
                        <a href="user.html">
                            <i class="now-ui-icons users_single-02"></i>
                            <p>User Profile</p>
                        </a>
                    </li>
                    <li>
                        <a href="tables.html">
                            <i class="now-ui-icons design_bullet-list-67"></i>
                            <p>Table List</p>
                        </a>
                    </li>
                    <li>
                        <a href="typography.html">
                            <i class="now-ui-icons text_caps-small"></i>
                            <p>Typography</p>
                        </a>
                    </li>
                    <li class="active-pro">
                        <a href="upgrade.html">
                            <i class="now-ui-icons arrows-1_cloud-download-93"></i>
                            <p>Upgrade to PRO</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

<script>
    var url = window.location.href;
    var li = document.querySelectorAll('#headerSidebar li a');
    for (var i=0; i<li.length; i++) {
        if(url === li[i].href) {
            li[i].parentNode.className = 'active';
        }
    }
</script>