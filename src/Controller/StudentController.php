<?php

namespace App\Controller;

use App\Entity\Student;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class StudentController extends AbstractController
{
    /**
     * @Route("/dodaj", name="dodaj_studenta")
     */
    public function dodaj(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $student = new Student();
        $student->setName('Jan Kowalski');
        $student->setYearOfBirth(1999);
        $student->setSubject('Informatyka i Ekonometria');

        $entityManager->persist($student);

        $entityManager->flush();

        return new Response('Dodano nowego studenta z id '.$student->getId());
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

        return new Response('Student '.$student->getName().' jest zapisany w bazie z numerem id '.$student->getId());
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

        $student->setName('Basia Nowak');
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
