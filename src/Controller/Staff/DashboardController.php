<?php

namespace App\Controller\Staff;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/staff/dashboard", name="staff_dashboard")
     */
    public function index()
    {
        return $this->render('staff/dashboard/index.html.twig');
    }
}
