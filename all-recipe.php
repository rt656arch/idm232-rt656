<?php
require_once 'config.php';

$searchTerm = "";
if (!empty($_GET['search'])) {
    $searchTerm = $_GET['search'];
}

$filterType = "";
if (!empty($_GET['type'])) {
    $filterType = $_GET['type']; // chicken, beef, vegetarian, etc.
}
include 'header.php';

$conn = getDBConnection();

$allowedTypes = ['chicken', 'beef', 'pork', 'vegetarian', 'seafood'];


if ($searchTerm !== "") {

    
    $stmt = $conn->prepare(
        "SELECT recipe_id, recipe_heading, recipe_subheading, hero 
         FROM idm232_recipes 
         WHERE recipe_heading LIKE ? 
         ORDER BY recipe_id DESC"
    );

    $like = "%".$searchTerm."%";
    $stmt->bind_param("s", $like);

} elseif ($filterType !== "" && in_array($filterType, $allowedTypes)) {

    // CATEGORY FILTER logic
    $stmt = $conn->prepare(
        "SELECT recipe_id, recipe_heading, recipe_subheading, hero
         FROM idm232_recipes
         WHERE category = ?
         ORDER BY recipe_id DESC"
    );

    $stmt->bind_param("s", $filterType);

} else {

   
    $stmt = $conn->prepare(
        "SELECT recipe_id, recipe_heading, recipe_subheading, hero 
         FROM idm232_recipes 
         ORDER BY recipe_id DESC"
    );
}


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


$recipes = [];
while ($row = $result->fetch_assoc()) {
    $recipes[] = $row;
}

$stmt->close();
$conn->close();
?>

<section class="home-recipes">
    <h2>All Recipes</h2>

    <div class="filter-bar">
    <a href="all-recipe.php" 
       class="pill <?= ($filterType === "") ? 'active' : '' ?>">All</a>

    <a href="all-recipe.php?type=chicken" 
       class="pill <?= ($filterType === 'chicken') ? 'active' : '' ?>">Chicken</a>

    <a href="all-recipe.php?type=beef" 
       class="pill <?= ($filterType === 'beef') ? 'active' : '' ?>">Beef</a>

    <a href="all-recipe.php?type=pork" 
       class="pill <?= ($filterType === 'pork') ? 'active' : '' ?>">Pork</a>

    <a href="all-recipe.php?type=seafood" 
       class="pill <?= ($filterType === 'seafood') ? 'active' : '' ?>">Seafood</a>

    <a href="all-recipe.php?type=vegetarian" 
       class="pill <?= ($filterType === 'vegetarian') ? 'active' : '' ?>">Vegetarian</a>
</div>

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