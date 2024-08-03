<?php
include_once "./functions/function_form.php";

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Apie Contact</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="icon" type="image/x-icon" href="./assets/img/favicon.ico">
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <header>
        <nav id="navbar"></nav>


    </header>
    

    <main>



    

            










        <section class="contact" id="contact">


<div class="subtitle">contactez nous</div>
<div class="box-contact">


<div class="form-contact">
<form method="POST" action="#end-contact">




<!-- Bouton pour envoyer les informations -->


<div class="form-contact">
<select name="form_reason" id="form_reason">
<option value="empty">Choisissez une raison :</option>
<option value="devis">Devis</option>
<option value="infoProduct">Informations produit</option>
<option value="infoService">Informations service</option>
<option value="contact">Contact</option>
<option value="other">Autre</option>
</select>





<label class="label-product-choice" for="form_mark_choice">Choisissez une ou plusieurs marques :</label>
        <ul>
            <?php
            include './conn_db/db.php';

            $query_mark = "SELECT * FROM `pro_marks`";
            $statement_mark = $conn->prepare($query_mark);
            $statement_mark->execute();

            $marks = $statement_mark->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($marks)) {
                foreach ($marks as $mark) {
                    $markName = $mark['mark_name'];
                    $markid = $mark['mark_id'];
                    ?>
                    <!-- Utilisation de balises li pour chaque marque -->
                    <li>
                        <!-- Utilisation d'une balise label pour chaque case à cocher -->
                        <label for="mark_<?php echo $markid; ?>">
                            <input type="checkbox" name="form_mark_choice[]" id="mark_<?php echo $markid; ?>" value="<?php echo $markid; ?>">
                            <?php echo $markName; ?>
                        </label>
                    </li>
                    <?php
                }
            } else {
                echo "<li>Aucune marque trouvée.</li>";
            }
            ?>
        </ul>



                <input type="text" name="form_lastname" id="form_lastname" placeholder="Votre nom">
                <input type="text" name="form_firstname" id="form_firstname" placeholder="Votre prénom">
                <input type="email" name="form_contact_email" id="form_contact_email" placeholder="Votre e-mail">
                <input type="text" name="form_company" id="form_company" placeholder="Nom de l'entreprise (facultatif)">
                <textarea name="form_message" id="form_message" cols="30" rows="10" placeholder="Votre message"></textarea>
                       <div class="g-recaptcha" data-sitekey=""></div>
                <button class="form-btn" type="submit" class="valid" name="valid">Envoyer formulaire</button>
                <div id="end-contact"></div>
        </div>




</form>
<?php
if(isset($errormsg)) {
    echo '<p class="error">'.$errormsg.'</p>';
}

if(isset($successmsg)) {
    echo '<p class="success">'.$successmsg.'</p>';
}
?>
</div>


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