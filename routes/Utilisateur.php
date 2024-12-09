<?php
header('Content-Type: Application/json');
require("./Controlleurs/controlleurUser.php");

$data = array();
$url = explode('/', $_SERVER['REQUEST_URI']);
$url_path1 = $url[2];
$url_path2 = $url[3];

if ($url_path1 == "utilisateur") {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Ajouter un utilisateur
        if ($url_path2 == "ajouter") {
            $data["data"] = ajouter_utilisateur();
            echo json_encode($data);
        }
    } elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
        // Récupérer tous les utilisateurs
        if ($url_path2 == "tous") {
            $data["data"] = get_tous_utilisateurs();
            echo json_encode($data);
        }
        // Vérifier un utilisateur par email
        elseif($_SERVER["REQUEST_METHOD"] == "POST"){
         if ($url_path2 == "verifier") {
            $data["data"] = verifier_utilisateur();
            echo json_encode($data);
        }
    }
}
}
?>
