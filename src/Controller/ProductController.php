<?php

namespace App\Controller;

use App\Document\Categorie;
use App\Document\Product;
use App\Document\User;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]

    public function index(Request $request, DocumentManager $dm,): Response
    {
        $sesseion = $request->getSession();
        if($sesseion->get('user')){
            $user = $sesseion->get('user');
            $aggregation = $dm->createAggregationBuilder(Product::class);
            $products = $aggregation->lookup('categories')->localField('categorie')->foreignField('_id')->alias('catego')->getAggregation();
            return $this->render('product/index.html.twig', [
                'products' => $products,
                'user' => $user,
                'categories' => $dm->getRepository(Categorie::class)->findAll()
            ]);
        }
        else{
            return $this->redirectToRoute('app_authentif');
        }

    }

    #[Route('/product/list', name: 'product_list')]

    public function liste(Request $request, DocumentManager $dm,): Response
    {
        $aggregation = $dm->createAggregationBuilder(Product::class);
        $result = $aggregation->lookup('categories')->localField('categorie')->foreignField('_id')->alias('catego')->getAggregation();
        return $this->json(
            [
                'products' => $result
            ]
        );
    }

    #[Route('/product/create', name: 'product_create', methods: 'POST')]
    public function create(Request $req, DocumentManager $dm): Response
    {
        $data = $req->request;
        $product = new Product();
        $product->setNom($data->get("nom"));
        $product->setQte($data->get("qte"));
        $product->setPrix($data->get("prix"));
        $product->setCategorie($data->get("categorie"));
        $dm->persist($product);
        $dm->flush();
        /** @var UploadedFile $uploaadFile */
        $file = $req->files->get('image');
        $destination = $this->getParameter('kernel.project_dir').'/public/uploads/products';
        $file->move($destination, $product->getId().'.png');


        return $this->redirectToRoute('app_product');

    }

    #[Route('/product/update/{idp}', name: 'product_update')]
    public function update(Request $req, DocumentManager $dm, $idp): Response
    {
        $product = $dm->getRepository(Product::class)->find($idp);
        if($req->isMethod('POST')){
            $data = $req->request;
            $product->setNom($data->get("nom"));
            $product->setQte($data->get("qte"));
            $product->setPrix($data->get("prix"));
            if($data->get("categorie") != "Choisir la categorie du produit"){
                $product->setCategorie($data->get("categorie"));
            }
            $dm->flush();
            $sesseion = $req->getSession();
            $user = $sesseion->get('user');
            /** @var UploadedFile $uploaadFile */
            $file = $req->files->get('image');
            if($file){
                $destination = $this->getParameter('kernel.project_dir').'/public/uploads/products';
                $file->move($destination, $product->getId().'.png');
            }
            return $this->redirectToRoute('app_product');
        }
        else{
            $sesseion = $req->getSession();
            $user = $sesseion->get('user');
            return $this->render('product/edit.html.twig', [
                'pro' => $product,
                'user' => $user,
                'categories' => $dm->getRepository(Categorie::class)->findAll()
            ]);
        }
    }

    /* Commande */
    #[Route('/commande', name: 'commande_list')]

    public function listCommande(Request $request, DocumentManager $dm,): Response
    {
        $sesseion = $request->getSession();
        if($sesseion->get('user')){
            $user = $sesseion->get('user');
            $commande = $dm->getRepository(User::class)->findBy(["commandes"=> ['$ne'=> null]]);
            return $this->render('product/commandes.html.twig', [
                'commandes' => $commande,
                'user' => $user
            ]);
            /*return $this->json(['data' => $commande]);*/
        }
        else{
            return $this->redirectToRoute('app_authentif');
        }

    }
}
