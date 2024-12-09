<?php
require_once ("./config.php"); 
class video
{
    public $response = array();
    public static function enregistrerVideo($title,$description,$url,$userId)
    {
        $data = get_connection();
        if ($data->query("INSERT INTO videos(title,description,url,user_id)values('$title','$description','$url','$userId')")) {
            $response["message"] = "Enregistrerment reussie";
            $response["Dernier_Enregistrement"] = self::afficher_dernier_enreg();
            return $response;
        } else {
            $response["Message"] = "Enregistrement echouée";
            return $response;
        }
    }

    public static function afficher_dernier_enreg()
    {
        $data = get_connection();
        $donnees = $data->query("SELECT * from videos ORDER by id DESC LIMIT 1")->fetchAll();
        if (count($donnees) > 0) {
            return $donnees;
        }
    }

    public static function selectVideo()
    {
        $data = get_connection();
        $donnees = $data->query("SELECT * FROM videos")->fetchAll();
        if (count($donnees) > 0) {
            return $donnees;
        } else {
            $response["Message"] = "Aucune video disponible";
            return $response;
        }
    }
}
