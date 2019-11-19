<?php


class UserModel extends Model {

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

    public function updateUserInfo($user, $mail, $id){
        $db = Database::getConnexion();
    // Requête pour mettre à jour les informations sur l’utilisateur
        $sql = "UPDATE utilisateur SET Username ='". $user ."',
                                Mail_user ='". $mail ."' WHERE
                                Id_user ='". $id ."' ;";
        $db->query($sql)->fetch();
    }

    public function checkUpdate($user){
        $db = Database::getConnexion();
        $sql = "SELECT * FROM utilisateur WHERE Username='". $user ."';";
        $ligne = $db->query($sql)->fetch();
        return $ligne;
    }

    public function checkUsernameTaken(){
        $db = Database::getConnexion();
        $sql = "SELECT Username FROM utilisateur;";
        $ligne = $db->query($sql)->fetch();
        //Il faudrait me dire quoi mettre, je sais pas ce qui conviendrait comme erreur
        if($ligne != ""){
            return "Le nom d'utilisateur est pris";
        }
    }

    public function createNewUser($user, $pwd, $mail){
        $db = Database::getConnexion();
        $sql = "INSERT INTO utilisateur(Username,Pwd_user,Mail_user) VALUES 
        ('" . $user . "','" . $pwd . "','" . $mail . "')";
        $db->query($sql)->fetch();
    }

    public function checkAccountCreation($user, $pwd){
        $db = Database::getConnexion();
        $sql = "SELECT Username,Pwd_user FROM utilisateur WHERE Username='" . $user . "' 
        AND Pwd_user ='" . $pwd . "';";
        $db->query($sql)->fetch();
        //Il faudrait me dire quoi mettre, je sais pas ce qui conviendrait comme erreur
    }

    public function getMail(){
        $db = Database::getConnexion();
        $ligne = $db->query("SELECT Mail_user FROM utilisateur WHERE Username ='" . $_SESSION['user'] . "'")->fetch();
        return $ligne;
    }

    public function getUsersToAddToAList($id){
        $db = Database::getConnexion();
        $sql = "SELECT t1.Id_user,t1.Username FROM utilisateur as t1 LEFT JOIN 
        (SELECT Id_user,Username FROM utilisateur NATURAL JOIN droit NATURAL JOIN liste 
        WHERE Id_list =". $id .") as t2 ON t1.Id_user = t2.Id_user WHERE t2.Id_user IS NULL;";
        $ligne = $db->query($sql)->fetch();
        return $ligne;
    }

}
