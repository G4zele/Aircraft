<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Plane;
use App\Form\PlaneType;
use App\Repository\PlaneRepository;

class ResearchDataController extends AbstractController
{
    #[Route('/research/data', name: 'research_data', methods: ['GET'])]
    public function index(PlaneRepository $repository): Response
    {
        $planes = $repository->findAll();
        $pt = 0;
        $Nt = 0;
        $nt = 0;
        $flySummary = 0;
        $n = 0;
        $mt = 0;
        foreach ($planes as $plane)
        {
            if(!$plane->fixDate)
            {
                $Nt++;
            }
            else
            {
                $nt++;
                $flySummary += $plane->fixExploTime;
                $n++;
                $mt += $plane->countFails;
            } 
        }
        $pt = $Nt/count($planes);//Живое
        $lt = $nt/$Nt;
        $ft = $nt/count($planes);
        $tsr = $flySummary/$n;
        $epsilon = 0;
        foreach ($planes as $plane)
        {
            if($plane->fixDate)
            {
                $epsilon += (($plane->fixExploTime - $tsr)*($plane->fixExploTime - $tsr))/($n-1);
            }
        }
        $sigma = sqrt($epsilon);
        $omega = $mt/count($planes);
        $pTau = pow(1,-1*$omega);
        $Kthousand = ($mt/$flySummary)*1000;
        $finaldata = ['pt' => $pt,'lt' => $lt,'ft' => $ft,'tsr' => $tsr,'sigma' => $sigma,'omega' => $omega,'pTau' => $pTau,'Kthousand' => $Kthousand];
        return $this->render('research_data/index.html.twig', [
            'data' => $finaldata,
        ]);
    }
}
