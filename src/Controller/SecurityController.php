<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\UpdatePassword;

use App\Form\AccountType;
use App\Form\RegistrationType;
use App\Form\UpdatePasswordType;

use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class SecurityController extends AbstractController
{
    /**
     * Permet d'afficher et de gérer le formulaire de connexion
     * 
     * @Route("/security/inscription", name="security_registration")
     * 
     * @return Response
     */
    public function registration(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder )
    {
        $user = new User();

        $form = $this->createForm(RegistrationType::class, $user);

        $form->HandleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {  
            $hash = $encoder->encodePassword($user, $user->getPassword());

            $user->setPassword($hash);

            $manager->persist($user);
            $manager->flush();

            $this->addFlash(
                'success',
                "Vous êtes inscrit. Vous pouvez vous connecter !"
            );
            
            return $this->redirectToRoute('security_login');
        }

        return $this->render('security/registration.html.twig', [
            'form_inscription'=> $form->createView()
        ]);
    }

    /**
     * Permet de donner les raisons du refus de connection utilisateur
     * 
    * @Route("/security/connexion", name="security_login")
    */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUserName();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }
    
    /**
     * Permet à l'utilisateur de se déconnecter
     * 
     * @Route("/security/deconnexion", name="security_logout")
     * 
     * @return void
     */
    public function logout()
    {    }

    /**
     * permettre à l'utilisateur d'éditer et modifier son profil
     * 
     * @Route ("/security/profile", name="security_profile")
     * 
     * @return Response
     */

     public function profile(Request $request, ObjectManager $manager){
         $user = $this->getUser();

         $form = $this->createForm(AccountType::class, $user);

         $form->handleRequest($request);

         if($form->isSubmitted() && $form->isValid())
         {
             $manager->persist($user);
             $manager->flush();

             $this->addFlash(
                 'success',
                 "Les modifications ont été enregistrées avec succès."
             );
         }

         return $this->render('security/profile.html.twig',[
             'formProfile' =>$form->createView()
         ]);
    }

/**
 * permet de modifier le mot de passe
 * 
 * @Route ("/security/updatepassword", name="updatepassword")
 * 
 * @return Response
 */

 public function updatePassword(request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder ){

     $updatePassword = new UpdatePassword();
     $user = $this->getUser();

     $form = $this->createForm(UpdatePasswordType::class, $updatePassword);

     $form->handleRequest($request);

     if ($form->isSubmitted() && $form->isValid()){
         //1- Vérifier que le oldpassword correspond au password de l'user

        if (!password_verify($updatePassword->getOldPassword(), $user->getPassword() )){
            //gérer un mauvais mot de passe dans le champ mot de passe actuel
            dump($user);
            dump($updatePassword->getOldPassword());
            
            $form->get('oldPassword')->addError(new FormError("Attention ! Le mot de passe actuel est incorrect."));
        }
        else{
            // bon oldpassword : prendre, remplacer par le newpassword et l'encoder
            $newPassword = $updatePassword->getNewPassword();
            $hash = $encoder->encodePassword($user, $newPassword);

            $user->setPassword($hash);
            $manager->persist($user);
            $manager->flush();

            $this->addFlash(
                'success',
                "Votre mot de passe a été modifié"
            );
            
            return $this->redirectToRoute('updatepassword');
        }
     }

     return $this->render('security/updatePassword.html.twig',[
        'formUpdatePassword' => $form->createView()
        ]);
 }
}
