<?php


class UserModel extends Model {

    // Tester la connection
    public static function getUserConnexion() {
        if(isset($_POST['user']) && isset($_POST['pwd'])) {
            var_dump($_POST['user']);
            var_dump($_POST['pwd']);

            $db = Database::getConnexion();

            $sql = "SELECT Username,Pwd_user FROM utilisateur WHERE Username='". $_POST["user"] . "' AND Pwd_user ='" . $_POST["pwd"] . "';";
            echo ($sql);

            $res = $db->query($sql)->fetch();

            return ($res);
        }
    }

    public static function getUserId(){
        $db = Database::getConnexion();
        $sql = "SELECT Id_user FROM utilisateur WHERE Username='" . $_SESSION["user"] ."';";
        $res = $db->query($sql)->fetch();
        return $res['Id_user'];
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

    // Obtenir la liste des listes de l'utilisateur
    public static function getListsToDisplay(){
        $db = Database::getConnexion();
        $sql = "SELECT liste.Id_list,liste.Nom_list,droit.Droit_list FROM utilisateur INNER JOIN droit ON 
        utilisateur.Id_user = droit.Id_user INNER JOIN liste ON droit.Id_list=liste.Id_list WHERE utilisateur.Id_user 
        IN (SELECT utilisateur.Id_user FROM utilisateur WHERE utilisateur.Username = '". $_SESSION["user"] ."');";;
        $request = $db->query($sql)->fetchAll();
        //var_dump($request);
        $array = array();
        foreach($request as $ligne) {
            $liste = array('Id_list' => $ligne['Id_list'],
                'Nom_list' => $ligne['Nom_list'],
                'Droit_list' => $ligne['Droit_list']);
            $array[] = $liste;
        }
        return $array;
    }

    // Faire avec l'adresse mail !!!!
    public static function updateUserInfo($user, $mail, $id){
        $db = Database::getConnexion();
        // Requête pour mettre à jour les informations sur l’utilisateur
        $sql = "UPDATE utilisateur SET Username ='". $user ."',
                                Mail_user ='". $mail ."' WHERE
                                Id_user ='". $id ."';";
        $db->query($sql);
        if (self::checkUpdate($user,$mail)) { // Si le nouveau pseudo et mail sont bien modifiés
            $_SESSION['user'] = $user;
            return true;
        }
        return false;
    }

    public static function checkUpdate($user,$mail){
        $db = Database::getConnexion();
        $sql = "SELECT Username,Mail_user FROM utilisateur WHERE Username='". $user ."' AND Mail_user = '". $mail . "';";
        $ligne = $db->query($sql)->fetch();
        return $ligne;
    }

    public static function checkUsernameTaken(){
        $db = Database::getConnexion();
        $sql = "SELECT Username FROM utilisateur;";
        $ligne = $db->query($sql)->fetch();
        //Il faudrait me dire quoi mettre, je sais pas ce qui conviendrait comme erreur
        if($ligne != ""){
            return "Le nom d'utilisateur est pris";
        }
    }

    public static function createNewUser($user, $pwd, $mail){
        $db = Database::getConnexion();
        $sql = "INSERT INTO utilisateur(Username,Pwd_user,Mail_user) VALUES 
        ('" . $user . "','" . $pwd . "','" . $mail . "')";
        $db->query($sql)->fetch();
    }

    public static function checkAccountCreation($user, $pwd){
        $db = Database::getConnexion();
        $sql = "SELECT Username,Pwd_user FROM utilisateur WHERE Username='" . $user . "' 
        AND Pwd_user ='" . $pwd . "';";
        $db->query($sql)->fetch();
        //Il faudrait me dire quoi mettre, je sais pas ce qui conviendrait comme erreur
    }

    public static function getMail(){
        $db = Database::getConnexion();
        $ligne = $db->query("SELECT Mail_user FROM utilisateur WHERE Username='" . $_SESSION['user'] . "'")->fetch();
        return $ligne['Mail_user'];
    }

    public static function getUsersToAddToAList($id){
        $db = Database::getConnexion();
        $sql = "SELECT t1.Id_user,t1.Username FROM utilisateur as t1 LEFT JOIN 
        (SELECT Id_user,Username FROM utilisateur NATURAL JOIN droit NATURAL JOIN liste 
        WHERE Id_list =". $id .") as t2 ON t1.Id_user = t2.Id_user WHERE t2.Id_user IS NULL;";
        $ligne = $db->query($sql)->fetch();
        return $ligne;
    }

}
