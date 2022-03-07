<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" type="text/css" href="public/main.css" />
        <meta charset="utf8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title><?= $title ?></title>
    </head>
    <body>
        <header>
            <div id="logo_name">
                <h1>Shop Name</h1>
            </div>
            <nav>
                <a href="index.php?/=listProducts">PRODUCTS</a>
                <a href="index.php?/=cart"><img src="public/images/shopping-cart.png" alt="shopping cart" /></a>
            </nav>
        </header>
        <section>
            <?= $content ?>
        </section>
        <footer>
            <p>&copy; 2021 Shop Name</p>
            <p>we know who you are</p>
        </footer>
    </body>
</html>