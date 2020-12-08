<?php

namespace lucioleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */

    public function indexAction()
    {
        return $this->render(
            '@luciole/Default/index.html.twig'
        );
    }
}
