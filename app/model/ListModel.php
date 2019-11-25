<?php


class ListModel extends Model
{

    // Obtenir la liste des tâches
    public static function displayTask($id)
    {
        $db = Database::getConnexion();

        $sql = "SELECT Id_tach,Nom_tach,DateLim_tach FROM tache WHERE Id_list =" . $id . " AND tache.Arch_tach = 0";

        $request = $db->query($sql)->fetchAll();

        // Transforme la requête en tableau
        $array = array();
        foreach($request as $ligne) {
            $liste = array(
                'Id_task' => $ligne['Id_tach'],
                'taskName' => $ligne['Nom_tach'],
                'taskDate' => $ligne['DateLim_tach']);
            $array[] = $liste;
        }

        return $array;
    }

    // Obtenir la liste des tâches archivés
    public static function displayTaskArchived($idList){
        $db = Database::getConnexion();

        $sql = "SELECT Id_tach,Nom_tach FROM tache WHERE Id_list ='". $idList . "' AND tache.Arch_tach = 1;";

        $request = $db->query($sql)->fetchAll();

        // Transforme la requête en tableau
        $array = array();
        foreach($request as $ligne) {
            $liste = array(
                'Id_task' => $ligne['Id_tach'],
                'taskName' => $ligne['Nom_tach']
            );
            $array[] = $liste;
        }

        return $array;
    }

    // Obtenir toutes les infos d'une tâche
    public static function getTask($idTask)
    {
        $db = Database::getConnexion();

        $sql = "SELECT * FROM tache WHERE id_tach ='" . $idTask . "';";

        $request = $db->query($sql)->fetchAll();

        // Transforme la requête en tableau
        $array = array();
        foreach($request as $ligne) {
            $date = date_create($ligne['DateLim_tach']);
            $date_formate = date_format($date,"Y-m-d\Th:i:s");

            $liste = array(
                'Id_task' => $ligne['Id_tach'],
                'taskName' => $ligne['Nom_tach'],
                'taskDate' => $date_formate,
                'taskNote' => $ligne['Notes_tach'],
                'taskLink' => $ligne['Lien_tach']
            );
            $array[] = $liste;
        }
        return $array;
    }

    // Ajouter une liste
    public static function addList($name){
        $db = Database::getConnexion();

        $sql = "INSERT INTO liste(Nom_list,Date_list) VALUES ('" . $name ."', CURRENT_TIMESTAMP);";

        $db->query($sql)->fetch();
    }

    // Ajoute un droit à la liste que l'utilisateur à utilisé
    public static function addRightOwner($idUser, $idList)
    {
        $db = Database::getConnexion();

        $sql = "INSERT INTO droit VALUES ('". $idList ."','". $idUser ."','admin');";

        $db->query($sql);
        return(self::getRight($idList));
    }

    // Regarde le droit de l'utilisateur sur la liste
    public static function getRight($idList)
    {
        $db = Database::getConnexion();

        $sql = "SELECT droit.Droit_list as listRight FROM utilisateur NATURAL JOIN droit NATURAL JOIN liste 
        WHERE utilisateur.Username='" . $_SESSION['user'] . "'AND liste.Id_list='" . $idList . "';";

        $liste = $db->query($sql)->fetch();

        return ($liste['listRight']);
    }

    // Obtenir l'id de la liste en donnant son nom
    public static function getListId($name){
        $db = Database::getConnexion();

        $sql = "SELECT Id_list FROM liste WHERE Nom_list = '" . $name ."';";

        $ligne = $db->query($sql)->fetch();

        return $ligne ['Id_list'];
    }

    // Obtenir le nom de la liste en donnant son id
    public static function getListName($idList){
        $db = Database::getConnexion();

        $sql = "SELECT Nom_list FROM liste WHERE Id_list ='". $idList . "';";

        $liste = $db->query($sql)->fetch();

        return $liste['Nom_list'];
    }

    // Obtenir le mail de l'utilisateur
    public static function getMail(){
        $db = Database::getConnexion();

        $ligne = $db->query("SELECT Mail_user FROM utilisateur WHERE Username='" . $_SESSION['user'] . "'")->fetch();

        return $ligne['Mail_user'];
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

}