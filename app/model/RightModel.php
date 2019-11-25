<?php


class RightModel extends Model
{
    // Regarde si l'utilisateur a le droit d'admin sur la liste
    public static function getRightAdmin($idList)
    {
        $db = Database::getConnexion();

        $sql = "SELECT droit.Droit_list FROM utilisateur NATURAL JOIN droit NATURAL JOIN liste 
        WHERE utilisateur.Username = '" . $_SESSION['user'] . "' AND liste.Id_list =" . $idList . " AND droit.Droit_list = 'admin';";

        $liste = $db->query($sql)->fetch();

        return $liste;
    }

    // Ajouter valeur de retour
    public static function addRightUser($idList,$idUser,$droit){
        // Ajoute les droits indiqués dans le formulaire avec la liste indiqué, l'identifiant de l'utilisateur et le nom du droit
        $db = Database::getConnexion();

        $sql = "INSERT INTO droit VALUES (
            '". $idList."',
            '". $idUser."',
            '". $droit ."')";

        $db->query($sql);
    }

    // Obtenir les utilisateur n'ayant pas les droits de la liste
    public static function getUsersToAddToAList($idList){
        $db = Database::getConnexion();

        $sql = "SELECT t1.Id_user,t1.Username FROM utilisateur as t1 LEFT JOIN 
        (SELECT Id_user,Username FROM utilisateur NATURAL JOIN droit NATURAL JOIN liste 
        WHERE Id_list =". $idList .") as t2 ON t1.Id_user = t2.Id_user WHERE t2.Id_user IS NULL;";

        $request = $db->query($sql)->fetchAll();

        // Transforme la requête en tableau
        $array = array();
        foreach($request as $ligne) {
            $liste = array(
                'Id_user' => $ligne['Id_user'],
                'Username' => $ligne['Username']
            );
            $array[] = $liste;
        }
        return $array;
    }

    // Obtenir le nombre de tâches en retard
    public static function getLateTasks()
    {
        $db = Database::getConnexion();

        $sql = "SELECT COUNT(tache.DateLim_tach) as nombreActivite FROM utilisateur INNER JOIN droit ON utilisateur.Id_user = droit.Id_user INNER JOIN liste ON droit.Id_list=liste.Id_list
        INNER JOIN tache ON liste.Id_list = tache.Id_list WHERE DATE(tache.DateLim_tach) < CURRENT_DATE AND tache.Arch_tach = 0 AND utilisateur.Id_user
        IN (SELECT utilisateur.Id_user FROM utilisateur WHERE utilisateur.Username = '" . $_SESSION['user'] . "');";

        $ligne = $db->query($sql)->fetch();

        return $ligne['nombreActivite'];
    }

    // Obtenir le nombre de tâches à faire aujourd'hui
    public static function getTodayTasks()
    {
        $db = Database::getConnexion();

        $sql = "SELECT COUNT(tache.DateLim_tach) as nombreActivite FROM utilisateur INNER JOIN droit ON utilisateur.Id_user = droit.Id_user INNER JOIN liste ON droit.Id_list=liste.Id_list
        INNER JOIN tache ON liste.Id_list = tache.Id_list WHERE DATE(tache.DateLim_tach) = CURRENT_DATE AND tache.Arch_tach = 0 AND utilisateur.Id_user
        IN (SELECT utilisateur.Id_user FROM utilisateur WHERE utilisateur.Username = '" . $_SESSION['user'] . "');";

        $ligne = $db->query($sql)->fetch();

        return $ligne['nombreActivite'];
    }

    // Obtenir le mail de l'utilisateur
    public static function getMail(){
        $db = Database::getConnexion();

        $ligne = $db->query("SELECT Mail_user FROM utilisateur WHERE Username='" . $_SESSION['user'] . "'")->fetch();

        return $ligne['Mail_user'];
    }

    // Obtenir le nom de la liste en donnant son id
    public static function getListName($idList){
        $db = Database::getConnexion();

        $sql = "SELECT Nom_list FROM liste WHERE Id_list ='". $idList . "';";

        $liste = $db->query($sql)->fetch();

        return $liste['Nom_list'];
    }
}