<?php
require_once "Models/ClassLike.php";

// Tableau pour stocker les réponses
$retour = array();

// 1. Fonction pour ajouter un like
function ajouter_like()
{
    $video_id = isset($_POST["video_id"]) ? $_POST["video_id"] : null;
    $user_id = isset($_POST["user_id"]) ? $_POST["user_id"] : null;

    if ($video_id && $user_id) {
        return likes::ajouter($video_id, $user_id);
    } else {
        return ["message" => "Les paramètres vidéo et utilisateur sont nécessaires."];
    }
}

// 2. Fonction pour supprimer un like
function supprimer_like()
{
    $video_id = isset($_POST["video_id"]) ? $_POST["video_id"] : null;
    $user_id = isset($_POST["user_id"]) ? $_POST["user_id"] : null;

    if ($video_id && $user_id) {
        return likes::supprimer($video_id, $user_id);
    } else {
        return ["message" => "Les paramètres vidéo et utilisateur sont nécessaires."];
    }
}

// 3. Fonction pour vérifier si un utilisateur a liké une vidéo
function verifier_like()
{
    $video_id = isset($_POST["video_id"]) ? $_POST["video_id"] : null;
    $user_id = isset($_POST["user_id"]) ? $_POST["user_id"] : null;

    if ($video_id && $user_id) {
        return likes::verifier($video_id, $user_id);
    } else {
        return ["message" => "Les paramètres vidéo et utilisateur sont nécessaires."];
    }
}

// 4. Fonction pour compter les likes d'une vidéo
function compter_likes()
{
    $video_id = isset($_POST["video_id"]) ? $_POST["video_id"] : null;
    // Appel à la méthode 'compter' de la classe 'likes'
    return likes::compter($video_id);
}


// 5. Fonction pour récupérer tous les likes d'un utilisateur
function likes_par_utilisateur()
{
    $user_id = isset($_POST["user_id"]) ? $_POST["user_id"] : null;

    if ($user_id) {
        return likes::likes_par_utilisateur($user_id);
    } else {
        return ["message" => "Le paramètre utilisateur est nécessaire."];
    }
}
?>
