<?php


require('./conn_db/db.php');

require ('recaptcha.php');

$errormsg = '';
$successmsg = '';

if (!empty($_POST)) {
    // Validation des champs requis
    if (empty($_POST['form_firstname']) || empty($_POST['form_lastname']) || empty($_POST['form_message']) || empty($_POST['form_contact_email'])) {
        $errormsg = "Veuillez remplir tous les champs";
    } else {
        $captcha = new Recaptcha('');
        if (empty($_POST['g-recaptcha-response']) || $captcha->checkCode($_POST['g-recaptcha-response']) == false) {
            $errormsg = "Captcha faux"; // Message d'erreur ReCAPTCHA
        }
    }

    if (empty($errormsg)) {
        // Le formulaire est valide, traitez-le ici
        $form_firstname = htmlspecialchars($_POST['form_firstname']);
        $form_lastname = htmlspecialchars($_POST['form_lastname']);
        $form_reason = htmlspecialchars($_POST['form_reason']);
        $form_message = htmlspecialchars($_POST['form_message']);
        $form_contact_email = htmlspecialchars($_POST['form_contact_email']);
        $form_company = htmlspecialchars($_POST['form_company']);
        $form_date_send = date('Y-m-d H:i:s'); // Obtient la date et l'heure actuelles

        if (isset($_POST['form_mark_choice'])) {
            $selected_marks = $_POST['form_mark_choice'];
        } else {
            $selected_marks = array();
        }

        if (!empty($selected_marks)) {
            $form_mark_choice = implode(",", $selected_marks);

            $insertForm = $conn->prepare('INSERT INTO pro_form (form_firstname, form_lastname, form_reason, form_message, form_contact_email, form_company, form_mark_choice, form_date_send) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
            $insertForm->execute(array($form_firstname, $form_lastname, $form_reason, $form_message, $form_contact_email, $form_company, $form_mark_choice, $form_date_send));

            $to = "";
            $subject = "Nouveau formulaire soumis";
            $message = "Un nouveau formulaire a été soumis avec les détails suivants:\n\n";
            $message .= "Nom: $form_firstname\n";
            $message .= "Prénom: $form_lastname\n";
            $message .= "Marques choisies: $form_mark_choice\n";
            $message .= "Message: $form_reason\n";
            $message .= "Message: $form_message\n";

if (mail($to, $subject, $message)) {
    $successmsg = "Formulaire envoyé et e-mail envoyé avec succès !";
} else {
    $errormsg = "Erreur lors de l'envoi de l'e-mail.";
}

// Ajoutez cette instruction de débogage pour vérifier la valeur de $successmsg
var_dump($successmsg);

        }
    }
}

?>


