<?php
header('Content-Type: Application/json');
require("./Controlleurs/ContComment.php");

$data = array();
$url = explode('/', $_SERVER['REQUEST_URI']);
$url_path1 = $url[2];
$url_path2 = $url[3];

if ($url_path1 == "comments") {
    // Vérifier la méthode HTTP pour savoir quelle action effectuer
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Ajouter un like
        if ($url_path2 == "ajouter") {
            $data["me"] = ajouter_comments();
            echo json_encode($data);
        }
        // Supprimer un like
        elseif ($url_path2 == "supprimer") {
            $data["me"] = SuppFav();
            echo json_encode($data);
        }
    } elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
        // Vérifier si on veut compter les likes ou vérifier un like
        if ($url_path2 == "compter") {
            $data["me"] = compter_comments();
            echo json_encode($data);
        }
        // Récupérer tous les likes d'un utilisateur
        elseif ($url_path2 == "tous") {
            $data["me"] = select_comments();
            echo json_encode($data);
        }
        // Vérifier si un utilisateur a liké une vidéo
        elseif ($url_path2 == "verifier") {
            $data["me"] = verifier_like();
            echo json_encode($data);
        }
    }
}
?>
