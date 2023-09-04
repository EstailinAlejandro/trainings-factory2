<?php

namespace App\Controller;

use App\Entity\Person;
use App\Entity\Training;
use App\Form\InstructorFormType;
use App\Form\TrainingFormType;
use App\Form\UpdateFormType;
use App\Repository\PersonRepository;
use App\Repository\TrainingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(PersonRepository $personRepository): Response
    {
        $person = $personRepository->findAll();
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'persons' => $person,
        ]);
    }

    #[Route('/adminTrainingen', name: 'app_admin_trainingen')]
    public function trainingen(TrainingRepository $trainingRepository): Response
    {
        $training = $trainingRepository->findAll();
        return $this->render('admin/trainingen.html.twig', [
            'controller_name' => 'AdminController',
            'trainingen' => $training,
        ]);
    }

    #[Route('/delete_training/{id}', name: 'training_delete')]
    public function deleteTraining(TrainingRepository $trainingRepository,int $id, EntityManagerInterface $entityManager): Response
    {
        $training = $entityManager->getRepository(Training::class)->find($id);
        $trainingRepository->remove($training);

        $training = $trainingRepository->findAll();
        $this->addFlash('delete','training is verwijderd');

        return $this->redirectToRoute('app_admin_trainingen', [
            'trainingen' => $training,

        ]);
    }

    #[Route('/update_training/{id}', name: 'training_update')]
    public function updateTraining(TrainingRepository $trainingRepository,Request $request,Training $id): Response
    {

        $training = $trainingRepository->find($id);
        // dd($person);
        $form = $this->createForm(TrainingFormType::class, $training);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $trainingRepository->save($training, true);
            $this->addFlash('succes','Uw training is aangepast!');
            return $this->redirectToRoute('app_admin_trainingen');

        } elseif ($form->isSubmitted() && $form->isEmpty()) {
            $this->addFlash('error','Vul alles in!');
            return $this->redirectToRoute('app_admin_trainingen');
        }

        return $this->renderForm('admin/trainingform.html.twig', [
            'controller_name' => 'DefaultController',
            'form' => $form,

        ]);
    }

    #[Route('/insert_training', name: 'training_insert')]
    public function insertTraining(TrainingRepository $trainingRepository,Request $request): Response
    {

        $training = new Training();
        $form = $this->createForm(TrainingFormType::class, $training);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $trainingRepository->save($training, true);
            $this->addFlash('succes','Uw training is toegevoegd!');
            return $this->redirectToRoute('app_admin_trainingen');

        } elseif ($form->isSubmitted() && $form->isEmpty()) {
            $this->addFlash('error','Vul alles in!');
            return $this->redirectToRoute('app_admin_trainingen');
        }

        return $this->renderForm('admin/trainingform.html.twig', [
            'controller_name' => 'DefaultController',
            'form' => $form,

        ]);
    }

    #[Route('/contactadmin', name: 'app_contact_admin')]
    public function contact(): Response
    {

        return $this->render('admin/contact.html.twig', [
            'controller_name' => 'FactoryController',

        ]);
    }

    #[Route('/delete/{id}', name: 'app_delete')]
    public function delete(PersonRepository $personRepository,int $id, EntityManagerInterface $entityManager): Response
    {
        $person = $entityManager->getRepository(Person::class)->find($id);
        $personRepository->remove($person);

        $person = $personRepository->findAll();
        $this->addFlash('delete','Gebruiker is verwijderd');

        return $this->redirectToRoute('app_admin', [
            'persons' => $person,

        ]);
    }

    #[Route('/update/{id}', name: 'app_update')]
    public function update(PersonRepository $personRepository,UserPasswordHasherInterface $userPasswordHasher ,Request $request,Person $id): Response
    {

        $person = $personRepository->find($id);
       // dd($person);
        $form = $this->createForm(UpdateFormType::class, $person);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $person->setPassword(
                $userPasswordHasher->hashPassword(
                    $person,
                    $form->get('plainPassword')->getData()
                )
            );

            $personRepository->save($person, true);
            $this->addFlash('succes','Uw profiel is aangemaakt!');
            return $this->redirectToRoute('app_admin');

        } elseif ($form->isSubmitted() && $form->isEmpty()) {
            $this->addFlash('error','Vul alles in!');
            return $this->redirectToRoute('app_update');
        }

        return $this->renderForm('admin/update.html.twig', [
            'controller_name' => 'DefaultController',
            'form' => $form,

        ]);
    }


    #[Route('/insert_instuctor', name: 'insert_instructor')]
    public function insert(PersonRepository $personRepository,UserPasswordHasherInterface $userPasswordHasher ,Request $request): Response
    {
        $person = new Person();
        $form = $this->createForm(InstructorFormType::class, $person);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $person->setPassword(
                $userPasswordHasher->hashPassword(
                    $person,
                    $form->get('plainPassword')->getData()
                )
            );

            $personRepository->save($person, true);
            $this->addFlash('succes','Uw instructor is aangemaakt!');
            return $this->redirectToRoute('app_admin');

        } elseif ($form->isSubmitted() && $form->isEmpty()) {
            $this->addFlash('error','Vul alles in!');
            return $this->redirectToRoute('insert_instructor');
        }

        return $this->renderForm('admin/update.html.twig', [
            'controller_name' => 'DefaultController',
            'form' => $form,

        ]);
    }


}
