<?php


class UserModel extends Model {

    // Tester la connection
    public static function getUserConnexion() {
        if(isset($_POST['user']) && isset($_POST['pwd'])) {

            $db = Database::getConnexion();

            $sql = "SELECT Username,Pwd_user FROM utilisateur WHERE Username='". $_POST["user"] . "' AND Pwd_user ='" . $_POST["pwd"] . "';";
            echo ($sql);

            $request = $db->query($sql)->fetch();

            $_SESSION["error"] = "";
            $_SESSION['user'] = $request['Username'];

            return ($request);
        }
    }

    // Obtenir l'Id_user en fonction du nom de l'utilisateur connecté
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

        // Transforme la requête en tableau
        $array = array();
        foreach($request as $ligne) {
            $liste = array(
                'Id_list' => $ligne['Id_list'],
                'Nom_list' => $ligne['Nom_list'],
                'Droit_list' => $ligne['Droit_list']);
            $array[] = $liste;
        }
        return $array;
    }

    // Mettre à jour les informations de l'utilisateur
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

    // Check si la mise à jour du pseudo s'est bien effectué
    public static function checkUpdate($user,$mail){
        $db = Database::getConnexion();

        $sql = "SELECT Username,Mail_user FROM utilisateur WHERE Username='". $user ."' AND Mail_user = '". $mail . "';";

        $ligne = $db->query($sql)->fetch();
        return $ligne;
    }

    // Regarde si le pseudo n'as pas déjà été pris
    public static function checkUsernameTaken($username){
        $db = Database::getConnexion();

        $sql = "SELECT Username FROM utilisateur WHERE Username='". $username ."';";

        $ligne = $db->query($sql)->fetch();

        return($ligne['Username']);
    }

    // Permet de créer un nouvel utilisateur
    public static function createNewUser($user, $pwd, $mail){
        $db = Database::getConnexion();

        $sql = "INSERT INTO utilisateur(Username,Pwd_user,Mail_user) VALUES 
        ('" . $user . "','" . $pwd . "','" . $mail . "')";

        $db->query($sql);

        if(self::checkAccountCreation($user,$pwd)) { // Si la création s'est bien passé
            $_SESSION['error'] = "";
            $_SESSION['user'] = $user;
            return true;
        } else {
            $_SESSION['error'] = "Erreur lors de la création du compte";
            return false;
        }
    }

    // Regarde si le compte s'est bien créé
    public static function checkAccountCreation($user, $pwd){
        $db = Database::getConnexion();

        $sql = "SELECT Username,Pwd_user FROM utilisateur WHERE Username='" . $user . "' 
        AND Pwd_user ='" . $pwd . "';";

        $request = $db->query($sql)->fetch();

        return($request['Username']);
    }

    // Obtenir le mail de l'utilisateur connecté
    public static function getMail(){
        $db = Database::getConnexion();

        $ligne = $db->query("SELECT Mail_user FROM utilisateur WHERE Username='" . $_SESSION['user'] . "'")->fetch();

        return $ligne['Mail_user'];
    }
}
