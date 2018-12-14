<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RecordController extends AbstractController
{
    /**
     * @Route("/record", name="record")
     */
    public function record()
    {
        return $this->render('record/record.html.twig', [
            'controller_name' => 'RecordController',
        ]);
    }
}
