<?php


class UserModel extends Model {

    public static function getUserConnexion() {
        $db = Database::getConnexion();

        $sql = "SELECT Username,Pwd_user FROM utilisateur";
        //$sql = "SELECT Username,Pwd_user FROM utilisateur WHERE Username='". $_POST["user"] . "' AND Pwd_user ='" . $_POST["pwd"] . "';";

        $res = $db->query($sql)->fetchAll();

        var_dump($res);
    }
}
