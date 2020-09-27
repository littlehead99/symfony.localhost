<?php

namespace App\Controller;

use App\Entity\Student;
use App\Entity\Kierunek;
use App\Entity\Przedmiot;
use App\Repository\StudentRepository;
use App\Form\StudentType;
use App\Form\KierunekType;
use App\Form\PrzedmiotType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Twig\Environment;

class StudentController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(Environment $twig, StudentRepository $studentRepository)
    {
        return new Response($twig->render('Student/index.html.twig', [
                       'studenci' => $studentRepository->findAll(),
                    ]));
    }

    /**
     * @Route("/formularz/student", name="form_student")
     */
    public function form_student(Request $request)
    {
        $student = new Student();
        $form = $this-> createForm(StudentType::class,$student, [
            'action'=> $this ->generateUrl('form_student')
    ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($student);
            $em->flush();
        }

        return $this->render('Student/form.html.twig',[
            'form_student'=>$form->createView()
        ]);
    }

    /**
     * @Route("/formularz/kierunek", name="form_kierunek")
     */
    public function form_kierunek(Request $request)
    {
        $kierunek = new Kierunek();
        $form = $this-> createForm(KierunekType::class,$kierunek, [
            'action'=> $this ->generateUrl('form_kierunek')
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($kierunek);
            $em->flush();
        }

        return $this->render('Student/form_kierunek.html.twig',[
            'form_kierunek'=>$form->createView()
        ]);
    }

    /**
     * @Route("/formularz/przedmiot", name="form_przedmiot")
     */
    public function form_przedmiot(Request $request)
    {
        $przedmiot = new Przedmiot();
        $form = $this-> createForm(PrzedmiotType::class,$przedmiot, [
            'action'=> $this ->generateUrl('form_przedmiot')
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($przedmiot);
            $em->flush();
        }

        return $this->render('Student/form_przedmiot.html.twig',[
            'form_przedmiot'=>$form->createView()
        ]);
    }

    /**
     * @Route("/pokaz/{id}", name="pokaz_studenta")
     */
    public function pokaz($id)
    {
        $student = $this->getDoctrine()
            ->getRepository(Student::class)
            ->find($id);

        if (!$student) {
            throw $this->createNotFoundException(
                'Brak studenta w bazie.'
            );
        }

        return new Response('Student '.$student->getNazwa().' jest zapisany w bazie z numerem id '.$student->getId());
    }

    /**
     * @Route("/edytuj/{id}")
     */
    public function edytuj($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $student = $entityManager->getRepository(Student::class)->find($id);

        if (!$student) {
            throw $this->createNotFoundException(
                'Nie znaleziono studenta o id '.$id.'.'
            );
        }

        $student->setNazwa('Basia Nowak');
        $entityManager->flush();

        return $this->redirectToRoute('pokaz_studenta', [
            'id' => $student->getId()
        ]);
    }

    /**
     * @Route("/usun/{id}")
     */
    public function usun($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $student = $entityManager->getRepository(Student::class)->find($id);

        if (!$student) {
            throw $this->createNotFoundException(
                'Nie znaleziono studenta o id '.$id
            );
        }
        $entityManager->remove($student);
        $entityManager->flush();

        return new Response('Usunięto studenta o id '.$id);
    }
}
