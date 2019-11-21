<?php


class ListModel
{

    public static function getArchivedLists($id){
        $db = Database::getConnexion();
        $sql = "SELECT Id_tach,Nom_tach FROM tache WHERE Id_list ='". $id . "' AND tache.Arch_tach = 1;";
        $liste = $db->query($sql)->fetch();
        return $liste;
    }

    public static function getListName($id){
        $db = Database::getConnexion();
        $sql = "SELECT Nom_list FROM liste WHERE Id_list ='". $id . "';";
        $liste = $db->query($sql)->fetch();
        return $liste;
    }

    public static function addList($name){
        $db = Database::getConnexion();
        $sql = "INSERT INTO liste(Nom_list,Date_list) VALUES ('" . $name ."', CURRENT_TIMESTAMP);";
        $db->query($sql)->fetch();
    }

    public static function addRightOwner($idUser, $idList)
    {
        $db = Database::getConnexion();

        $sql = "INSERT INTO droit VALUES ('". $idUser."','". $idList ."','admin');";

        $db->query($sql);

        return(self::getDroits($idList));
    }

    public static function getDroits($idList)
    {
        $db = Database::getConnexion();
        $sql = "SELECT droit.Droit_list FROM utilisateur NATURAL JOIN droit NATURAL JOIN liste 
        WHERE utilisateur.Username = '" . $_SESSION['user'] . "' AND liste.Id_list =" . $idList . ";";
        $liste = $db->query($sql)->fetch();
        return ($liste['Droit_list']);
    }

    public static function getListId($name){
        $db = Database::getConnexion();

        $sql = "SELECT Id_list FROM liste WHERE Nom_list = '" . $name ."';";

        $ligne = $db->query($sql)->fetch();

        return $ligne ['Id_list'];
    }

}