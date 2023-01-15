<?php

namespace App\Controller;

use App\Document\User;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class AuthentifController extends AbstractController
{
    #[Route('/authentif', name: 'app_authentif')]
    public function index(Request $req, DocumentManager $dm, UserPasswordHasherInterface $passwordHasher) : Response
    {
        if($req->isMethod('POST'))
        {
            $data = $req->request; // get json data from client form in vuejs controller
            $repo = $dm->getRepository(User::class); // get user repository
            $user = $repo->findOneBy(["tel" => $data->get('tel')]); // find user by phone number

            if($user != null && $passwordHasher->isPasswordValid($user, $data->get('password')) && $user->getRole() == 1) //checking valid password
            {
                //Cheking is good and return user data
                //user connected succefuly
                $req->getSession()->set('user', $user);
                return $this->redirectToRoute('app_admin');
            }
            else
            {
                //cheking failuer(echeck quoi), user don't connected
                $message = "Tel ou mot de passe incorrect!";
                if($user != null && $passwordHasher->isPasswordValid($user, $data->get('password')) && $user->getRole() != 1){
                    $message = "Vous n'êtes pas autorisé !";
                }

                return $this->render('authentif/index.html.twig', [
                    'status' => false,
                    'message' => $message
                ]);
            }
        }
        else
        {
            return $this->render('authentif/index.html.twig', [
                'controller_name' => 'AuthentifController',
            ]);
        }

    }
    #[Route('/authentif/create', name: 'app_authentif_create')]
    public function create(Request $req, DocumentManager $dm, UserPasswordHasherInterface $passwordHasher): Response
    {
        if($req->isMethod('POST')){
            $data = $req->request;
            /*return  $this->json([
                'status' => $data,
                'message' => "Tel ou mot de passe incorrect!"
            ]);*/
            $user = new User();
            $hashedPassword = $passwordHasher->hashPassword($user, $data->get("password"));
            $user->setNom($data->get("noms"));
            $user->setTel($data->get("tel"));
            $user->setRole(1);
            $user->setPassword($hashedPassword);
            $dm->persist($user);
            $dm->flush();
            $req->getSession()->set('user', $user);
            return $this->redirectToRoute('app_admin');
        }
        else{
            return $this->render('authentif/create.html.twig', [
                'controller_name' => 'AuthentifController',
            ]);
        }

    }

    #[Route('/deconnect', name: 'deconnect')]
    public function deconnect(Request $req): Response
    {
        $req->getSession()->remove('user');
        return $this->redirectToRoute('app_authentif');
    }
}
