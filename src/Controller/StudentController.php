<?php
namespace App\Controller;

use App\Entity\Student;
use App\Repository\StudentRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class StudentController extends AbstractController{

    public function helloAction(){
        //pageweb //msg //json //xml
        return new Response("hello from controller");
    }

    #[Route(path: "/test",name:"test")]
    public function testAction(){
        return new Response("hello 2");
    }

    #[Route('/student/add',name:"app_student_add")]
    public function addStudent(ManagerRegistry $manager){

        //Create student1 object
        $student = new Student();
        $student->setUsername('foulen');
        $student->setEmail('foulen@gmail.com');
        $student->setMoyenne(10);

        //Create student2 object
        $student1 = new Student();
        $student1->setUsername('foulen2');
        $student1->setEmail('foulen2@gmail.com');
        $student1->setMoyenne(15);

        //Get entity manager 
        $em=$manager->getManager();

        //Call persist function using entity manager class
        $em->persist($student);
        $em->persist($student1);

        //Execute persist function
        $em->flush();
        return $this->redirectToRoute("app_student_getall");
    }

    #[Route("/student/update/{id}",name:'app_student_update')]
    public function updateStudent($id,ManagerRegistry $manager,StudentRepository $repo){
        
        //get student object from database using id
        $student = $repo->find($id);

        //update username
        $student->setUsername('foulen updated');

        //Get entity manager 
        $em=$manager->getManager();

        //Execute update function
        $em->flush();
        return $this->redirectToRoute("app_student_getall");
    }

    #[Route("/student/get/all",name:'app_student_getall')]
    public function getAllstudent(StudentRepository $repo){

        return $this->render('studentsList.html.twig',[
            "students"=>$repo->findAll()
        ]);
    }

    #[Route('/student/delete/{id}',name:"app_student_delete")]
    public function deleteStudent($id,ManagerRegistry $manager,StudentRepository $repo){
        $student = $repo->find($id);

        $em=$manager->getManager();
        $em->remove($student);
        $em->flush();

        return $this->redirectToRoute("app_student_getall");
    }
}

?>