<?php

class TaskModel extends Model
{

    public static function updateTask($nom, $date, $notes, $lien, $idTask)
    {
        $date = date_create($date);
        $date_formate = date_format($date,"Y-m-d H:i:s");

        $db = Database::getConnexion();
        $sql = "UPDATE tache SET Nom_tach ='" . $nom . "',
                            DateLim_tach ='" . $date_formate . "',
                            Notes_tach ='" . $notes . "',
                            Lien_tach ='" . $lien . "' WHERE
                            Id_tach ='" . $idTask . "';";
        $db->query($sql);
    }

    public static function addTask($nom, $date, $notes, $lien, $idList)
    {
        $db = Database::getConnexion();
        $sql = "INSERT INTO tache(Nom_tach,DateLim_tach,Arch_tach,Notes_tach,Lien_tach,Id_list) VALUES ('" .$nom . "',
                                                                                                   '" . $date . "',
                                                                                                   0,
                                                                                                   '" . $notes . "',
                                                                                                   '" . $lien . "',
                                                                                                   '" . $idList . "');";
        $db->query($sql)->fetch();
    }

    public static function getListName($idList){
        $db = Database::getConnexion();
        $sql = "SELECT Nom_list FROM liste WHERE Id_list ='". $idList . "';";
        $liste = $db->query($sql)->fetch();
        return $liste['Nom_list'];
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