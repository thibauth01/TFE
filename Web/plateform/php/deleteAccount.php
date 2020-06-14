<?php

    require_once('../inc/db_connect.php');
    session_start();

    $Query = $dbh->query(" UPDATE account
                                    SET first_name = 'Utilisateur',
                                    last_name = 'supprimé',
                                    email= null,
                                    username= null,
                                    password=null,
                                    birth_date=null,
                                    street=null,
                                    postcode=null,
                                    city=null,
                                    country=null,
                                    phone=null,
                                    profile_path=null

                                    WHERE id =".$_SESSION['idAccount']);



    $Query->closeCursor();

    