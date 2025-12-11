<?php
$recipe_id = htmlspecialchars($recipe['recipe_id']);
$recipe_heading = htmlspecialchars($recipe['recipe_heading']);
$recipe_subheading = htmlspecialchars($recipe['recipe_subheading']);
$hero = htmlspecialchars($recipe['hero'] ?? '');
?>

<div class="recipeCard">
    <a href="single-recipe.php?id=<?= $recipe_id ?>" style="text-decoration: none; color: inherit;">
        <?php if (!empty($hero)): ?>
            <img src="<?= $hero ?>" alt="<?= $recipe_heading ?>" class="hero-image">
        <?php endif; ?>
        <h2 class="recipe_heading"><?= $recipe_heading ?></h2>
        <h3 class="recipe_subheading"><?= $recipe_subheading ?></h3>
    </a>
</div>