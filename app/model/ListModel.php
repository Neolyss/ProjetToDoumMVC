<?php


class ListModel
{

    public function getArchivedLists($id){
        $db = Database::getConnexion();
        $sql = "SELECT Id_tach,Nom_tach FROM tache WHERE Id_list ='". $id . "' AND tache.Arch_tach = 1;";
        $liste = $db->query($sql)->fetch();
        return $liste;
    }

    public function getListName($id){
        $db = Database::getConnexion();
        $sql = "SELECT Nom_list FROM liste WHERE Id_list ='". $id . "';";
        $liste = $db->query($sql)->fetch();
        return $liste;
    }

    public function getListsToDisplay(){
        $db = Database::getConnexion();
        $sql = "SELECT liste.Id_list,liste.Nom_list,droit.Droit_list FROM utilisateur INNER JOIN droit ON 
        utilisateur.Id_user = droit.Id_user INNER JOIN liste ON droit.Id_list=liste.Id_list WHERE utilisateur.Id_user 
        IN (SELECT utilisateur.Id_user FROM utilisateur WHERE utilisateur.Username = '". $_SESSION["user"] ."');";;
        $liste = $db->query($sql)->fetch();
        return $liste;
    }

    public function addList($name){
        $db = Database::getConnexion();
        $sql = "INSERT INTO liste(Nom_list,Date_list) VALUES ('" . $name ."', CURRENT_TIMESTAMP);";
        $db->query($sql)->fetch();
    }

    public function getListId($name){
        $db = Database::getConnexion();
        $sql = "SELECT Id_list FROM liste WHERE Nom_list = '" . $name ."';";
        $db->query($sql)->fetch();
    }

    public function getListOwnerId(){
        $db = Database::getConnexion();
        $sql = "SELECT Id_user FROM utilisateur WHERE Username = '" . $_SESSION["user"] ."';";
        $db->query($sql)->fetch();
    }

}