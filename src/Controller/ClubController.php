<?php

namespace App\Controller;
use App\Entity\Club;
use App\Repository\ClubRepository;
use Doctrine\ORM\EntityRepository ;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClubController extends AbstractController
{
    #[Route('/club', name: 'app_club')]
    public function index(): Response
    {
        return $this->render('club/index.html.twig', [
            'controller_name' => 'ClubController',
        ]);
    }

    #[Route('/listFormation', name: 'app_formation')]
    public function formations()
    {
        $var1= "3A30";
        $var2= "J21";
        $formations = array(
            array('ref' => 'form147', 'Titre' => 'Formation Symfony
4','Description'=>'pratique',
                'date_debut'=>'12/06/2020', 'date_fin'=>'19/06/2020',
                'nb_participants'=>19) ,
            array('ref'=>'form177','Titre'=>'Formation SOA' ,
                'Description'=>'theorique','date_debut'=>'03/12/2020','date_fin'=>'10/12/2020',
                'nb_participants'=>0),
            array('ref'=>'form178','Titre'=>'Formation Angular' ,
                'Description'=>'theorique','date_debut'=>'10/06/2020','date_fin'=>'14/06/2020',
                'nb_participants'=>12));
        return $this->render("club/list.html.twig",
            array("XYZ"=>$var1,"salle"=>$var2,"tab"=>$formations));
    }

    #[Route('/reservation', name: 'app_reservation')]
    public function reservation()
    {
        return new Response("nouvelle page");
    }

    #[Route('/listClub',name:'app_listClub')]
    public function listClub(ClubController $repository)
    {
        $clubs=$repository->findAll(); 
        return $this->render("club/listClub.htm.twig",array("tabClub"=>$clubs)) ; 
    }

    #[Route('addClub',name:'app_addClub')]

      public function addClub ()
     {

      $club=new Club(); 
      $club=setName("club3");  
      $club=setDesciption("club3"); 
      $em=$doctrine->getManager(); 
      $em->persiste(); 
      $em->flush();


    }

    public function updateClub(){}
    #[Route('/removeclub/{id}',name:'app_removeClub')]
    public function removeClub(ManagerRegistry $doctrine ,ClubRepository $repository,$id){
        $club=$repository->findAll($id) ;
        $em=$doctrine->getManager() ;
        $em->remove($club);
        $em->flush(); 
        return $this->redirectToRoute(route:"app_listClub") ; 

    

    }
}
