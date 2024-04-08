<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = "";
        if($error != null){
            $filename = 'C:\Users\Guillerme\BTS IIA\Symfony\WorkTogether Document\auth.log';
            $date = new \DateTime('now');
            $lastUsername = $authenticationUtils->getLastUsername();
            $contenuDuFichier = $lastUsername.",".$date->format("Y-m-d_h:i:s").",false"."\r\n";
            file_put_contents($filename, $contenuDuFichier, FILE_APPEND);
            \Sentry\configureScope(function (\Sentry\State\Scope $scope,): void {
                $scope->setUser(['email' => $this->getUser()->getUserIdentifier()]);
            });
        }
        // last username entered by the user





        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        \Sentry\configureScope(function (\Sentry\State\Scope $scope): void {
            $scope->removeUser();
        });
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
