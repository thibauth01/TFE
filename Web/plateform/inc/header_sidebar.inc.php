

<div class="sidebar" data-color="orange" id="headerSidebar">
            <!--
            Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
            -->
            <div class="logo">
                <a href="http://www.creative-tim.com" class="simple-text logo-mini">
                    YGR
                </a>
                <a href="http://www.creative-tim.com" class="simple-text logo-normal">
                    Youngr
                </a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li>
                        <a href="dashboard.php">
                            <i class="now-ui-icons ui-2_settings-90"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li>
                        <a href="dashboard_requester.php">
                            <i class="now-ui-icons ui-2_settings-90"></i>
                            <p>Dashboard Requester</p>
                        </a>
                    </li>
                    <li>
                        <a href="works.php">
                            <i class="now-ui-icons ui-2_settings-90"></i>
                            <p>Works</p>
                        </a>
                    </li>
                    <li>
                        <a href="works_requester.php">
                            <i class="now-ui-icons ui-2_settings-90"></i>
                            <p>Works Requester</p>
                        </a>
                    </li>
                    <li>
                        <a href="messages.php">
                            <i class="now-ui-icons ui-2_settings-90"></i>
                            <p>Messages</p>
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
                        <a href="notifications.html">
                            <i class="now-ui-icons ui-1_bell-53"></i>
                            <p>Notifications</p>
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