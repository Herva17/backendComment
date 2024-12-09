<?php
require_once "./config.php"; 

class comments
{
    public $response = array();

    // Méthode pour enregistrer un commentaire
    public static function enregistrer($content, $video_id, $user_id)
    {
        $data = get_connection();
        if ($data->query("INSERT INTO comments(content, video_id, user_id) VALUES('$content','$video_id', '$user_id')")) {
            $response["message"] = "Commentaire ajouté avec succès.";
            $response["Dernier_Commentaire"] = self::afficher_dernier_enreg();
            return $response;
        } else {
            $response["message"] = "L'ajout du commentaire a échoué.";
            return $response;
        }
    }

    // Méthode pour afficher le dernier commentaire ajouté
    public static function afficher_dernier_enreg()
    {
        $data = get_connection();
        $donnees = $data->query("SELECT * FROM comments ORDER BY id DESC LIMIT 1")->fetchAll();

        if (count($donnees) > 0) {
            return $donnees;
        } else {
            return ["message" => "Aucun commentaire trouvé."];
        }
    }

    // Méthode pour récupérer tous les commentaires
    public static function select_all()
    {
        $data = get_connection();
        $donnees = $data->query("SELECT * FROM comments")->fetchAll();

        if (count($donnees) > 0) {
            return $donnees;
        } else {
            $response["message"] = "Aucun commentaire disponible.";
            return $response;
        }
    }

    // // Méthode pour récupérer les commentaires d'une vidéo
    // public static function select_by_video($video_id)
    // {
    //     $data = get_connection();
    //     $donnees = $data->query("SELECT * FROM comments WHERE video_id = '$video_id' ORDER BY created_at DESC")->fetchAll();

    //     if (count($donnees) > 0) {
    //         return $donnees;
    //     } else {
    //         $response["message"] = "Aucun commentaire trouvé pour cette vidéo.";
    //         return $response;
    //     }
    // }

    // Méthode pour supprimer un commentaire
    public static function supprimer($comment_id)
    {
        $data = get_connection();

        $exists = $data->query("SELECT * FROM comments WHERE id = '$comment_id'")->fetch();
        if (!$exists) {
            return ["message" => "Commentaire non trouvé."];
        }

        if ($data->query("DELETE FROM comments WHERE id = '$comment_id'")) {
            return ["message" => "Commentaire supprimé avec succès."];
        } else {
            return ["message" => "Échec de la suppression du commentaire."];
        }
    }

    // **Méthode pour compter les commentaires**
    public static function compter($video_id = null)
    {
        $data = get_connection();
        if ($video_id !== null) {
            // Compter les commentaires pour une vidéo spécifique
            $stmt = $data->prepare("SELECT COUNT(*) as total FROM comments WHERE video_id = :video_id");
            $stmt->execute([':video_id' => $video_id]);
        } else {
            // Compter tous les commentaires
            $stmt = $data->query("SELECT COUNT(*) as total FROM comments");
        }

        $result = $stmt->fetch();
        if ($result) {
            return ["total" => $result['total']];
        } else {
            return ["message" => "Erreur lors du comptage des commentaires."];
        }
    }
}
?>
