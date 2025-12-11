<?php
require_once 'config.php';
include 'header.php';

$conn = getDBConnection();

$recipe_id = $_GET['id'] ?? 0;

if (!is_numeric($recipe_id) || $recipe_id <= 0) {
    echo "<p>Invalid recipe ID.</p>";
    exit;
}


$recipe_id = (int)$recipe_id;

$stmt = $conn->prepare("SELECT * FROM idm232_recipes WHERE recipe_id = ?");
$stmt->bind_param("i", $recipe_id);

$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $recipe = $result->fetch_assoc();

    $recipeName = htmlspecialchars($recipe['recipe_heading']);
    $recipeName2 = htmlspecialchars($recipe['recipe_subheading']);
    $description = htmlspecialchars($recipe['description']);
    $ingredients = htmlspecialchars($recipe['ingredients']);
    $steps = htmlspecialchars($recipe['steps']);
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
                <img src="<?= $hero ?>" alt="<?= $recipeName ?>" class="hero-image">
            <?php endif; ?>
        </div>
    </div>

    <div class="recipe-info">
        <div class="ingredients">
    <?php if (!empty($ingredientsImage)): ?>
        <img src="<?= $ingredientsImage ?>" alt="Ingredients Image">
    <?php endif; ?>

    <hr>
    <h3>Ingredients</h3>
    
    <ul class="ingredients-list">
        <?php
        $ingredientsArray = explode("*", $ingredients);

        foreach ($ingredientsArray as $ingredient) {
            if (!empty($ingredient)) {
                echo '<li>' . htmlspecialchars($ingredient) . '</li>';
            }
        }
        ?>
    </ul>
    
    <hr>
</div>

        <div class="single-steps">
    <h3>Steps</h3>
    <?php
    $stepsArray = explode('*', $steps);
    $stepsArray = array_filter(array_map('trim', $stepsArray));
    

    $stepNumber = 1;
    foreach ($stepsArray as $step) {
        if (!empty($step)) {
            echo '<div class="step-item">';
            echo '<span class="step-number">' . $stepNumber . '.</span>';
            echo '<p class="step-text">' . htmlspecialchars($step) . '</p>';
            echo '</div>';
            $stepNumber++;
        }
    }
    ?>
</div>
    </div>
</section>

<?php
include 'footer.php';
?>