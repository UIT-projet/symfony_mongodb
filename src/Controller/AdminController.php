<?php

namespace App\Controller;

use App\Document\Categorie;
use App\Document\Product;
use App\Document\User;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(Request $request, ChartBuilderInterface $chartBuilder, DocumentManager $dm): Response
    {
        $sesseion = $request->getSession();
        if($sesseion->get('user')){
            $users = $dm->createQueryBuilder(User::class)->field('role')->equals(null)->getQuery()->execute()->count();
            $admins = $dm->createQueryBuilder(User::class)->field('role')->equals(1)->getQuery()->execute()->count();

            /*Count Commandes*/
            $dataCom = $dm->getRepository(User::class)->findBy(['commandes'=> ['$ne' => null]]);
            $commandes = 0;
            foreach ($dataCom as $com){
                foreach ($com->getCommandes() as $cc){
                    $commandes =  $commandes + 1;
                }
            }

            /* Count products */
            $categories_l = [];
            $categories_count = [];
            $cats = $dm->getRepository(Categorie::class)->findAll();
            foreach ($cats as $cat){
                $count = $dm->createQueryBuilder(Product::class)->field('categorie')->equals($cat->getId())->getQuery()->execute()->count();
                array_push($categories_count, $count);
                array_push($categories_l, $cat->getLib());
            }


            $user = $sesseion->get('user');
            $chart = $chartBuilder->createChart(Chart::TYPE_BAR);

            $chart->setData([
                'labels' => ['Clients', 'Admin', 'Commandes'],
                'datasets' => [
                    [
                        'label' => 'Statistique',
                        'backgroundColor' => ['rgb(22, 0, 132)', 'rgb(255, 0, 0)', 'rgb(55, 99, 0)'],
                        'borderColor' => ['rgb(22, 0, 132)', 'rgb(255, 0, 0)', 'rgb(55, 99, 0)'],
                        'data' => [$users, $admins, $commandes],
                    ],
                ],
            ]);


            /*char product statistique */
            $chart2 = $chartBuilder->createChart(Chart::TYPE_PIE);

            $chart2->setData([
                'labels' => $categories_l,
                'datasets' => [
                    [
                        'label' => 'Statistique',
                        'backgroundColor' => ['rgb(22, 0, 132)', 'rgb(255, 0, 0)', 'rgb(55, 99, 0)'],
                        'borderColor' => ['rgb(22, 0, 132)', 'rgb(255, 0, 0)', 'rgb(55, 99, 0)'],
                        'data' => $categories_count,
                    ],
                ],
            ]);

            return $this->render('admin/index.html.twig', [
                'controller_name' => 'AdminController',
                'user' => $user,
                'chart' => $chart,
                'chart2' => $chart2,
            ]);
        }
        else{
            return $this->redirectToRoute('app_authentif');
        }

    }
}
