<?php

namespace App\Service;

class SessionManager
{
    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start(); // Démarrer la session si elle n'est pas déjà démarrée
        }
    }

    public function setUser($userId)
    {
        $_SESSION['user_id'] = $userId; // Stocker l'ID de l'utilisateur dans la session
    }

    public function getUser()
    {
        return $_SESSION['user_id'] ?? null;
    }
 public function setUserName($userName)
    {
        $_SESSION['user_name'] = $userName;
    }

    public function getUserName()
    {
        return $_SESSION['user_name'] ?? null;
    }

    public function setRole($role)
    {
        $_SESSION['user_role'] = $role;
    }

    public function getRole()
    {
        return $_SESSION['user_role'] ?? null; 
    }

    public function hasRole($requiredRole)
    {
        $userRole = $this->getRole();
        return $userRole === $requiredRole;
    }
    public function isAuthenticated()
    {
        return isset($_SESSION['user_id']); 
    }

    public function logout()
    {
        session_unset(); // Effacer toutes les données de session
        session_destroy(); // Détruire la session
    }

}
