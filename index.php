<?php
require_once 'config.php';
include 'header.php';

$conn = getDBConnection();

// Get newest 10 recipes
$stmt = $conn->prepare(
    "SELECT recipe_id, recipe_heading, recipe_subheading, hero, description, steps
     FROM idm232_recipes 
     ORDER BY recipe_id DESC
     LIMIT 10"
);

// Execute
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

// Get recipes
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

        foreach ($recipes as $recipe) {
            include 'recipecard.php';
        }
        ?>
    </div>
</section>

<?php
include 'footer.php';
?>