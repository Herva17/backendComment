<?php
require_once "./config.php"; 

class likes
{
    public $response = array();

    // 1. Méthode pour ajouter un like
    public static function ajouter($video_id, $user_id)
    {
        $data = get_connection();

        // Vérifier si l'utilisateur a déjà liké la vidéo
        $exists = $data->query("SELECT * FROM likes WHERE video_id = '$video_id' AND user_id = '$user_id'")->fetch();
        if ($exists) {
            return ["message" => "Vous avez déjà liké cette vidéo."];
        }

        // Ajouter le like
        if ($data->query("INSERT INTO likes(video_id, user_id) VALUES('$video_id', '$user_id')")) {
            return ["message" => "Like ajouté avec succès."];
        } else {
            return ["message" => "Échec de l'ajout du like."];
        }
    }

    // 2. Méthode pour supprimer un like
    public static function supprimer($video_id, $user_id)
    {
        $data = get_connection();

        // Vérifier si l'utilisateur a liké la vidéo
        $exists = $data->query("SELECT * FROM likes WHERE video_id = '$video_id' AND user_id = '$user_id'")->fetch();
        if (!$exists) {
            return ["message" => "Vous n'avez pas liké cette vidéo."];
        }

        // Supprimer le like
        if ($data->query("DELETE FROM likes WHERE video_id = '$video_id' AND user_id = '$user_id'")) {
            return ["message" => "Like supprimé avec succès."];
        } else {
            return ["message" => "Échec de la suppression du like."];
        }
    }

    // 3. Méthode pour vérifier si un utilisateur a liké une vidéo
    public static function verifier($video_id, $user_id)
    {
        $data = get_connection();
        $exists = $data->query("SELECT * FROM likes WHERE video_id = '$video_id' AND user_id = '$user_id'")->fetch();

        if ($exists) {
            return ["liked" => true, "message" => "L'utilisateur a liké cette vidéo."];
        } else {
            return ["liked" => false, "message" => "L'utilisateur n'a pas liké cette vidéo."];
        }
    }

    // 4. Méthode pour compter les likes d'une vidéo
    public static function compter($video_id)
    {
        $data = get_connection();
        $result = $data->query("SELECT COUNT(*) as total FROM likes WHERE video_id ='$video_id'")->fetch();

        if ($result) {
            return ["total" => $result['total']];
        } else {
            return ["message" => "Erreur lors du comptage des likes."];
        }
    }

    // 5. Méthode pour récupérer tous les likes d'un utilisateur
    public static function likes_par_utilisateur($user_id)
    {
        $data = get_connection();
        $donnees = $data->query("SELECT * FROM likes WHERE user_id = '$user_id'")->fetchAll();

        if (count($donnees) > 0) {
            return $donnees;
        } else {
            return ["message" => "Cet utilisateur n'a liké aucune vidéo."];
        }
    }
}
?>
