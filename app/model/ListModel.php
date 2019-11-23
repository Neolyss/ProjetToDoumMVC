<?php


class ListModel extends Model
{

    public static function getArchivedLists($idList){
        $db = Database::getConnexion();
        $sql = "SELECT Id_tach,Nom_tach FROM tache WHERE Id_list ='". $idList . "' AND tache.Arch_tach = 1;";
        $request = $db->query($sql)->fetchAll();
        //var_dump($request);
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

    public static function addList($name){
        $db = Database::getConnexion();
        $sql = "INSERT INTO liste(Nom_list,Date_list) VALUES ('" . $name ."', CURRENT_TIMESTAMP);";
        $db->query($sql)->fetch();
    }

    public static function addRightOwner($idUser, $idList)
    {
        $db = Database::getConnexion();

        $sql = "INSERT INTO droit VALUES ('". $idList ."','". $idUser ."','admin');";

        $db->query($sql);
        return(self::getRight($idList));
    }

    public static function getRight($idList)
    {
        $db = Database::getConnexion();
        $sql = "SELECT droit.Droit_list as listRight FROM utilisateur NATURAL JOIN droit NATURAL JOIN liste 
        WHERE utilisateur.Username='" . $_SESSION['user'] . "'AND liste.Id_list='" . $idList . "';";
        $liste = $db->query($sql)->fetch();
        return ($liste['listRight']);
    }

    public static function getListId($name){
        $db = Database::getConnexion();

        $sql = "SELECT Id_list FROM liste WHERE Nom_list = '" . $name ."';";

        $ligne = $db->query($sql)->fetch();

        return $ligne ['Id_list'];
    }

    public static function getListName($idList){
        $db = Database::getConnexion();
        $sql = "SELECT Nom_list FROM liste WHERE Id_list ='". $idList . "';";
        $liste = $db->query($sql)->fetch();
        return $liste['Nom_list'];
    }

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

    public static function getTask($idTask)
    {
        $db = Database::getConnexion();
        $sql = "SELECT * FROM tache WHERE id_tach ='" . $idTask . "';";
        $request = $db->query($sql)->fetchAll();
        //var_dump($request);
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

    public static function displayTask($id)
    {
        $db = Database::getConnexion();
        $sql = "SELECT Id_tach,Nom_tach,DateLim_tach FROM tache WHERE Id_list =" . $id . " AND tache.Arch_tach = 0";
        $request = $db->query($sql)->fetchAll();
        //var_dump($request);
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
}