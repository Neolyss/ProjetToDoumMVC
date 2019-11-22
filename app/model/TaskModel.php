<?php

class TaskModel
{


    public static function updateTask($nom, $date, $notes, $lien, $id)
    {
        $db = Database::getConnexion();
        $sql = "UPDATE tache SET Nom_tach ='" . $nom . "',
                            DateLim_tach ='" . $date . "',
                            Notes_tach ='" . $notes . "',
                            Lien_tach ='" . $lien . "' WHERE
                            Id_tach ='" . $id . "' ;";
        $db->query($sql)->fetch();
    }

    public static function addTask($nom, $date, $notes, $lien, $id)
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

    public static function archiveTask($idTask)
    {
        $db = Database::getConnexion();
        $sql = "UPDATE tache SET Arch_Tach = 1 WHERE Id_tach = '" . $idTask . "';";
        $db->query($sql);
    }

    public static function desarchiveTask($idTask)
    {
        $db = Database::getConnexion();
        $sql = "UPDATE tache SET Arch_Tach = 0 WHERE Id_tach = '" . $idTask . "';";
        $db->query($sql)->fetch();
    }

}