<?php
header('Content-Type: Application/json;charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Method: *');
header('Access-Control-Allow-Headers: *');
$user = md5('hervaTech');
$mdp = md5('mdp');
if ((isset($_GET['user']) && $_GET['user'] == 'herva' || isset($_GET['user']) && $_GET['user'] == $user)
    && (isset($_GET['mdp']) && $_GET['mdp'] == "mdp" || isset($_GET['mdp']) && $_GET['mdp'] == $mdp)
) {
       require_once("routes/like.php");
       require_once("routes/Utilisateur.php");
       require_once("routes/video.php");
       require_once("routes/favs.php");
       require_once("routes/comments.php");
      
    echo json_encode($retour);
    exit;
} else{
    $retour["message"] = "accès réfusé"; 
}