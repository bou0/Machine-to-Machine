<?php
    require_once 'params.php';// chemin vers nomtable_user_data && nomtable_user_object
    require_once 'connect_db.php';// chemin vers les outils de connexion à la db
    
    
    //Création de la table user_data
    $create_table_user_data = 'CREATE TABLE `'.nomtable_user_data($email).'`(
                    `date` datetime NOT NULL,
                    `object_id` int(11) NOT NULL,
                     PRIMARY KEY (`date`)
                    )';
    //Création de la table user_object
    $create_table_user_object = 'CREATE TABLE `'.nomtable_user_object($email).'`(
                    `id` int(11) NOT NULL,
                    `nom` varchar(250) NOT NULL,
                    `description` varchar(250) NOT NULL,
                    `mesure` double NOT NULL,
                    `unite` varchar(255) NOT NULL,
                    PRIMARY KEY (`id`)
                    )';
    
    $db->exec($create_table_user_data);
    
    $db->exec($create_table_user_object);
//     function tables_data_objects(){}
?>