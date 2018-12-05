<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminAccountController extends AbstractController
{
    /**
     * Formulaire de connection à l'administration
     * 
     * @Route("/admin/login", name="admin_login")
     * 
     */
    public function adminlogin()
    {
        return $this->render('admin_account/AdminConnect.html.twig');
    }

    /**
     * route de déconnection à l'administration
     * 
     * @Route ("/admin/logout", name="admin_logout")
     * 
     * @return void
     */
    public function adminlogout(){
        //...
    }
}
