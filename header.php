<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>IDM232 RECIPE WEBSITE</title>
</head>
<body>  
    <nav class="navbar">
        <div class="navbar-container">
            <a href="index.php" class="navbar-logo">Recipes</a>
            <button class="navbar-toggle">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </button>
            <ul class="navbar-menu">
                <li><a href="all-recipe.php">All Recipes</a></li>
                <!-- <li><a href="help.php">Help</a></li> -->
            </ul>
        </div>
    </nav>

    <form action="search.php" method="get" class="search-bar" style="margin-bottom:20px;">
        <input type="text" name="search" placeholder="Search recipes..." value="">
        <button type="submit">Search</button>
    </form>
