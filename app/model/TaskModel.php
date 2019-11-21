<?php

include_once("db.inc.php");
session_start();


class TaskModel
{


    public function updateTask($nom, $date, $notes, $lien, $id)
    {
        $db = Database::getConnexion();
        $sql = "UPDATE tache SET Nom_tach ='" . $nom . "',
                            DateLim_tach ='" . $date . "',
                            Notes_tach ='" . $notes . "',
                            Lien_tach ='" . $lien . "' WHERE
                            Id_tach ='" . $id . "' ;";
        $db->query($sql)->fetch();
    }

    public function addTask($nom, $date, $notes, $lien, $id)
    {
        $db = Database::getConnexion();
        $sql = "INSERT INTO tache(Nom_tach,DateLim_tach,Arch_tach,Notes_tach,Lien_tach,Id_list) VALUES ('" .$nom . "',
                                                                                                   '" . $date . "',
                                                                                                   0,
                                                                                                   '" . $notes . "',
                                                                                                   '" . $lien . "',
                                                                                                   '" . $id . "');";
        $db->query($sql)->fetch();
    }

    public function displayTask($id)
    {
        $db = Database::getConnexion();
        $sql = "SELECT Id_tach,Nom_tach,DateLim_tach FROM tache WHERE Id_list =" . $id . " AND tache.Arch_tach = 0";
        $ligne = $db->query($sql)->fetch();
        return $ligne;
    }

    public function getTask($id)
    {
        $db = Database::getConnexion();
        $sql = "SELECT * FROM tache WHERE id_tach ='" . $id . "';";
        $ligne = $db->query($sql)->fetch();
        return $ligne;
    }

    public function archiveTask($id)
    {
        $db = Database::getConnexion();
        $sql = "UPDATE tache SET Arch_Tach = 1 WHERE Id_tach = '" . $id . "';";
        $db->query($sql)->fetch();
    }

    public function desarchiveTask($id)
    {
        $db = Database::getConnexion();
        $sql = "UPDATE tache SET Arch_Tach = 0 WHERE Id_tach = '" . $id . "';";
        $db->query($sql)->fetch();
    }


}