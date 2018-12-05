<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class UserController extends AbstractController
{
    /**
     * @Route("/user/{id}", name="user_compte")
     * 
     * @return Response 
     */
    public function index($id, User $user)
    {
        // Je récupère l'utilisateur qui correspond à l'id
        
        return $this->render('user/compte.html.twig', [
            'user' => $user
        ]);
    }

        /* GESTION DES UTILISATEURS sur L'INTERFACE ADMINISTRATEUR*/

      /**
    * Affichage de tous les utilisateurs
    *  
    * @Route("/admin/user_list", name="user_list")
    * 
    */
    public function user_list()
    {   
        $repo = $this->getDoctrine()->getRepository(User::class);
        $users = $repo->findAll();

        return $this->render('admin/user_list.html.twig', [
            'users' => $users
        ]);
    }

    /** 
    * Supprimer un utilisateur
    *
    * @Route("/admin/user/{id}/user_delete", name="user_delete")
    *
    * @param User $user
    * @param ObjectManager $manager
    * 
    * @return Response
    */
    public function delete_user(User $user, ObjectManager $manager)
    {
        $manager->remove($user);
        $manager->flush();

        $this->addFlash(
            'success',
            "L'utilisateur <strong>{$user->getname()}</strong> a été supprimé !"
        );
        
        return $this->RedirectToRoute('user_list');
    }
}



