<?php

namespace App\Controller;

use App\Entity\Recipe;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\RecipeType;


class RecipeController extends AbstractController
{
    #[Route('/', name: 'recipe_list')]
    public function recipeList(EntityManagerInterface $entityManager) : Response {
        $recipes = $entityManager->getRepository(Recipe::class)->findAll();

        return $this->render('recipeList.html.twig', [
            'recipes' => $recipes
        ]);
    }

    #[Route(path:"/creer-recette")]
    public function recipeNew(Request $request, EntityManagerInterface $entityManager) : Response {

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

    #[Route(path: "/recette/{id}", name: "show_recipe")]
    public function showRecipe(EntityManagerInterface $entityManager, int $id): Response {
        $recipe = $entityManager->getRepository(Recipe::class)->find($id);
        if (!$recipe) {
            throw $this->createNotFoundException(
                "Aucune recette avec l'id ". $id
            );
        }

        return $this->render('recipeViewer.html.twig', [
            'recipe' => $recipe
        ]);
    }
}