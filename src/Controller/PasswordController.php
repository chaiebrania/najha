<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\PasswordFormType;
use App\Repository\UserRepository;
use App\Service\TechFoodMailer;
use Carbon\Carbon;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class PasswordController
 * @package App\Controller
 */
class PasswordController extends AbstractController
{
    /**
     * @param Request $request
     * @param UserRepository $userRepository
     * @param TechFoodMailer $mailer
     * @param UrlGeneratorInterface $urlGenerator
     * @return JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route("/password/forgot", name="forgot_password", methods={"GET", "POST"})
     */
    public function forgot(Request $request, UserRepository $userRepository, UrlGeneratorInterface $urlGenerator)
    {
        $form = $this->createPasswordRequestForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $email = $form->get('email')->getData();
            $user = $userRepository->findOneByEmail($email);

            if(!$user instanceof User) {
                $this->addFlash('danger', "Adresse e-mail introuvable !");
                return $this->redirect($request->headers->get('referer'));
            }

            $em = $this->getDoctrine()->getManager();
            $token = hash('sha256', uniqid());
            $user->setPasswordResetToken($token);
            $user->setTokenRequestedAt(Carbon::now());
            $em->flush();
            $url = $urlGenerator->generate(
                'reset_password',
                array('email' => $email, 'token' => $token),
                UrlGeneratorInterface::ABSOLUTE_URL
            );

            $body = "Bonjour,<br/><br/>";
            $body .= "<p>Pour réinitialiser votre mot de passe veuillez cliquer sur le lien suivant:</p>";
            $body .= "<br/>";
            $body .= "<a href='$url' target='_blank'>$url</a><br><br><br>";
            $body .= "<b>TechFood</b><br>";
            $body .= "<mark>Contact:</mark> +33 7 82 65 18 76<br>";
            $body .= "<mark>Email:</mark> techfoodwebsite@gmail.com<br>";
            $body .= "<i>Vous commandez, Nous préparons!</i><br>";
            $body .= "<hr/><br>";
            $body .= "<i>55 rue de la bannière 69003, Lyon, France</i><br>";

            
            // Send here the email


            // End email section


            $message = "Vous venez de recevoir un mail de réinitialisation de mot de passe.\n";
            $message .= "Si vous n'avez pas réçu le mail alors veuillez vérifier dans la section <strong class='text-danger'>Spam</strong> sinon ressayer.";
            $this->addFlash('success', $message);

            return $this->redirectToRoute('app_login');
        }

        return $this->render('password/forgot.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * @param Request $request
     * @param string $email
     * @param string $token
     * @param UserRepository $userRepository
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param TechFoodMailer $mailer
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route("/password/reset?email={email}&token={token}", name="reset_password", methods={"GET", "POST"})
     */
    public function reset(
        Request $request, string $email, string $token,
        UserRepository $userRepository, UserPasswordEncoderInterface $passwordEncoder) {

        $user = $userRepository->findOneBy(
            array('email' => $email, 'passwordResetToken' => $token)
        );

        if(!$user instanceof User) {
            $message = "Le lien de réinitialisation de mot de passe est invalide.";
            $this->addFlash('danger', $message);
            return $this->redirectToRoute('forgot_password');
        }

        $now = Carbon::now();
        $requestedAt = Carbon::instance($user->getTokenRequestedAt());

        if($now->diffInHours($requestedAt) > 2) {
            $message = "Le lien de réinitialisation de mot de passe est expiré\n";
            $message .= "Veuillez demander de nouveau la réinitialisation de votre mot de passe !";
            $this->addFlash('danger', $message);
            return $this->redirectToRoute('forgot_password');
        }

        $form = $this->createForm(PasswordFormType::class, null, [
            'method' => Request::METHOD_POST
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $user->setPassword(
                $passwordEncoder->encodePassword($user, $form->get('password')->getData())
            );
            $em->flush();

            $body = "Bonjour,<br/><br/>";
            $body .= "<p>Votre mot de passe a été mis à jour avec succès.</p><br><br><br>";
            $body .= "<b>TechFood</b><br>";
            $body .= "<mark>Contact:</mark> +33 7 82 65 18 76<br>";
            $body .= "<mark>Email:</mark> techfoodwebsite@gmail.com<br>";
            $body .= "<i>Vous commandez, Nous préparons!</i><br>";
            $body .= "<hr/><br>";
            $body .= "<i>55 rue de la bannière 69003, Lyon, France</i><br>";

            
            // Send your email here


            // End email section


            $this->addFlash('success', 'Votre mot de passe a été mis à jour avec succès.');

            return $this->redirectToRoute('app_login');
        }
        return $this->render('password/reset.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createPasswordRequestForm() {
        return $this->createFormBuilder()
            ->add('email', EmailType::class, [
                'label' => 'Adresse e-mail',
                'attr' => [
                    'class' => 'form-control'
                ],
                'constraints' => [
                    new NotBlank(['message' => 'Ce champ est requis']),
                    new Email(['message' => 'Adresse email invalide'])
                ]
            ])
            ->setMethod(Request::METHOD_POST)
            ->getForm();
    }

}
