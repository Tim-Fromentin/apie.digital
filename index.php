<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Apie securite informatique, sotckage securise">

    <title>Apie Cyber sécurité </title>
    <link rel="icon" type="image/x-icon" href="./assets/img/favicon.ico">
    <link rel="stylesheet" href="./style/style.css">
</head>
<body>
    <header class="home-page">
        <nav id="navbar"></nav>

        <h1 class="title title-header">Sécurité informatique : Protégez vos donnees avec notre expertise en cyber sécurité </h1>
        <a href="#entreprise" class="secondary-btn header-btn">En voir plus</a>
    </header>
    

    <main>
        
        


        <section class="propos" id="entreprise">
            <div class="info-entreprise">
                <img src="./assets/img/me.jpg" alt="tim fromentin from apie cybersecurity securite informatique" class="person">
                <div class="box-text">
                    <h1 class="subtitle">Entreprise française 
                <img src="./assets/img/france.png" alt="" class="france">        
                </h1>
                <p class="text">
                <span class="text-mark">APIE</span>  est une entreprise individuelle créée par Tim Fromentin et basée à Orléans, en France. En tant qu'entrepreneur unique, Tim se consacre à fournir des solutions de stockage et de sécurité de pointe pour répondre aux besoins variés de ses clients. <span class="text-mark">APIE</span> propose une gamme complète de solutions de stockage, notamment des clés USB et des disques SSD, offrant des options de stockage fiables et performantes.

En plus des solutions de stockage, <span class="text-mark">APIE</span> est également spécialisée dans les solutions de double authentification. Tim propose des produits tels que les YubiKey, des dispositifs de sécurité physique qui offrent une couche supplémentaire de protection en ajoutant une authentification forte à vos comptes en ligne. Les YubiKey sont reconnues pour leur fiabilité et leur sécurité, offrant une méthode efficace pour protéger vos informations sensibles et renforcer la sécurité de vos systèmes.

Que vous soyez à la recherche d'une solution de stockage pratique et fiable ou que vous souhaitiez renforcer la sécurité de vos comptes en ligne, <span class="text-mark">APIE</span> est là pour répondre à vos besoins. Tim met un point d'honneur à fournir des produits de qualité, un service client exceptionnel et des conseils personnalisés pour garantir la satisfaction de ses clients. Faites confiance à <span class="text-mark">APIE</span> et à son expertise en matière de stockage et de double authentification pour protéger vos données et assurer la sécurité de vos informations précieuses.
                </div>
            </div>

    
        </section>
        <section class="mark-list">
        <div class="fournisseur">
            
            <h2 class="subtitle title-mark">Revendeur officiel de</h2>
            <div class="container-list-mark">
        <?php
include './conn_db/db.php';

$query_mark = "SELECT * FROM `pro_marks`";
$statement_mark = $conn->prepare($query_mark);
$statement_mark->execute();

$marks = $statement_mark->fetchAll(PDO::FETCH_ASSOC);

if (!empty($marks)) {
    foreach ($marks as $mark) {
        $markImg = $mark['mark_img'];
        $markid = $mark['mark_id'];
        ?>
        <!-- Afficher les informations de la marque -->
        <div class="box-img-list-mark">
        <a href="mark.php?mark_id=<?=$markid ?>" class="link-mark">

                <img class="img-mark" src="data:image/png;base64,<?= base64_encode($markImg) ?>" alt="">
            </a>

        </div>
        <?php
    }
} else {
    echo "Aucune marque trouvée.";
}

?>

</div>


                </div>
        </section>


        <section class="solution-list">
















            <h1 class="title">Nos solutions</h1>






            <div class="container-box-solution" id="section-solutions">

            <?php
include './conn_db/db.php';

$query_mark = "SELECT pro_marks.*, pro_solutions.solution_name
               FROM pro_marks
               JOIN pro_solutions ON pro_marks.solution_id = pro_solutions.solution_id";

$statement_mark = $conn->prepare($query_mark);
$statement_mark->execute();

$marks = $statement_mark->fetchAll(PDO::FETCH_ASSOC);

if (!empty($marks)) {
    foreach ($marks as $mark) {
        $markImg = $mark['mark_img'];
        $markid = $mark['mark_id'];
        $solutionId = $mark['solution_id'];
        $solutionName = $mark['solution_name']; // Nom de la solution récupéré depuis la table jointe

        ?>
        <a href="mark.php?mark_id=<?=$markid ?>" class="container-solution">
            <div class="box-solution">
                <img src="data:image/png;base64,<?= base64_encode($markImg) ?>" alt="" class="logo-solution">
                <div class="desc-solution"><?= $solutionName ?></div><!-- Affiche le nom de la solution ici -->
            </div>
        </a>
        <?php
    }
} else {
    echo "Aucune marque trouvée.";
}
?>


                
                
            </div>
            
            
        </section>


    
    </main>


<footer id="footer">
</footer>




</body>

<script src="./js/include.js"></script>
<script src="./js/app.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</html>