<?php 
include './functions/function_page_mark.php';

    if (isset($_GET['mark_id'])) {
    // Récupérer la valeur de mark_id depuis l'URL
    $mark_id = $_GET['mark_id'];

    // Assurez-vous que $conn contient la connexion PDO à la base de données
    $info_marque = recuperer_info_par_id_marque($conn, $mark_id);

    if ($info_marque) {
        // Les informations de la marque ont été trouvées, vous pouvez afficher l'image ici
        ?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apie <?= $info_marque['mark_name'] ?></title>
    <link rel="icon" type="image/x-icon" href="./assets/img/favicon.ico">
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <header>
        <nav id="navbar"></nav>


    </header>
    


<main>
                <section class="presentation-mark">
                    <img src="data:image/png;base64,<?= base64_encode($info_marque['mark_img']) ?>" alt="<?= $info_marque['mark_alt'] ?>" class="logo-pres">
                    <h1 class="subtitle"><?= $info_marque['mark_name'] ?></h1>
                    <h2 class="subtitle"><?= $info_marque['solution_name'] ?></h2>
                    <div class="box-pres-desc">
                        <p>
                            <?= $info_marque['mark_desc'] ?>
                        </p>
                    </div>
                </section>

                <section class="list-solution-product">
                    <!-- Si des produits sont disponibles, les afficher -->
                    <?php if (!empty($info_marque['products'])): ?>
                        <?php foreach ($info_marque['products'] as $product): ?>
                            <div class="box-solution-product">
                                <h3 class="title-solution-product"><?= $product['product_name'] ?></h3>
                                <p class="desc-solution-product"><?= $product['product_sub_desc'] ?></p>
                                <!-- Modifier le lien "secondary-btn" pour charger la page produit correspondante -->
                                <a href="page_product_<?= $product['product_page_type'] ?>.php?product_id=<?= $product['product_id'] ?>" class="secondary-btn">Voir plus</a>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <!-- Si aucun produit n'a été trouvé -->
                        <p>Aucun produit trouvé pour cette marque.</p>
                    <?php endif; ?>
                </section>
            </main>

            <?php
        } else {
            // Aucune information de marque trouvée pour cet ID
            echo 'Aucune information de marque trouvée pour cet ID.';
        }
    } else {
        // Le paramètre mark_id n'est pas présent dans l'URL
        echo 'Paramètre mark_id manquant dans l\'URL.';
    }
    ?>
    </main>

    <footer id="footer">
        <!-- Mettez ici le contenu du pied de page de votre page -->
    </footer>

    <!-- Mettez ici les scripts nécessaires pour votre page -->
</body>



<script src="./js/include.js"></script>
<script src="./js/app.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</html>