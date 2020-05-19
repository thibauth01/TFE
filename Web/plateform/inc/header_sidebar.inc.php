<?php
    require_once('inc/db_connect.php');
    
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
                            <i class="now-ui-icons objects_spaceship"></i>
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
                            <p>Messages <strong class="pl-5" id="sideMessage"></strong></p> 
                        </a>
                    </li>
                    <li>
                        <a href="notifications.php">
                            <i class="now-ui-icons ui-1_bell-53"></i>
                            <p>Notifications <strong class="pl-5" id="sideNotifications"></strong></p>
                        </a>
                    </li>
                    <li>
                        <a href="statistiques.php">
                            <i class="now-ui-icons business_chart-bar-32"></i>
                            <p>Statistiques</p>
                        </a>
                    </li>
                    <li>
                        <a href="account.php">
                            <i class="now-ui-icons users_single-02"></i>
                            <p>Mon compte</p>
                        </a>
                    </li>
                   
                    <li class="active-pro">
                        <a href="connexion.php">
                            <i class="now-ui-icons sport_user-run"></i>
                            <p>Déconnexion</p>
                        </a>
                    </li>
                    <!-- <li>
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
                    </li> -->
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