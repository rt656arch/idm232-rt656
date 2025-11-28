<?php
require_once 'config.php';

$searchTerm = "";
if (!empty($_GET['search'])) {
    $searchTerm = $_GET['search'];
}
include 'header.php';

$conn = getDBConnection();

// get search

$searchTerm = "";
if (!empty($_GET['search'])) {
    $searchTerm = $_GET['search'];
}

// prepared statement

if ($searchTerm === "") {
    // get all recipes
    $stmt = $conn->prepare(
        "SELECT recipe_id, recipe_heading, recipe_subheading, hero 
         FROM idm232_recipes 
         ORDER BY recipe_id DESC"
    );
} else {
    // filter by heading
    $stmt = $conn->prepare(
        "SELECT recipe_id, recipe_heading, recipe_subheading, hero 
         FROM idm232_recipes 
         WHERE recipe_heading LIKE ? 
         ORDER BY recipe_id DESC"
    );

    $like = "%".$searchTerm."%";
    $stmt->bind_param("s", $like);
}

// execute
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

// get recipe

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
        <img src="title_image.png" alt="Cartoon title image">
    </div>
</section>

<section class="home-recipes">
    <h2>Newly Added Recipes</h2>


    <div class="newRecipeContainer">

        <?php
        if (empty($recipes)) {
            echo "<p>No recipes found.</p>";
        }

        // show recipes
        foreach ($recipes as $recipe) {
            $recipe_id = $recipe['recipe_id'];
            $recipe_heading = $recipe['recipe_heading'];
            $recipe_subheading = $recipe['recipe_subheading'];
            $hero = $recipe['hero'];

            echo '<div class="recipeCard">';

            echo '<a href="single-recipe.php?id=' . $recipe_id . '" style="text-decoration: none; color: inherit;">';

            if (!empty($hero)) {
                echo '<img src="' . htmlspecialchars($hero) . '" alt="Hero Image" class="hero-image">';
            }

            echo '<h2 class="recipe_heading">' . htmlspecialchars($recipe_heading) . '</h2>';
            echo '<h3 class="recipe_subheading">' . htmlspecialchars($recipe_subheading) . '</h3>';

            echo '</a>';
            echo '</div>';
        }
        ?>
    </div>
</section>

<?php
include 'footer.php';
?>