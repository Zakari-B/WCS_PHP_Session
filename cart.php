<?php
require 'inc/head.php';
?>
<section class="cookies">
    <div class="row">
        <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $id => $cookie) { ?>
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                    <figure class="thumbnail text-center">
                        <img src="assets/img/product-<?= $id; ?>.jpg" alt="<?= $cookie['name']; ?>" class="img-responsive">
                        <figcaption class="caption">
                            <h3><?= $cookie['name']; ?></h3>
                            <p><?= $cookie['description']; ?></p>
                            <div class="cartQty">
                                <a href="?remove_from_cart=<?= $id; ?>" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-minus" aria-hidden="true"></span></a>
                                <p>Quantité : <?= $cookie['quantity'] ?></p>
                                <a href="?add_to_cart=<?= $id; ?>" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>

                            </div>
                        </figcaption>
                    </figure>
                </div>
            <?php }
        } else { ?>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                <p>Votre panier est vide.</p>
            </div>
        <?php } ?>
    </div>
</section>
<?php require 'inc/foot.php'; ?>