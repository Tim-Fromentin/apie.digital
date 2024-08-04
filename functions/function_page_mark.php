<?php
include './conn_db/db.php';

function recuperer_info_par_id_marque($conn, $mark_id) {
    // Requête pour récupérer l'image de la marque (mark_img) et la description (mark_desc) de la table pro_marks
    $requete_marque = "SELECT mark_name, mark_img, mark_desc, mark_alt, solution_id FROM pro_marks WHERE mark_id = :mark_id";
    $stmt_marque = $conn->prepare($requete_marque);
    $stmt_marque->bindValue(':mark_id', $mark_id, PDO::PARAM_INT);
    $stmt_marque->execute();
    $row_marque = $stmt_marque->fetch(PDO::FETCH_ASSOC);

    if ($row_marque) {
        $mark_name = $row_marque["mark_name"];
        $mark_img = $row_marque["mark_img"];
        $mark_desc = $row_marque["mark_desc"];
        $mark_alt = $row_marque["mark_alt"];
        $solution_id = $row_marque["solution_id"];

        // Requête pour récupérer le nom de la solution (solution_name) de la table pro_solution en utilisant la clé étrangère (solution_id)
        $requete_solution = "SELECT solution_name FROM pro_solutions WHERE solution_id = :solution_id";
        $stmt_solution = $conn->prepare($requete_solution);
        $stmt_solution->bindValue(':solution_id', $solution_id, PDO::PARAM_INT);
        $stmt_solution->execute();
        $row_solution = $stmt_solution->fetch(PDO::FETCH_ASSOC);

        if ($row_solution) {
            $solution_name = $row_solution["solution_name"];

            // Requête pour récupérer tous les produits de l'id de la marque (mark_id) avec leur nom (product_name) et leur descriptif (product_desc) de la table pro_products
            $requete_produits = "SELECT product_name, product_sub_desc, product_id, product_page_type FROM pro_products WHERE mark_id = :mark_id";
            $stmt_produits = $conn->prepare($requete_produits);
            $stmt_produits->bindValue(':mark_id', $mark_id, PDO::PARAM_INT);
            $stmt_produits->execute();
            $produits = $stmt_produits->fetchAll(PDO::FETCH_ASSOC);

            // Retourner toutes les informations récupérées sous forme d'un tableau associatif
            return array(
                "mark_name" => $mark_name,
                "mark_img" => $mark_img,
                "mark_desc" => $mark_desc,
                "mark_alt" => $mark_alt,
                "solution_name" => $solution_name,
                "products" => $produits
            );
        }
    }

    // Si aucune information n'est trouvée, retourner NULL
    return NULL;
}



function recuperer_marks_par_solution($conn, $solution_id) {
    // Requête pour récupérer les marques ayant la solution_id donnée
    $requete_marks = "SELECT mark_name, mark_img, mark_id FROM pro_marks WHERE solution_id = :solution_id";
    $stmt_marks = $conn->prepare($requete_marks);
    $stmt_marks->bindValue(':solution_id', $solution_id, PDO::PARAM_INT);
    $stmt_marks->execute();
    $marks = $stmt_marks->fetchAll(PDO::FETCH_ASSOC);

    return $marks;
}


function recuperer_nom_solution($conn, $solution_id) {
    $requete_solution = "SELECT solution_name FROM pro_solutions WHERE solution_id = :solution_id";
    $stmt_solution = $conn->prepare($requete_solution);
    $stmt_solution->bindValue(':solution_id', $solution_id, PDO::PARAM_INT);
    $stmt_solution->execute();
    $row_solution = $stmt_solution->fetch(PDO::FETCH_ASSOC);

    if ($row_solution) {
        return $row_solution['solution_name'];
    }

    return NULL;
}


?>
