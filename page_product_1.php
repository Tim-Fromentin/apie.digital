<?php
include_once './functions/function_page_product.php';

// Assurez-vous que vous avez inclus la fonction recuperer_info_par_id_produit() ici.

// Vérifier si le paramètre product_id est présent dans l'URL
if (isset($_GET['product_id'])) {
    // Récupérer la valeur de product_id depuis l'URL
    $product_id = $_GET['product_id'];

    // Assurez-vous que $conn contient la connexion PDO à la base de données
    $info_produit = recuperer_info_par_id_produit($conn, $product_id);

    if ($info_produit) {
        // Les informations du produit ont été trouvées, vous pouvez afficher les détails ici
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <title>Apie Cyber sécurité </title>
            <link rel="stylesheet" href="style/style.css">
        </head>
        <body>
            <header>
                <nav id="navbar"></nav>
            </header>

            <main>
                <section class="product-hero">
                    <h1 class="title-product">
                        <?= $info_produit['product_name'] ?>
                    </h1>
                </section>

                <section class="presentation-product">
                    <img src="data:image/png;base64,<?= base64_encode($info_produit['product_img_hero_1']) ?>" alt="" class="img-product">
                    <div class="pre-desc">
                        <?= $info_produit['product_desc'] ?>
                    </div>
                </section>




    <?php
    // Vérifier si la section modul-pages doit être affichée (par exemple, en vérifiant si des données ont été récupérées de la base de données)
    if ($info_produit && isset($info_produit['moduls']) && !empty($info_produit['moduls'])) {
        foreach ($info_produit['moduls'] as $modul) {
            // Récupérer les informations pour chaque modul
            $modul_title = $modul['modul_title'];
            $modul_text = $modul['modul_text'];
            $modul_img_bg = $modul['modul_bg_img'];
            $modul_img = $modul['modul_img'];

            // Afficher la section modul-pages pour chaque modul
            ?>
            <section class="modul-pages">
                <img class="img-bg-modul" src="data:image/png;base64,<?= base64_encode($modul_img_bg) ?>" alt="">
                <div class="box-text-modul">
                    <h4 class="subtitle title-modul"><?= $modul_title ?></h4>
                    <p class="text"><?= $modul_text ?></p>
                </div>
                <img src="data:image/png;base64,<?= base64_encode($modul_img) ?>" alt="" class="img-modul">
            </section>
            <?php
        }
    }
    ?>






                <section class="list-quality-product">
                    <div class="container-quality-product">
                        <?php foreach ($info_produit['qualities'] as $quality): ?>
                            <div class="box-quality">
                                <?php if ($quality['quality_img']): ?>
                                    <img src="data:image/png;base64,<?= base64_encode($quality['quality_img']) ?>" alt="" class="img-quality">
                                <?php endif; ?>
                                <h3 class="title-quality"><?= $quality['quality_title'] ?></h3>
                                <p class="desc-quality">
                                    <?= $quality['quality_text'] ?>
                                </p>
                            </div>
                        <?php endforeach; ?>
                    </div>


                    <a target="_blank" class="btn-file-tech" href="<?= $info_produit['product_doc_link']?>">
            Fiche Technique
        </a>
                </section>
                                    <div class="box-btn-p-quality">

                                        <a href="contact.php" class="primary-btn btn-p-quality">Demander un devis</a>
                                    </div>



            </main>

            <footer id="footer">
            </footer>

            <script src="./js/include.js"></script>
            <script src="../cyber-pro-0.4.4/js/app.js"></script>
            <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
            <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        </body>
        </html>
        <?php
    } else {
        // Aucune information de produit trouvée pour cet ID
        echo 'Aucune information de produit trouvée pour cet ID.';
    }
} else {
    // Le paramètre product_id n'est pas présent dans l'URL
    echo 'Paramètre product_id manquant dans l\'URL.';
}
?>
