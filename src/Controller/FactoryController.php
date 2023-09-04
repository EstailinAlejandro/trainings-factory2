<?php

namespace App\Controller;

use App\Entity\Person;
use App\Form\FormType;
use App\Repository\PersonRepository;
use App\Repository\TrainingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class FactoryController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('factory/index.html.twig', [
            'controller_name' => 'FactoryController',
        ]);
    }

    #[Route('/training', name: 'app_training')]
    public function training(TrainingRepository $trainingRepository): Response
    {
        $training = $trainingRepository->findAll();
        return $this->render('factory/trainingen.html.twig', [
            'controller_name' => 'FactoryController',
            'trainingen' => $training,
        ]);
    }

    #[Route('/contact', name: 'app_contact')]
    public function contact(TrainingRepository $trainingRepository): Response
    {

        return $this->render('factory/contact.html.twig', [
            'controller_name' => 'FactoryController',

        ]);
    }

    #[Route('/login', name: 'login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('factory/login.html.twig', [
            'controller_name' => 'DefaultController',
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route('/logout', name: 'logout')]
    public function logout(): Response
    {
        throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }

    #[Route('/redirect', name: 'redirect')]
    public function redirectAction(Security $security): Response
    {
        if ($security->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('app_admin');
        }
        elseif ($security->isGranted('ROLE_MEMBER')) {
            return $this->redirectToRoute('app_member');
        }
        elseif ($security->isGranted('ROLE_INSTRUCTOR')) {
            return $this->redirectToRoute('app_instructor');
        }
        else {
            return $this->redirectToRoute('app_home');
        }
    }

    #[Route('/register', name: 'register')]
    public function register(PersonRepository $personRepository,UserPasswordHasherInterface $userPasswordHasher ,Request $request): Response
    {

        $person = new Person();
        $form = $this->createForm(FormType::class, $person);
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
            return $this->redirectToRoute('app_home');

        } elseif ($form->isSubmitted() && $form->isEmpty()) {
            $this->addFlash('error','Vul alles in!');
            return $this->redirectToRoute('app_insert');
        }

        return $this->renderForm('factory/register.html.twig', [
            'controller_name' => 'DefaultController',
            'form' => $form,

        ]);
    }

}
