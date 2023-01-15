<?php

namespace App\Controller;

use App\Document\User;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(DocumentManager $dm): Response
    {
        $cursor = $dm->getDocumentCollection(User::class)->find();
        return  $this->json([
            'message' => "glodi",
        ]);
    }
    #[Route('/user/create', name: 'create_user', methods: ['POST'])]
    public function create(Request $req, DocumentManager $dm, UserPasswordHasherInterface $passwordHasher): Response
    {
        $data = json_decode($req->getContent());
        $user = new User();
        $hashedPassword = $passwordHasher->hashPassword($user, $data->password);
        $user->setNom($data->noms);
        $user->setGenre($data->genre);
        $user->setDnaiss($data->datenaiss);
        $user->setTel($data->tel);
        $user->setPassword($hashedPassword);
        $dm->persist($user);
        $dm->flush();
        return  $this->json([
            'status' => true,
            'message' => $user,
        ]);
    }

    #[Route('/commander/{idu}', name: 'commander', methods: ['POST'])]
    public function commander(Request $req, DocumentManager $dm, $idu): Response
    {
        $data = json_decode($req->getContent());
        $user = $dm->getRepository(User::class)->find($idu);
        $datas = [["commande" =>$data, "etat" => 0]];

        $com = $user->getCommandes();
        $dd = [];
        if($com){
            foreach ($com as $c){
                array_push($dd, $c);
            }
            array_push($dd, ["commande" =>$data, "etat" => 0]);
            $user->setCommandes($dd);
        }
        else{
            $user->setCommandes($datas);
        }



        $dm->flush();
        return  $this->json([
            'status' => true,
            "message" => $user,
            "data" => $datas,
            "com" => $com[0],
            "dd" => $dd
        ]);
    }

    #[Route('/user/login', name: 'login', methods: ['POST'])]
    public function login(Request $req, DocumentManager $dm, UserPasswordHasherInterface $passwordHasher) : Response
    {
        $data = json_decode($req->getContent()); // get json data from client form in vuejs controller
        $repo = $dm->getRepository(User::class); // get user repository
        $user = $repo->findOneBy(["tel" => $data->tel]); // find user by phone number
        if($user != null && $passwordHasher->isPasswordValid($user, $data->password)) //checking valid password
        {
            //Cheking is good and return user data
            //user connected succefuly
            return  $this->json([
                'status' => true,
                'message' => $user,
            ]);
        }
        else
        {
            //cheking failuer(echeck quoi), user don't connected
            return  $this->json([
                'status' => false,
                'message' => "Tel ou mot de passe incorrect!"
            ]);
        }

    }
}
