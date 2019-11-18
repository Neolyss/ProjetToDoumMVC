<?php


class DroitModel
{

    public function getDroits($id)
    {
        $db = Database::getConnexion();
        $sql = "SELECT droit.Droit_list FROM utilisateur NATURAL JOIN droit NATURAL JOIN liste 
        WHERE utilisateur.Username = '" . $_SESSION['user'] . "' AND liste.Id_list =" . $id . ";";
        $liste = $db->query($sql)->fetch();
        return $liste;
    }

    public function setAdmin($user, $id){
        $sql = "INSERT INTO droit VALUES ('". $id ."',
                                 '". $user ."',
                                 'admin')";
    }

    public function setDroits($user, $id, $typeDroit){
        $sql = "INSERT INTO droit VALUES ('". $id."',
                                 '". $user ."',
                                 '". $typeDroit ."')";
    }


}