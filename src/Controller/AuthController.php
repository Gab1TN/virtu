<?php

namespace App\Controller;

use App\Model\User;
use App\Service\SessionManager;
use Twig\Environment;
use App\Routing\Attribute\Route;

class AuthController
{
    private $userModel;
    private $sessionManager;
    private $twig;

    public function __construct(User $userModel, SessionManager $sessionManager, Environment $twig)
    {
        $this->userModel = $userModel;
        $this->sessionManager = $sessionManager;
        $this->twig = $twig;
    }

    #[Route('/login', methods: ['GET'])]
    public function showLoginForm(): string
    {
        return $this->twig->render('login.html.twig');
    }

    #[Route('/login', methods: ['POST'])]
    public function handleLogin(): void
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = $this->userModel->getUserByUsername($username);

        if ($user && $this->userModel->validatePassword($user, $password)) {
            $this->sessionManager->setUser($username);
            $this->sessionManager->setRole($user->getRole()->getName());
            header('Location: /bienvenue');
            exit;
        } else {
            echo $this->twig->render('login.html.twig', ['error' => 'Identifiants incorrects']);
        }
    }
}
