<?php
require 'data/products.php';

session_start(['cookie_httponly' => true]);

if (!isset($_SESSION['loginname']) && ($_SERVER['PHP_SELF'] !== '/index.php' && $_SERVER['PHP_SELF'] !== '/login.php')) {
    header('Location: /');
}

if (isset($_GET['add_to_cart']) && is_numeric($_GET['add_to_cart'])) {
    if (isset($_SESSION['cart'])) {
        if (array_key_exists($_GET['add_to_cart'], $_SESSION['cart'])) {
            $_SESSION['cart'][$_GET['add_to_cart']]['quantity'] += 1;
        } else {
            $_SESSION['cart'][$_GET['add_to_cart']] = [
                'quantity' => 1,
                'name' => $catalog[$_GET['add_to_cart']]['name'],
                'description' => $catalog[$_GET['add_to_cart']]['description']
            ];
        }
    } else {
        $_SESSION['cart'][$_GET['add_to_cart']] = [
            'quantity' => 1,
            'name' => $catalog[$_GET['add_to_cart']]['name'],
            'description' => $catalog[$_GET['add_to_cart']]['description']
        ];
    }
}

if (isset($_GET['remove_from_cart']) && is_numeric($_GET['remove_from_cart'])) {
    if (isset($_SESSION['cart'])) {
        if (array_key_exists($_GET['remove_from_cart'], $_SESSION['cart'])) {
            $_SESSION['cart'][$_GET['remove_from_cart']]['quantity'] -= 1;
            if ($_SESSION['cart'][$_GET['remove_from_cart']]['quantity'] === 0) {
                unset($_SESSION['cart'][$_GET['remove_from_cart']]);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The Cookie Factory</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/styles.css" />
</head>

<body>
    <header>
        <!-- MENU ENTETE -->
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/">
                        <img class="pull-left" src="assets/img/cookie_funny_clipart.png" alt="The Cookies Factory logo">
                        <h1>The Cookies Factory</h1>
                    </a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <?php if (!isset($_SESSION['loginname'])) { ?>
                            <li><a href="login.php" class="btn btn-info navbar-btn">Login</a></li>
                        <?php } else { ?>
                            <li><a href="logout.php" class="btn btn-danger navbar-btn text-light">Logout</a></li>
                        <?php } ?>
                        <li><a href="#">Chocolates chips</a></li>
                        <li><a href="#">Nuts</a></li>
                        <li><a href="#">Gluten full</a></li>
                        <li>
                            <a href="/cart.php" class="btn btn-warning navbar-btn">
                                <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
                                Cart
                            </a>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <div class="container-fluid text-right">
            <strong>Hello
                <?php if (isset($_SESSION['loginname'])) echo $_SESSION['loginname'];
                else echo 'Wilder' ?> !</strong>
        </div>
    </header>