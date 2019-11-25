<?php

class TaskModel extends Model
{

    public static function updateTask($nom, $date, $notes, $lien, $idTask)
    {
        // Conversion de la date
        $date = date_create($date);
        $date_formate = date_format($date,"Y-m-d H:i:s");

        $db = Database::getConnexion();

        $sql = "UPDATE tache SET Nom_tach ='" . $nom . "',
                            DateLim_tach ='" . $date_formate . "',
                            Notes_tach ='" . $notes . "',
                            Lien_tach ='" . $lien . "' WHERE
                            Id_tach ='" . $idTask . "';";
        $db->query($sql);

        return(self::checkUpdateTask($nom, $date_formate, $notes, $lien));
    }

    // Check si la mise à jour de la tâche s'est bien effectué
    public static function checkUpdateTask($nom, $date, $notes, $lien){
        $db = Database::getConnexion();

        $sql = "SELECT * FROM tache WHERE 
            Nom_tach='". $nom  ."' AND
            Notes_tach = '". $notes . "' AND
            DateLim_tach = '". $date . "' AND
            Lien_tach ='" . $lien . "';
            ";

        $request = $db->query($sql)->fetch();

        return $request;
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

        return(self::checkArchive($idTask));
    }

    public static function checkArchive($idTask) {
        $db = Database::getConnexion();

        $sql = "SELECT Arch_Tach FROM tache WHERE Id_tach =". $idTask ." AND Arch_Tach = 1;";

        $request = $db->query($sql);

        return $request;
    }

    public static function desarchiveTask($idTask)
    {
        $db = Database::getConnexion();

        $sql = "UPDATE tache SET Arch_Tach = 0 WHERE Id_tach = '" . $idTask . "';";

        $db->query($sql)->fetch();

        return(self::checkDesarchive($idTask));
    }

    public static function checkDesarchive($idTask) {
        $db = Database::getConnexion();

        $sql = "SELECT Arch_Tach FROM tache WHERE Id_tach =". $idTask ." AND Arch_Tach = 0;";

        $request = $db->query($sql);

        return $request;
    }

    // Regarde si l'utilisateur a le droit de modification sur la liste
    public static function getRight($idList)
    {
        $db = Database::getConnexion();

        $sql = "SELECT droit.Droit_list as listRight FROM utilisateur NATURAL JOIN droit NATURAL JOIN liste 
        WHERE utilisateur.Username='" . $_SESSION['user'] . "'AND liste.Id_list='" . $idList . "' AND (droit.Droit_list = 'admin' OR droit.Droit_list='lectureEcriture');";

        $liste = $db->query($sql)->fetch();

        return ($liste['listRight']);
    }

}