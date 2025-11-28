<?php
include 'header.php';
require_once 'config.php';

$conn = getDBConnection();

// prepare statement
$stmt = $conn->prepare("SELECT recipe_id, recipe_heading, recipe_subheading, hero FROM idm232_recipes");
if ($stmt === false) {
    die("Prepare failed: " . htmlspecialchars($conn->error));
}

if (!$stmt->execute()) {
    die("Execute failed: " . htmlspecialchars($stmt->error));
}

$result = $stmt->get_result();
if (!$result) {
    die("Getting result failed: " . htmlspecialchars($stmt->error));
}

// get recipes
$recipes = [];
while ($row = $result->fetch_assoc()) {
    $recipes[] = $row;
}

$stmt->close();
$conn->close();
?>

<section class="title">
        <div class="titleText">
            <h1>DISCOVER NEW AMAZING RECIPES</h1>
            <p>For your homecooked meals</p>
        </div>
        <div class="titleImg">
            <img src="title image.png" alt="Cartoon title image">
        </div>
</section>

<section class="home-recipes">
    <h2>Newly Added Recipes</h2>
    <div class="newRecipeContainer">
        <?php
        foreach ($recipes as $recipe) {
            $recipe_id = $recipe['recipe_id'];
            $recipe_heading = $recipe['recipe_heading'];
            $recipe_subheading = $recipe['recipe_subheading'];
            $hero = $recipe['hero'];

            echo '<div class="recipeCard">';
            
            // Link the entire card to single recipe page
            echo '<a href="single-recipe.php?id=' . $recipe_id . '" style="text-decoration: none; color: inherit;">';
            
            if (!empty($hero)) {
                echo '<img src="' . htmlspecialchars($hero) . '" alt="Hero Image" class="hero-image">';
            }

            echo '<h2 class="recipe_heading">' . htmlspecialchars($recipe_heading) . '</h2>';
            echo '<h3 class="recipe_subheading">' . htmlspecialchars($recipe_subheading) . '</h3>';
            echo '</a>'; // Close link

            echo '</div>'; // Close recipeCard
        }
        ?>
    </div>
</section>

<?php
include 'footer.php';
?>



<!-- <div class="recipeCard">
                    <div class="recipeImg">
                        <a href="single-recipe.html" target="_blank"> <img src="images/0101_FPP_Chicken-Rice_97338_WEB_SQ_hi_res.jpg" alt="Chicken Rice"></a>
                    </div>
                    <div class="recipeName">
                        <h3>Ancho-Orange Chicken</h3>
                        <div class="recipeName2">
                            <p>with Kale Rice & Roasted Carrots</p>
                        </div>
                    </div>
                </div> -->