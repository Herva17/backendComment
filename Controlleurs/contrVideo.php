<?php
require_once "Models/classeVideo.php";
$retour = array();

// Ajouter une vidéo
function ajouter_video()
{
    $title = isset($_POST["title"]) ? htmlspecialchars(trim($_POST["title"])) : null;
    $description = isset($_POST["description"]) ? htmlspecialchars(trim($_POST["description"])) : null;
    $url = isset($_POST["url"]) ? htmlspecialchars(trim($_POST["url"])) : null;
    $user_id = isset($_POST["user_id"]) ? (int)$_POST["user_id"] : null;

    return Video::enregistrerVideo($title, $description, $url, $user_id);
}

// Récupérer toutes les vidéos
function get_all_videos()
{
    return Video::selectVideo();
}
?>
