<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RecipeRepository")
 */
class Recipe
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cookingtime;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Difficulty", inversedBy="recipe")
     */
    private $difficulty;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Instruction", mappedBy="recipe")
     */
    private $instructions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ingredient", mappedBy="recipe")
     */
    private $ingredients;

    public function __construct()
    {
        $this->instructions = new ArrayCollection();
        $this->ingredients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getCookingtime(): ?int
    {
        return $this->cookingtime;
    }

    public function setCookingtime(?int $cookingtime): self
    {
        $this->cookingtime = $cookingtime;

        return $this;
    }

    public function getDifficulty(): ?Difficulty
    {
        return $this->difficulty;
    }

    public function setDifficulty(?Difficulty $difficulty): self
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    /**
     * @return Collection|Instruction[]
     */
    public function getInstructions(): Collection
    {
        return $this->instructions;
    }

    public function addInstruction(Instruction $instruction): self
    {
        if (!$this->instructions->contains($instruction)) {
            $this->instructions[] = $instruction;
            $instruction->setRecipe($this);
        }

        return $this;
    }

    public function removeInstruction(Instruction $instruction): self
    {
        if ($this->instructions->contains($instruction)) {
            $this->instructions->removeElement($instruction);
            // set the owning side to null (unless already changed)
            if ($instruction->getRecipe() === $this) {
                $instruction->setRecipe(null);
            }
        }

        return $this;
    }
    
    /**
     * @return Collection|Ingredient[]
     */
    public function getIngredients(): Collection
    {
        return $this->ingredients;
    }

    public function addIngredient(Ingredient $ingredient): self
    {
        if (!$this->ingredients->contains($ingredient)) {
            $this->ingredients[] = $ingredient;
            $ingredient->setRecipe($this);
        }

        return $this;
    }

    public function removeIngredient(Ingredient $ingredient): self
    {
        if ($this->ingredients->contains($ingredient)) {
            $this->ingredients->removeElement($ingredient);
            // set the owning side to null (unless already changed)
            if ($ingredient->getRecipe() === $this) {
                $ingredient->setRecipe(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }

}
