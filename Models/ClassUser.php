<?php
require_once("./config.php"); // Utiliser require_once pour éviter les inclusions multiples

class utilisateur
{
    public $response = array();

    // 1. Méthode pour enregistrer un utilisateur
    public static function enregistrer($username,$email,$password)
    {
        $data = get_connection();

        // Sécuriser les données : Hachage du mot de passe avant l'enregistrement
        // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Requête pour insérer un utilisateur dans la base de données
        $query = "INSERT INTO users (username,email,password) VALUES ('$username', '$email','$password')";

        if ($data->query($query)) {
            $response["message"] = "Enregistrement réussi";
            $response["Dernier_Enregistrement"] = self::afficher_dernier_enreg();
            return $response;
        } else {
            $response["message"] = "Enregistrement échoué";
            return $response;
        }
    }

    // 2. Méthode pour afficher le dernier enregistrement
    public static function afficher_dernier_enreg()
    {
        $data = get_connection();
        $donnees = $data->query("SELECT * FROM users ORDER BY id DESC LIMIT 1")->fetchAll();

        if (count($donnees) > 0) {
            return $donnees;
        }
    }

    // 3. Méthode pour récupérer tous les utilisateurs
    public static function select_all()
    {
        $data = get_connection();
        $donnees = $data->query("SELECT * FROM users")->fetchAll();

        if (count($donnees) > 0) {
            return $donnees;
        } else {
            $response["message"] = "Aucune donnée disponible";
            return $response;
        }
    }

    // 4. Méthode pour se connecter (vérifier email et mot de passe)
    public static function connecter($email, $password)
    {
        $data = get_connection();

        // Vérifier si l'email existe dans la base de données
        $query = "SELECT * FROM users WHERE email = '$email'";
        $user = $data->query($query)->fetch();

        if ($user) {
            // Vérifier le mot de passe
             if (password_verify($password, $user['password'])) {
                $response["message"] ="Connexion reussie";
                return $response;
            } else {
                $response["message"] ="L'utilisateur ou le mot de passe non trouvé";
                return $response;
            }
        } else {
             return ["message" => "Utilisateur non trouvé"];
        }
    }
}
?>
