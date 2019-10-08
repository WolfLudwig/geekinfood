<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Entity\Difficulty;
use App\Entity\Ingredient;
use App\Entity\Instruction;
use App\Entity\Unit;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RecipeController extends AbstractController
{
    /**
     * @Route("/", name="recipes")
     */
    public function index()
    {
        $rec = $this->getDoctrine()->getRepository(Recipe::class);
        $recipes = $rec->findAll();

        return $this->render('recipe/index.html.twig', [
            'controller_name' => 'RecipeController',
            'recipes' => $recipes
        ]);
    }

    /**
     * @Route("/recipe/{id}", name="recette")
     */
    public function show($id)
    {
        $rec = $this->getDoctrine()->getRepository(Recipe::class);
        $recipes = $rec->find($id);

        return $this->render('recipe/recipe.html.twig', [
            'controller_name' => 'RecipeController',
            'recipe' => $recipes
        ]);
    }
}
