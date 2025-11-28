<?php
require 'config.php'; 
include 'header.php'; 

$conn = getDBConnection();

// get search term
$searchTerm = $_GET['search'] ?? '';
$searchTerm = trim($searchTerm);

if ($searchTerm === '') {
    echo "<p>No search term provided.</p>";
    exit;
}

// prepared statement
$stmt = $conn->prepare(
    "SELECT recipe_id, recipe_heading, recipe_subheading, hero 
     FROM idm232_recipes 
     WHERE recipe_heading LIKE ? OR recipe_subheading LIKE ? 
     ORDER BY recipe_id DESC"
);
$like = "%$searchTerm%";
$stmt->bind_param("ss", $like, $like);

$stmt->execute();
$result = $stmt->get_result();
?>

<section class="home-recipes">
    <h1>Search Results for "<?= htmlspecialchars($searchTerm) ?>"</h1>
    <div class="newRecipeContainer">
        <?php
        if ($result->num_rows > 0) {
            while ($recipe = $result->fetch_assoc()) {
                echo '<div class="recipeCard">';
                echo '<a href="single-recipe.php?id=' . $recipe['recipe_id'] . '" style="text-decoration:none;color:inherit;">';
                if (!empty($recipe['hero'])) {
                    echo '<img src="' . htmlspecialchars($recipe['hero']) . '" alt="Hero Image" class="hero-image">';
                }
                echo '<h2 class="recipe_heading">' . htmlspecialchars($recipe['recipe_heading']) . '</h2>';
                echo '<h3 class="recipe_subheading">' . htmlspecialchars($recipe['recipe_subheading']) . '</h3>';
                echo '</a>';
                echo '</div>';
            }
        } else {
            echo "<p>No recipes found.</p>";
        }
        ?>
    </div>
</section>

<?php
$stmt->close();
$conn->close();
include 'footer.php';
?>