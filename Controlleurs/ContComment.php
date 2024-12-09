<?php
require_once "Models/ClassComments.php";

// Tableau pour stocker les réponses
$retour = array();

// 1. Fonction pour ajouter un like
function ajouter_comments()
{
    $content = isset($_POST["content"]) ? $_POST["content"] = htmlspecialchars($_POST["content"]) : $_POST["content"] = null;
    $video_id = isset($_POST["video_id"]) ? $_POST["video_id"] : null;
    $user_id = isset($_POST["user_id"]) ? $_POST["user_id"] : null;
  
        return comments::enregistrer($content,$video_id, $user_id);
}

// // 2. Fonction pour supprimer un like
// function supprimer_like()
// {
//     $video_id = isset($_POST["video_id"]) ? $_POST["video_id"] : null;
//     $user_id = isset($_POST["user_id"]) ? $_POST["user_id"] : null;

//     if ($video_id && $user_id) {
//         return likes::supprimer($video_id, $user_id);
//     } else {
//         return ["message" => "Les paramètres vidéo et utilisateur sont nécessaires."];
//     }
// }

// 3. Fonction pour vérifier si un utilisateur a liké une vidéo
function select_comments()
{
        return comments::select_all();
}

// 4. Fonction pour compter les likes d'une vidéo
function compter_comments()
{
    $video_id = isset($_POST["video_id"]) ? $_POST["video_id"] : null;
    return likes::compter($video_id);
}


// 5. Fonction pour récupérer tous les likes d'un utilisateur
// function likes_par_utilisateur()
// {
//     $user_id = isset($_POST["user_id"]) ? $_POST["user_id"] : null;

//     if ($user_id) {
//         return likes::likes_par_utilisateur($user_id);
//     } else {
//         return ["message" => "Le paramètre utilisateur est nécessaire."];
//     }
// }
?>
