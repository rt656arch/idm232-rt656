<?php
require_once 'config.php';

$searchTerm = "";
if (!empty($_GET['search'])) {
    $searchTerm = $_GET['search'];
}

include 'header.php';

$conn = getDBConnection();

$recipe_id = $_GET['id'] ?? 0;


$stmt = $conn->prepare("SELECT * FROM idm232_recipes WHERE recipe_id = ?");
$stmt->bind_param("i", $recipe_id);
$stmt->execute();
$result = $stmt->get_result();


if ($result && $result->num_rows > 0) {
    $recipe = $result->fetch_assoc();

    // Sanitize output to prevent XSS
    $recipeName = htmlspecialchars($recipe['recipe_heading']);
    $recipeName2 = htmlspecialchars($recipe['recipe_subheading']);
    $description = nl2br(htmlspecialchars($recipe['description']));
    $ingredients = nl2br(htmlspecialchars($recipe['ingredients']));
    $steps = nl2br(htmlspecialchars($recipe['steps']));
    $hero = htmlspecialchars($recipe['hero']);
    $ingredientsImage = htmlspecialchars($recipe['ingredients_image']);
    $stepsImages = htmlspecialchars($recipe['steps_images']);
} else {
    echo "<p>Recipe not found.</p>";
    exit;
}
$stmt->close();
$conn->close();
?>

<section class="single-container">

        <div class="single-intro">
            <div class="single-title">
                <h1><?= $recipeName ?></h1>
                <h3><?= $recipeName2 ?></h3>

                <div class="single-description">
                    <p><?= $description ?></p>
                </div>
            </div>

            <div class="single-img">
                <?php if (!empty($hero)): ?>
                    <img src="<?= $hero ?>" alt="Hero Image" class="hero-image">
                <?php endif; ?>
            </div>
        </div>

        <div class="recipe-info">
            <div class="ingredients">
                <?php if (!empty($ingredientsImage)): ?>
                    <img src="<?= $ingredientsImage ?>" alt="Ingredients Image">
                <?php endif; ?>

                <hr>
                <h3>
                    Ingredients
                </h3>
                <p>
                    <?= $ingredients ?>
                </p>
                <br>
                <hr>
            </div>


            <div class="single-steps">
                <h3>Steps</h3>
            <p> 
                <?= $steps ?>
            </p>
            </div>
        </div>
    </section>

    <?php
    include 'footer.php';
    ?>