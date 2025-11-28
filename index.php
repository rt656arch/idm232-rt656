<?php
include 'header.php';
require_once 'config.php';

$conn = getDBConnection();
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
                <div class="recipeCard">
                    <div class="recipeImg">
                        <a href="single-recipe.html" target="_blank"> <img src="images/0101_FPP_Chicken-Rice_97338_WEB_SQ_hi_res.jpg" alt="Chicken Rice"></a>
                    </div>
                    <div class="recipeName">
                        <h3>Ancho-Orange Chicken</h3>
                        <div class="recipeName2">
                            <p>with Kale Rice & Roasted Carrots</p>
                        </div>
                    </div>
                </div>
                <div class="recipeCard">
                    <div class="recipeImg">
                        <a href="single-recipe.html" target="_blank"> <img src="images/0101_FPP_Chicken-Rice_97338_WEB_SQ_hi_res.jpg" alt="Chicken Rice"></a>
                    </div>
                    <div class="recipeName">
                        <h3>Ancho-Orange Chicken</h3>
                        <div class="recipeName2">
                            <p>with Kale Rice & Roasted Carrots</p>
                        </div>
                    </div>
                </div>
                <div class="recipeCard">
                    <div class="recipeImg">
                        <a href="single-recipe.html" target="_blank"> <img src="images/0101_FPP_Chicken-Rice_97338_WEB_SQ_hi_res.jpg" alt="Chicken Rice"></a>
                    </div>
                    <div class="recipeName">
                        <h3>Ancho-Orange Chicken</h3>
                        <div class="recipeName2">
                            <p>with Kale Rice & Roasted Carrots</p>
                        </div>
                    </div>
                </div>
                <div class="recipeCard">
                    <div class="recipeImg">
                        <a href="single-recipe.html" target="_blank"> <img src="images/0101_FPP_Chicken-Rice_97338_WEB_SQ_hi_res.jpg" alt="Chicken Rice"></a>
                    </div>
                    <div class="recipeName">
                        <h3>Ancho-Orange Chicken</h3>
                        <div class="recipeName2">
                            <p>with Kale Rice & Roasted Carrots</p>
                        </div>
                    </div>
                </div>
                <div class="recipeCard">
                    <div class="recipeImg">
                        <a href="single-recipe.html" target="_blank"> <img src="images/0101_FPP_Chicken-Rice_97338_WEB_SQ_hi_res.jpg" alt="Chicken Rice"></a>
                    </div>
                    <div class="recipeName">
                        <h3>Ancho-Orange Chicken</h3>
                        <div class="recipeName2">
                            <p>with Kale Rice & Roasted Carrots</p>
                        </div>
                    </div>
                </div>
                <div class="recipeCard">
                    <div class="recipeImg">
                        <a href="single-recipe.html" target="_blank"> <img src="images/0101_FPP_Chicken-Rice_97338_WEB_SQ_hi_res.jpg" alt="Chicken Rice"></a>
                    </div>
                    <div class="recipeName">
                        <h3>Ancho-Orange Chicken</h3>
                        <div class="recipeName2">
                            <p>with Kale Rice & Roasted Carrots</p>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <?php
    include 'footer.php';
    ?>