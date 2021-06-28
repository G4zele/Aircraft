<?php

namespace App\Controller;

use App\Repository\EffExploRepository;
use App\Repository\RemontRepository;
use App\Entity\DateInterval;
use App\Form\DateIntervalType;
use App\Entity\Plane;
use App\Form\PlaneType;
use App\Repository\PlaneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\FlyOut;
use App\Form\FlyOutType;
use App\Repository\FlyOutRepository;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

#[Route('/')]
class PlaneController extends AbstractController
{

    #[Route('/', name: 'plane_index', methods: ['GET', 'POST'])]
    public function index(ChartBuilderInterface $chartBuilder, PlaneRepository $planeRepository, Request $request, EffExploRepository $effExploRepository,): Response
    {
        
        $dateInterval = new DateInterval();
        $form = $this->createForm(DateIntervalType::class, $dateInterval);
        $form->handleRequest($request);
        $indexMarkers = array('P'=> 0,'G'=> 1 ,'A'=>2,'M'=>3,'E'=>4,'ZV'=>5,'Y'=>6,
        'Ob'=>7,'Tb'=>8,'Opf'=>9,'TpfOne'=>10,'TpfTwo'=>11,'TpfThr'=>12,'Z'=>13,'Dv'=>14,
        'J'=>15,'D'=>16,'Or'=>17,'R'=>18, 0 => 'P', 1 => 'G', 2 => 'A', 3 => 'M', 4 => 'E', 5 => 'ZV', 6 => 'Y',
        7 => 'Ob', 8 => 'Tb', 9 => 'Opf', 10 => 'TpfOne', 11 => 'TpfTwo', 12 => 'TpfThr', 13 => 'Z', 14 => 'Dv',
        15 => 'J', 16 => 'D', 17 => 'Or', 18 => 'R',);
        $countOfStates = array('P' => 0,'G' => 0,'A' => 0,'M' => 0,'E' => 0,'ZV' => 0,'Y' => 0,
        'Ob' => 0,'Tb' => 0,'Opf' => 0,'TpfOne' => 0,'TpfTwo' => 0,'TpfThr' => 0,'Z' => 0,'Dv' => 0,
        'J' => 0,'D' => 0,'Or' => 0,'R' => 0,0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0,12=>0,13=>0,14=>0,
        15=>0,16=>0,17=>0,18=>0);
        $timeOfStates =array('P' => 0,'G' => 0,'A' => 0,'M' => 0,'E' => 0,'ZV' => 0,'Y' => 0,
        'Ob' => 0,'Tb' => 0,'Opf' => 0,'TpfOne' => 0,'TpfTwo' => 0,'TpfThr' => 0,'Z' => 0,'Dv' => 0,
        'J' => 0,'D' => 0,'Or' => 0,'R' => 0,0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0,12=>0,13=>0,14=>0,
        15=>0,16=>0,17=>0,18=>0);
        $piOfStates = array('P' => 0,'G' => 0,'A' => 0,'M' => 0,'E' => 0,'ZV' => 0,'Y' => 0,
        'Ob' => 0,'Tb' => 0,'Opf' => 0,'TpfOne' => 0,'TpfTwo' => 0,'TpfThr' => 0,'Z' => 0,'Dv' => 0,
        'J' => 0,'D' => 0,'Or' => 0,'R' => 0,0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0,12=>0,13=>0,14=>0,
        15=>0,16=>0,17=>0,18=>0);
        $uOfStates = array('P' => 0,'G' => 0,'A' => 0,'M' => 0,'E' => 0,'ZV' => 0,'Y' => 0,
        'Ob' => 0,'Tb' => 0,'Opf' => 0,'TpfOne' => 0,'TpfTwo' => 0,'TpfThr' => 0,'Z' => 0,'Dv' => 0,
        'J' => 0,'D' => 0,'Or' => 0,'R' => 0,0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0,12=>0,13=>0,14=>0,
        15=>0,16=>0,17=>0,18=>0);
        $StatesData = $effExploRepository->findAll();
        foreach ($StatesData as $stateData)
        {
            $countOfStates[$stateData->state]++;
            $timeOfStates[$stateData->state] += $stateData->timeOfState;
            $countOfStates[$indexMarkers[$stateData->state]] = $countOfStates[$stateData->state];
            $timeOfStates[$indexMarkers[$stateData->state]] =$timeOfStates[$stateData->state];
        }
        for($i = 0; $i<19; $i++)
        {
            $tmp = 0;
            for($j = 0; $j<19; $j++)
            {
                if($i!=$j)
                {
                    $tmp += $countOfStates[$j];
                }
            }
            if($tmp!=0)
            {
                $piOfStates[$i] = $countOfStates[$i]/$tmp;
                $piOfStates[$indexMarkers[$i]] = $piOfStates[$i];
            }
        }
        for($i = 0; $i<19; $i++)
        {
            if($countOfStates[$i]!=0)
            {
                $uOfStates[$i] = $timeOfStates[$i]/$countOfStates[$i];
                $uOfStates[$indexMarkers[$i]] = $uOfStates[$i];
            }
        }
        $Phtp = (1-($countOfStates['ZV']/$countOfStates['P']))*100;
        $summaPi = 0;
        $summaU = 0;
        for($i = 0; $i<19; $i++)
        {
            $summaPi += $piOfStates[$i];
            $summaU += $uOfStates[$i];
        }
        $KpOne = ($piOfStates['P']*$uOfStates['P'])/($summaPi*$summaU);
        $Kir = (($piOfStates['P']*$uOfStates['P'])+
        (($piOfStates['E']+$piOfStates['Ob']+$piOfStates['Tb']+$piOfStates['ZV'])*($uOfStates['E']+$uOfStates['Ob']+$uOfStates['Tb']+$uOfStates['ZV'])))/
        ($summaPi*$summaU);
        $Kvir = (($piOfStates['P']*$uOfStates['P'])+
        (($piOfStates['E']+$piOfStates['Ob']+$piOfStates['Tb']+$piOfStates['ZV']+$piOfStates['A']+$piOfStates['G'])*
        ($uOfStates['E']+$uOfStates['Ob']+$uOfStates['Tb']+$uOfStates['ZV']+$uOfStates['A']+$uOfStates['G'])))/
        ($summaPi*$summaU);
        $KpTwo = ($summaPi*$summaU)/($piOfStates['P']*$uOfStates['P']);
        $summaForKispr=($piOfStates['Opf']+$piOfStates['Or']+$piOfStates['TpfOne']+$piOfStates['TpfTwo']+$piOfStates['TpfThr']+
        $piOfStates['Y']+$piOfStates['R']+$piOfStates['Z']+$piOfStates['D']+$piOfStates['J']+$piOfStates['Dv'])*
        ($uOfStates['Opf']+$uOfStates['Or']+$uOfStates['TpfOne']+$uOfStates['TpfTwo']+$uOfStates['TpfThr']+$uOfStates['Y']+
        $uOfStates['R']+$uOfStates['Z']+$uOfStates['D']+$uOfStates['J']+$uOfStates['Dv']);
        $Kispr = (($summaPi*$summaU)-$summaForKispr)/($summaPi*$summaU);
        $SummaForKt = ($piOfStates['E']+$piOfStates['Tb']+$piOfStates['TpfOne']+$piOfStates['TpfTwo']+$piOfStates['TpfThr']+
        $piOfStates['R']+$piOfStates['Y']+$piOfStates['D'])*
        ($uOfStates['E']+$uOfStates['Tb']+$uOfStates['TpfOne']+$uOfStates['TpfTwo']+$uOfStates['TpfThr']+$uOfStates['R']+
        $uOfStates['Y']+$uOfStates['D']);
        $Kt=$SummaForKt/($piOfStates['P']*$uOfStates['P']);
        $dataOfEff = ['Phtp'=> $Phtp ,'KpOne'=> $KpOne ,'Kir'=> $Kir ,'Kvir'=> $Kvir ,'KpTwo'=> $KpTwo ,'Kispr'=> $Kispr ,'Kt'=> $Kt];
        if ($form->isSubmitted() && $form->isValid()) 
        {
            $countGraph = ['0' => 0,'400' => 0, '800' => 0, '1200' => 0, '1600' => 0, '2000' => 0];
            $NGraph = ['0' => 0,'400' => 0, '800' => 0, '1200' => 0, '1600' => 0, '2000' => 0];
            $pGraph = [0 => 1, 1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];
            $qGraph = [0 => 0, 1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];
            $intervalTime = (intval($dateInterval->enddate->format('j'))*24+intval($dateInterval->enddate->format('n'))*730+intval($dateInterval->enddate->format('Y'))*8760)
            -(intval($dateInterval->startdate->format('j'))*24+intval($dateInterval->startdate->format('n'))*730+intval($dateInterval->startdate->format('Y'))*8760);
            $planes = $planeRepository->findAll();
            $pt = 0;
            $lt = 0;
            $ft = 0;
            $tsr = 0;
            $omega = 0;
            $Kthousand = 0;
            $Nt = 0;
            $nt = 0;
            $flySummary = 0;
            $n = 0;
            $mt = 0;
            foreach ($planes as $plane)
            {
                if(!$plane->fixDate and $plane->include)
                {
                    $Nt++;
                    if( 400 > $plane->FlyTime and $plane->FlyTime >= 0 )
                    {
                        $NGraph['0']++;
                        $countGraph['0']++;
                    }
                    if( 800 > $plane->FlyTime and $plane->FlyTime >= 400)
                    {
                        $NGraph['400']++;
                        $countGraph['400']++;
                    }
                    if( 1200 > $plane->FlyTime and $plane->FlyTime >= 800)
                    {
                        $NGraph['800']++;
                        $countGraph['800']++;
                    }
                    if( 1600 > $plane->FlyTime and $plane->FlyTime >= 1200)
                    {
                        $NGraph['1200']++;
                        $countGraph['1200']++;
                    }
                    if( 2000 > $plane->FlyTime and $plane->FlyTime >= 1600)
                    {
                        $NGraph['1600']++;
                        $countGraph['1600']++;
                    }
                    if( 2400 > $plane->FlyTime and $plane->FlyTime >= 2000)
                    {
                        $NGraph['2000']++;
                        $countGraph['2000']++;
                    }
                }
                else if($plane->fixDate and $plane->include)
                {
                    $nt++;
                    $flySummary += $plane->fixExploTime;
                    $n++;
                    $mt += $plane->countFails;
                    if( 400 > $plane->FlyTime and $plane->FlyTime >= 0 )
                        $countGraph['0']++;
                    if( 800 > $plane->FlyTime and $plane->FlyTime >= 400)
                        $countGraph['400']++;
                    if( 1200 > $plane->FlyTime and $plane->FlyTime >= 800)
                        $countGraph['800']++;
                    if( 1600 > $plane->FlyTime and $plane->FlyTime >= 1200)
                        $countGraph['1200']++;
                    if( 2000 > $plane->FlyTime and $plane->FlyTime >= 1600)
                        $countGraph['1600']++;
                    if( 2400 > $plane->FlyTime and $plane->FlyTime >= 2000)
                        $countGraph['2000']++;
                }
            }

            if($countGraph[0] != 0)
                $pGraph[0] = $NGraph['0']/$countGraph['0'];
            $qGraph[0] = 1 - $pGraph[0];
            if($countGraph[400] != 0)
                $pGraph[1] = $NGraph['400']/$countGraph['400'];
            $qGraph[1] = 1 - $pGraph[1];
            if($countGraph[800] != 0)
                $pGraph[2] = $NGraph['800']/$countGraph['800'];
            $qGraph[2] = 1 - $pGraph[2];
            if($countGraph[1200] != 0)
                $pGraph[3] = $NGraph['1200']/$countGraph['1200'];
            $qGraph[3] = 1 - $pGraph[3];
            if($countGraph[1600] != 0)
                $pGraph[4] = $NGraph['1600']/$countGraph['1600'];
            $qGraph[4] = 1 - $pGraph[4];
            if($countGraph[2000] != 0)
                $pGraph[5] = $NGraph['2000']/$countGraph['2000'];
            $qGraph[5] = 1 - $pGraph[5];
            $chart = $chartBuilder->createChart(Chart::TYPE_LINE);
            $chart->setData([
                'labels' => ['0', '400', '800', '1200', '1600', '2000'],
                'datasets' => [
                    [
                        'label' => 'P',
                        'borderColor' => 'rgb(255, 99, 132)',
                        'data' =>  $pGraph,
                        'chart' => $chart,
                    ],
                    [
                        'label' => 'q',
                        'borderColor' => 'rgb(132, 99, 255)',
                        'data' =>  $qGraph,
                        'chart' => $chart,
                    ]
                ],
            ]);
            if(count($planes) != 0)
                $pt = $Nt/count($planes);//Живое
            if($Nt != 0)
                $lt = $nt/($Nt*$intervalTime);
            if(count($planes) != 0)
                $ft = $nt/(count($planes)*$intervalTime);
            if($n != 0)
                $tsr = $flySummary/$n;
            $epsilon = 0;
            foreach ($planes as $plane)
            {
                if($plane->fixDate and $plane->include)
                {
                    $epsilon += (($plane->fixExploTime - $tsr)*($plane->fixExploTime - $tsr))/($n-1);
                }
            }
            $sigma = sqrt($epsilon);
            if(count($planes) != 0)
                $omega = $mt/(count($planes)*$intervalTime);
            $pTau = pow(1,-1*$omega);
            if($flySummary != 0)
                $Kthousand = ($mt/$flySummary)*1000;
            $finaldata = ['pt' => $pt,'lt' => $lt,'ft' => $ft,'tsr' => $tsr,'sigma' => $sigma,'omega' => $omega,'pTau' => $pTau,'Kthousand' => $Kthousand];
                return $this->render('plane/index.html.twig', [
                'planes' => $planeRepository->findAll(),
                'data' => $finaldata,
                'form' => $form->createView(),
                'dataOfEff' => $dataOfEff,
                'chart' => $chart,
            ]);
        }
        return $this->render('plane/index.html.twig', [
            'planes' => $planeRepository->findAll(),
            'data' => Null,
            'form' => $form->createView(),
            'dataOfEff' => $dataOfEff,
        ]);
    }

    #[Route('/new', name: 'plane_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $plane = new Plane();
        $form = $this->createForm(PlaneType::class, $plane);
        $form->handleRequest($request);
        

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($plane);
            $entityManager->flush();

            return $this->redirectToRoute('plane_index');
        }

        return $this->render('plane/new.html.twig', [
            'plane' => $plane,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'plane_show', methods: ['GET', 'POST'])]
    public function show(Plane $plane, PlaneRepository $planeRepository, RemontRepository $remontRepository): Response
    {
        $planes = $planeRepository->findAll();
        $remonty = $remontRepository->findAll();
        $sumForKT = 0;
        $symForPy = 0;
        $symForKd = 0;
        $symForKl = 0;
        foreach($remonty as $remont)
        {
            if($plane->id == $remont->getPlaneId()->id)
            {
                $sumForKT += ($remont->timeOnTO + $remont->timeOnOperTO + $remont->timeOnKapRem)/$remont->timeOfMidRem;
                $symForPy += 1 - exp(-(1/$remont->timeYstr)*$remont->timeDir);
                $symForKd += 1 - ($remont->trudDop/($remont->trudDop+$remont->trudMain));
                $symForKl += 1 - ($remont->trudDop/($remont->trudDop+$remont->trudDeMont));
            }
        }
        $remdata = ['KT' => $sumForKT ,'Py' => $symForPy ,'Kd' => $symForKd ,'Kl' => $symForKl];
        return $this->render('plane/show.html.twig', [
            'plane' => $plane,
            'remdata' => $remdata,
        ]);
    }

    #[Route('/{id}/edit', name: 'plane_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Plane $plane): Response
    {
        $form = $this->createForm(PlaneType::class, $plane);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('plane_index');
        }

        return $this->render('plane/edit.html.twig', [
            'plane' => $plane,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'plane_delete', methods: ['POST'])]
    public function delete(Request $request, Plane $plane): Response
    {
        if ($this->isCsrfTokenValid('delete'.$plane->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($plane);
            $entityManager->flush();
        }

        return $this->redirectToRoute('plane_index');
    }
}
