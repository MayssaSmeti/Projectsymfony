<?php

namespace App\Controller;

use App\Entity\Student;
use App\Repository\StudentRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    #[Route('/student', name: 'app_student')]
    public function index(): Response
    {
        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
        ]);
    }

    #[Route('/listStudent',name:'app_listStudent')]
    public function listStudent(StudentRepository $repository)
    {
        $students= $repository->findAll();
        return $this->render("student\student.html.twig",array("tabStudent"=>$students)) ;
    }

    #[Route('/addStudent',name:'app_addStudent')]

    public function addStudent (ManagerRegistry  $doctrine)
    {

        $club= new Student();
        $club->setUsername("mayssa12");

        #  $em= $this->getDoctrine()->getManager();
        $em=$doctrine->getManager();
        $em->persist($club);
        $em->flush();
        return $this->redirectToRoute("app_listStudent");


    }

    #[Route('/updateStudent/{id}', name: 'app_updateStudent')]

    public function updateStudent($id,ManagerRegistry $doctrine,StudentRepository  $repository)
    {
        $club= $repository->find($id);
        $club->setUsername("userUpdate");
        #  $em= $this->getDoctrine()->getManager();
        $em= $doctrine->getManager();
        $em->flush();
        return $this->redirectToRoute("app_listStudent");
    }


    #[Route('/removeStudent/{id}',name:'app_removeStudent')]
    public function removeClub(ManagerRegistry $doctrine ,StudentRepository $repository,$id){

        $club=$repository->find($id) ;
        $em=$doctrine->getManager() ;
        $em->remove($club);
        $em->flush();
        return $this->redirectToRoute(route:"app_listStudent") ;



    }
}
