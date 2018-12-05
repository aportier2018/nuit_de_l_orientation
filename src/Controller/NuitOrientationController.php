<?php

namespace App\Controller;

use App\Entity\Motcle;
use App\Entity\Exponent;

use App\Form\ExponentType;
use App\Form\KeyWordListType;

use App\Repository\MotcleRepository;
use App\Repository\ExponentRepository;

use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class NuitOrientationController extends AbstractController
{
    
    /** PARTIE UTILISATEUR **/
    
    /**
     * 
     * route pour aller sur la page d'accueil
     * 
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('nuitorientation/accueil.html.twig', [
            'controller_name' => 'NuitOrientationController',
        ]);
    }

  /**
     * formulaire de recherche par mot clé
     * 
     *@Route("/search", name="search")
     @IsGranted("ROLE_USER")

     */
    public function recherche()
    {   
        $repo = $this->getDoctrine()->getRepository(Motcle::class);
        $mc = $repo->findAll();

        return $this->render('nuitorientation/page_search.html.twig', [
            'controller_name' => 'NuitOrientationController',
            'motcles' => $mc
        ]);
    }

    /**
     * Affichage des exposants en lien avec le mot clé sélectionné
     * 
     *@Route("/result", name="result")
     *@Route("/result/{id}", name="return")
     @param Exponent $exponent
      @return Response

      @IsGranted("ROLE_USER")
     */
    public function result(Exponent $exponent = null, MotcleRepository $repoMc, ExponentRepository $repoExp, Request $request){
        if (!$exponent){
            $mc = $request->get('motcle');
            $motcle = $repoMc->find($mc)->getNameMc();
            $exponents = $repoExp->findBy([
                'mc' => $mc
            ]);
        }
        else{
            $mc = $exponent->getMotcle();
            $motcle = $repoMc->find($mc)->getNameMc();
            $exponents = $repoExp->findBy([
                'mc' => $mc
            ]);
        }

        return $this->render('nuitorientation/result.html.twig', [
            'controller_name' => 'NuitOrientationController',
            'motcle' =>$motcle,
            'exponents' =>$exponents,
        ]);
    }

     /**
      * 
      *Affichage détaillé de l'exposant sélectionné par mot clé
      *
     *@Route("/descriptif/{id}", name="descriptifExpo")
     @param Exponent $exponent
     @return Response

     @IsGranted("ROLE_USER")
     */
    public function descriptifExpo(Exponent $exponent){
     
        return $this->render('nuitorientation/descriptifExpo.html.twig', [
            'controller_name' => 'NuitOrientationController',
            'exponents' => $exponent
        ]);

    }

     /**
     * Affichage des détails des exposants
     *
     * @Route("/detail", name="detail_expo")
     */
    public function detail_exponent()
    {
        $repo = $this->getDoctrine()->getRepository(Exponent::class);
        $exponent = $repo->findAll();

        return $this->render('nuitorientation/exponent_detail.html.twig', [
            'controller_name' => 'NuitOrientationController',
            'exponents' => $exponent
        ]);
    }


    /**                     PARTIE ADMINISTRATION                               **/

    //* GESTION DES EXPOSANTS*//

    /**
    * Affichage de tous les exposants
    *  
    * @Route("/admin/exponent_list", name="exponent_list")
    * 
    */
    public function exponent_list()
    {   
        $repo = $this->getDoctrine()->getRepository(Exponent::class);
        $exponents = $repo->findAll();

        return $this->render('admin/exponent_list.html.twig', [
        
            'exponents' => $exponents
        ]);
    }

    /**
     * Ajouter un exposant et l'éditer pour le modifier
     * 
     *  @Route("/admin/exponent/{id}/edit", name="exponent_edit")
     * @Route("/admin/exponent/add", name="exponent_add")
     */
    public function exponent(Exponent $exponent = null, Request $request, ObjectManager $manager, $id = null)
    {
        if (!$exponent){
        $exponent = new Exponent();
        }

        $form = $this->createForm(ExponentType::class, $exponent);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($exponent);
            $manager->flush();

            $this->addFlash(
                 'success',
                 "Les modifications de <strong>{$exponent->getNameexp()}</strong> ont été enregistrées avec succès."
             );

            return $this->redirectToRoute('exponent_list', ['id' => $exponent->getId()]);
        }

        return $this->render('admin/exponent_add.html.twig',[
        'exponent_form' =>$form->createView(),
        'editMode' => $exponent->getId()!==null
        ]);
    }

    /** 
    * Supprimer un exposant
    *
    * @Route("/admin/exponent/{id}/delete_exp", name="exponent_delete")
    *
    * @param Exponent $exponent
    * @param ObjectManager $manager
    * 
    * @return Response
    */
    public function delete_exp(Exponent $exponent, ObjectManager $manager)
    {
        $manager->remove($exponent);
        $manager->flush();

        $this->addFlash(
            'success',
            "L'exposant <strong>{$exponent->getNameexp()}</strong> a été supprimé !"
        );
        
        return $this->RedirectToRoute('exponent_list');
    }

         //* GESTION DES MOTS CLES*//

     /**
    * Affichage de tous les mots-clés
    *  
    * @Route("/admin/mc_list", name="mc_list")
    * 
    */
    public function mc_list()
    {   
        $repo = $this->getDoctrine()->getRepository(Motcle::class);
        $mcs = $repo->findAll();

        return $this->render('admin/mc_list.html.twig', [
            'motcle' => $mcs
        ]);
    }

    /**
     * Ajout et modification des mots-clés
     * 
     *  @Route("/admin/{id}/mc_edit", name="mc_edit")
     * @Route("/admin/mc_add", name="mc_add")
     */
    public function mc_form(Motcle $mc = null, Request $request, ObjectManager $manager, $id = null)
    {
        if (!$mc){
        $mc = new Motcle();
        }

        $form = $this->createFormBuilder($mc)
                     ->add('namemc')
                    // ->add('exponents')
                     ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($mc);
            $manager->flush();

            $this->addFlash(
                 'success',
                 "Les modifications sur le mot-clé <strong>{$mc->getNamemc()}</strong> ont été enregistrées avec succès."
             );

            return $this->redirectToRoute('mc_list');
        }

        return $this->render('admin/mc_add.html.twig',[
            'mc_form' =>$form->createView(),
            'editMode' =>$mc->getId()!==null
        ]);
    }

    /** 
    * Supprimer un mot-clé
    *
    * @Route("/admin/mc/{id}/mc_delete", name="mc_delete")
    *
    * @param Motcle $mc
    * @param ObjectManager $manager
    * 
    * @return Response
    */
    public function delete(Motcle $mc, ObjectManager $manager)
    {
        $manager->remove($mc);
        $manager->flush();

        $this->addFlash(
            'success',
            "Le mot-clé <strong>{$mc->getNamemc()}</strong> a été supprimé !"
        );
        
        return $this->RedirectToRoute('mc_list');
    }

}

