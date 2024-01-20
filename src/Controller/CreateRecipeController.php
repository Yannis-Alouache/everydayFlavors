<?php
namespace App\Controller;

use App\Entity\Tool;
use App\Form\RecipeType;
use App\Entity\Recipe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Collections\ArrayCollection;

class CreateRecipeController extends AbstractController
{


    #[Route(path:"/creer-recette")]
    public function RecipeCreatorPage(Request $request, EntityManagerInterface $entityManager) : Response {

        $recipe = new Recipe();

        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $recipe->setAuthor($this->getUser());
            $entityManager->persist($recipe);
            $entityManager->flush();

            return $this->redirectToRoute('recipe_list');
        }

        return $this->render('recipeCreator.html.twig', [
            'form'=> $form,
        ]);
    } 
}