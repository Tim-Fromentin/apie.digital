<?php
include './functions/function_page_mark.php';

if (isset($_GET['solution_id'])) {
    $solution_id = $_GET['solution_id'];

    // Assurez-vous que $conn contient la connexion PDO à la base de données
    $solution_name = recuperer_nom_solution($conn, $solution_id);

    if ($solution_name) {
        // Récupérer la liste des marques ayant la solution donnée
        $marks = recuperer_marks_par_solution($conn, $solution_id);

        ?>

        <!DOCTYPE html>
        <html lang="fr">
        <head>
        <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Apie <?= $solution_name ?></title>
    <link rel="icon" type="image/x-icon" href="./assets/img/favicon.ico">
    <link rel="stylesheet" href="style/style.css">
        </head>
        <body>
            <header>
                <nav id="navbar"></nav>
            </header>

            <main>
                <h1 class="title title-solu"><?= $solution_name ?></h1>
            <div class="container-box-solution">
                        <?php foreach ($marks as $mark): ?>
                            <a href="mark.php?mark_id=<?=$mark['mark_id'] ?>" class="container-solution">
            <div class="box-solution">
                <img src="data:image/png;base64,<?= base64_encode($mark['mark_img']) ?>" alt="" class="logo-solution">
                <div class="desc-solution"><?= $solution_name ?></div><!-- Affiche le nom de la solution ici -->
            </div>
        </a>
                        <?php endforeach; ?>
                    </div>
            </main>

            <footer id="footer">
                <!-- Mettez ici le contenu du pied de page de votre page -->
            </footer>

            <!-- Mettez ici les scripts nécessaires pour votre page -->
            <script src="./js/include.js"></script>
            <script src="./js/app.js"></script>
            <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
            <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        </body>
        </html>

        <?php
    } else {
        echo 'Aucune marque trouvée avec cette solution.';
    }
} else {
    echo 'Paramètre solution_id manquant dans l\'URL.';
}
?>