<?php
require_once "Models/classFavorite.php";

// Tableau pour stocker les réponses
$retour = array();

// 1. Fonction pour ajouter un like
function ajouterFavorite()
{
    $user_id = isset($_POST["user_id"]) ? $_POST["user_id"] : null;
    $video_id = isset($_POST["video_id"]) ? $_POST["video_id"] : null;

    if ($video_id && $user_id) {
        return Favorite::ajouterFavorite( $user_id,$video_id);
    } else {
        return ["message" => "Les paramètres vidéo et utilisateur sont nécessaires."];
    }
}

// 2. Fonction pour supprimer un like
function SuppFav()
{
    $video_id = isset($_POST["video_id"]) ? $_POST["video_id"] : null;
    $user_id = isset($_POST["user_id"]) ? $_POST["user_id"] : null;

    if ($video_id && $user_id) {
        return Favorite::supprimerFavorite($video_id, $user_id);
    } else {
        return ["message" => "Les paramètres vidéo et utilisateur sont nécessaires."];
    }
}
// 4. Fonction pour compter les likes d'une vidéo
function compter_favs()
{
    $video_id = isset($_POST["video_id"]) ? $_POST["video_id"] : null;
    // Appel à la méthode 'compter' de la classe 'likes'
    return Favorite::compter($video_id);
}


// 5. Fonction pour récupérer tous les likes d'un utilisateur
function favs_par_utilisateur()
{
    $user_id = isset($_POST["user_id"]) ? $_POST["user_id"] : null;

    if ($user_id) {
        return likes::likes_par_utilisateur($user_id);
    } else {
        return ["message" => "Le paramètre utilisateur est nécessaire."];
    }
}
?>
