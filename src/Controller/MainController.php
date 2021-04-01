<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Entreprise;
use App\Repository\EntrepriseRepository;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MainController extends AbstractController
{

      #[Route('/', name: 'main_home')]
     public function index(): Response
     {
         $Repo = $this->getDoctrine()->getRepository(Entreprise::class);
 
         $entreprises = $Repo->findAll();
         return $this->render('main/home.html.twig', [
             'controller_name' => 'MainController',
             'entreprises'=> $entreprises
         ]);
     }

     /**
     * @Route("/main/offre", name="main_offre")
     */
    public function Formulaire(Request $request, EntityManagerInterface $manager){
        
            $entreprise = new Entreprise();
        
        
        $form = $this->createFormBuilder($entreprise)
                     ->add('name')
                     ->add('adresse')
                     ->add('description')
                     ->add('titre')
                     ->add('contact')
                     ->add('image')
                     ->getForm();

        $form->handleRequest($request);   
        
        if($form->isSubmitted() && $form->isValid()){
            $entreprise->setdate(new \DateTime());
            $manager->persist($entreprise);
            $manager->flush();
            return $this->redirectToRoute('main_home',[
                'id'=>$entreprise->getId()
            ]);
        }

        return $this->render('main/offre.html.twig', [
            'formEntreprise'=>$form->createView(),
        ]);
    }

    #[Route('/demande', name: 'main_demande')]
    public function demande()
    {
        return $this->render('main/demande.html.twig');
    }

}

