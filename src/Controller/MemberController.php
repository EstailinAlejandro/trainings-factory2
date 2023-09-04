<?php

namespace App\Controller;

use App\Entity\Lesson;
use App\Entity\Person;
use App\Entity\Registration;
use App\Entity\Training;
use App\Repository\LessonRepository;
use App\Repository\PersonRepository;
use App\Repository\RegistrationRepository;
use App\Repository\TrainingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MemberController extends AbstractController
{
    #[Route('/member', name: 'app_member')]
    public function index(): Response
    {
        return $this->render('member/index.html.twig', [
            'controller_name' => 'MemberController',
        ]);
    }

    #[Route('/memberTrainingen', name: 'app_member_trainingen')]
    public function trainingen(TrainingRepository $trainingRepository): Response
    {
        $training = $trainingRepository->findAll();
        return $this->render('member/trainingmember.html.twig', [
            'controller_name' => 'AdminController',
            'trainingen' => $training,
        ]);
    }

    #[Route('/lessen/{id}', name: 'lessen')]
    public function lessen(int $id, EntityManagerInterface $em): Response
    {
        $training = $em->getRepository(Training::class)->find($id);
        $lessons = $em->getRepository(Lesson::class)->findBy(['training' => $training]);

        return $this->render('member/lessonmember.html.twig', [
            'controller_name' => 'KlantController',
            'lessons' => $lessons,
            'trainingen' => $training,

        ]);
    }

    #[Route('/inschrijf/{id}', name: 'inschrijf')]
    public function inschrijf(int $id, RegistrationRepository $registrationRepository, LessonRepository $lessonRepository): Response
    {

        $lesson = $lessonRepository->find($id);
        $peron = $this->getPerson();
        $entry = new Registration();
        $entry->setPayment("true");
        $entry->setPerson($peron);
        $entry->setLesson($lesson);
        $registrationRepository->save($entry);
        $this->addFlash('success', 'Je bent ingeschreven');
        return $this->redirectToRoute('app_member_trainingen');

    }

    #[Route('/show_user', name: 'show_user')]
    public function showUser(PersonRepository $personRepository): Response
    {

        $person = $this->getPerson();

        return $this->render('member/showuser.html.twig', [
            'controller_name' => 'KlantController',
            'person' => $person,


        ]);

    }

    #[Route('/update_user', name: 'user_profiel_update')]
    public function updateUser(PersonRepository $personRepository): Response
    {

        $person = $this->getPerson();

        return $this->render('member/showuser.html.twig', [
            'controller_name' => 'KlantController',
            'person' => $person,


        ]);

    }



    #[Route('/contactMember', name: 'app_contact_member')]
    public function contact(): Response
    {

        return $this->render('member/contact.html.twig', [
            'controller_name' => 'FactoryController',

        ]);
    }

    private function getPerson()
    {
    }
}
