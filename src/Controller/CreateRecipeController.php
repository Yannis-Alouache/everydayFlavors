<?php
namespace App\Controller;

use App\Form\RecipeType;
use App\Entity\Recipe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class CreateRecipeController extends AbstractController
{
    #[Route(path:"/creer-recette")]
    public function RecipeCreatorPage() : Response {

        $recipe = new Recipe();
        $form = $this->createForm(RecipeType::class, $recipe);

        return $this->render('recipeCreator.html.twig', [
            'form'=> $form,
        ]);
    } 
}