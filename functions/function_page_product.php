<?php
include './conn_db/db.php';

function recuperer_info_par_id_produit($conn, $product_id) {
    // Requête pour récupérer les informations du produit (product_name, product_desc, product_img_hero_1) de la table pro_products
    $requete_produit = "SELECT product_name, product_desc, product_img_hero_1, product_alt, product_doc_link, product_fonct FROM pro_products WHERE product_id = :product_id";
    $stmt_produit = $conn->prepare($requete_produit);
    $stmt_produit->bindValue(':product_id', $product_id, PDO::PARAM_INT);
    $stmt_produit->execute();
    $row_produit = $stmt_produit->fetch(PDO::FETCH_ASSOC);

    if ($row_produit) {
        $product_name = $row_produit["product_name"];
        $product_desc = $row_produit["product_desc"];
        $product_img_hero_1 = $row_produit["product_img_hero_1"];
        $product_doc_link = $row_produit["product_doc_link"];
        $product_fonct = $row_produit["product_fonct"];
        $product_alt = $row_produit["product_alt"];

        $requete_qualites = "SELECT quality_title, quality_text, quality_img_id FROM pro_product_qualites WHERE product_id = :product_id";
        $stmt_qualites = $conn->prepare($requete_qualites);
        $stmt_qualites->bindValue(':product_id', $product_id, PDO::PARAM_INT);
        $stmt_qualites->execute();
        $qualities = $stmt_qualites->fetchAll(PDO::FETCH_ASSOC);

        // Pour chaque qualité, récupérer l'image (img_img) de la table pro_imgs liée par quality_img_id
        foreach ($qualities as &$quality) {
            $quality_img_id = $quality['quality_img_id'];

            // Requête pour récupérer l'image (img_img) de la table pro_imgs en utilisant la clé étrangère (quality_img_id)
            $requete_quality_img = "SELECT img_img FROM pro_imgs WHERE img_id = :quality_img_id";
            $stmt_quality_img = $conn->prepare($requete_quality_img);
            $stmt_quality_img->bindValue(':quality_img_id', $quality_img_id, PDO::PARAM_INT);
            $stmt_quality_img->execute();
            $row_quality_img = $stmt_quality_img->fetch(PDO::FETCH_ASSOC);

            if ($row_quality_img) {
                $quality['quality_img'] = $row_quality_img["img_img"];
            }
        }
        $requete_models = "SELECT model_img, model_text FROM pro_models WHERE product_id = :product_id";
        $stmt_models = $conn->prepare($requete_models);
        $stmt_models->bindValue(':product_id', $product_id, PDO::PARAM_INT);
        $stmt_models->execute();
        $models = $stmt_models->fetchAll(PDO::FETCH_ASSOC);


        // Requête pour récupérer les modules du produit (title, text, img_bg_modul, img_modul) de la table pro_product_moduls
        $requete_moduls = "SELECT modul_title, modul_text, modul_bg_img, modul_img FROM pro_product_moduls WHERE product_id = :product_id";
        $stmt_moduls = $conn->prepare($requete_moduls);
        $stmt_moduls->bindValue(':product_id', $product_id, PDO::PARAM_INT);
        $stmt_moduls->execute();
        $moduls = $stmt_moduls->fetchAll(PDO::FETCH_ASSOC);

        // Retourner toutes les informations récupérées sous forme d'un tableau associatif
        return array(
            "product_name" => $product_name,
            "product_desc" => $product_desc,
            "product_img_hero_1" => $product_img_hero_1,
            "product_alt" => $product_alt,
            "product_doc_link" => $product_doc_link,
            "product_fonct" => $product_fonct,
            "qualities" => $qualities,
            "moduls" => $moduls,
            "models" => $models
        );
    }

    

    // Si aucune information n'est trouvée, retourner NULL
    return NULL;
}


?>
