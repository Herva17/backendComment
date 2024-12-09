<?php
require_once "Models/ClassUser.php";
$retour = array();

// Ajouter un utilisateur
function ajouter_utilisateur()
{
    $nom = isset($_POST["username"]) ? $_POST["username"] = htmlspecialchars($_POST["username"]) : $_POST["username"] = null;
    $email = isset($_POST["email"]) ? $_POST["email"] = htmlspecialchars($_POST["email"]) : $_POST["email"] = null;
    $mot_de_passe = isset($_POST["password"]) ? $_POST["password"] = $_POST["password"] : $_POST["password"] = null;
    
    return Utilisateur::enregistrer($nom, $email, $mot_de_passe);
}

// Récupérer tous les utilisateurs
function get_tous_utilisateurs()
{
    return Utilisateur::select_all();
}

// Récupérer un utilisateur par son ID


// Vérifier si un utilisateur existe
function verifier_utilisateur()
{
    $email = isset($_GET["email"]) ? htmlspecialchars(trim($_GET["email"])) : null;
    $password = isset($_GET["password"]) ? htmlspecialchars(trim($_GET["password"])) : null;
    return Utilisateur::connecter($email,$password);
}

?>
