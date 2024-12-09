<?php
header('Content-Type: Application/json');
require("./Controlleurs/contrVideo.php");

$data = array();
$url = explode('/', $_SERVER['REQUEST_URI']);
$url_path1 = $url[2];
$url_path2 = $url[3];

if ($url_path1 == "video") {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Ajouter une vidéo
        if ($url_path2 == "ajouter") {
            $data["me"] = ajouter_video();
            echo json_encode($data);
        }
     
    } elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
        // Récupérer toutes les vidéos
        if ($url_path2 == "toutes") {
            $data["me"] = get_all_videos();
            echo json_encode($data);
        }
    }
}
?>
