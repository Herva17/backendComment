<?php
// Assurez-vous que la connexion à la base de données est incluse correctement dans Config.php
require_once "./config.php"; 

class Favorite
{
    // Tableau pour stocker la réponse (message, erreurs, etc.)
    public $response = array();
    public static function ajouterFavorite($video_id, $user_id)
    {
        $data = get_connection();

        // Vérifier si l'utilisateur a déjà liké la vidéo
        $exists = $data->query("SELECT * FROM favorites WHERE user_id='$user_id' AND video_id = '$video_id'")->fetch();
        if ($exists) {
            return ["message" => "Vous avez déjà favs cette vidéo."];
        }

        // Ajouter le like
        if ($data->query("INSERT INTO favorites(user_id,video_id) VALUES('$user_id','$video_id')")) {
            return ["message" => "Like ajouté avec succès."];
        } else {
            return ["message" => "Échec de l'ajout du like."];
        }
    }

    public static function afficherFavorites($userId)
    {
        $data = get_connection();
        $result = $data->query("SELECT v.* FROM videos v
                                JOIN favorites f ON f.video_id = v.id
                                WHERE f.user_id = '$userId'");

        $favorites = $result->fetchAll();
        if ($favorites) {
            return $favorites;
        } else {
            return ["message" => "Aucune vidéo favorite trouvée"];
        }
    }

    public static function compter($video_id)
    {
        $data = get_connection();
        $result = $data->query("SELECT COUNT(*) as total FROM favorites WHERE video_id ='$video_id'")->fetch();

        if ($result) {
            return ["total" => $result['total']];
        } else {
            return ["message" => "Erreur lors du comptage des favs."];
        }
    }
    public static function supprimerFavorite($userId, $videoId)
    {
        $data = get_connection();
        $result = $data->query("DELETE FROM favorites WHERE user_id = '$userId' AND video_id = '$videoId'");

        if ($result) {
            return ["message" => "Vidéo supprimée des favoris avec succès"];
        } else {
            return ["message" => "Erreur lors de la suppression de la vidéo des favoris"];
        }
    }
    public static function compterFavorites($userId)
    {
        $data = get_connection();
        $result = $data->query("SELECT COUNT(*) as total FROM favorites WHERE user_id = '$userId'")->fetch();

        if ($result) {
            return ["total" => $result['total']];
        } else {
            return ["message" => "Erreur lors du comptage des vidéos favorites."];
        }
    }
}
?>
