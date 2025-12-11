<?php
require 'config.php'; 
include 'header.php'; 

$conn = getDBConnection();


$searchTerm = $_GET['search'] ?? '';
$searchTerm = trim($searchTerm);

if ($searchTerm === '') {
    echo "<p>No search term provided.</p>";
    exit;
}


$stmt = $conn->prepare(
    "SELECT recipe_id, recipe_heading, recipe_subheading, hero 
     FROM idm232_recipes 
     WHERE CONCAT(recipe_heading, ' ', recipe_subheading, ' ', description, ' ', ingredients) LIKE ?
     ORDER BY recipe_id DESC"
);
$like = "%{$searchTerm}%";
$stmt->bind_param("s", $like);

$stmt->execute();
$result = $stmt->get_result();
?>

<section class="home-recipes">
    <h1>Search Results for "<?= htmlspecialchars($searchTerm) ?>"</h1>
    <div class="newRecipeContainer">
        <?php
        if ($result->num_rows > 0) {
            while ($recipe = $result->fetch_assoc()) {
                include 'recipecard.php';
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