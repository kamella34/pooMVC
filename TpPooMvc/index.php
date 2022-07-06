<?php

define("URL", str_replace("index.php","", (isset($_SERVER['HTTPS']) ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']));

require_once "Controllers/LivreController.php";
$controller = new LivreController();

try {

    if (empty($_GET['page'])) {
        require "Views/AccueilView.php";
    } else {
        $url = explode("/", filter_var($_GET['page']), FILTER_SANITIZE_URL);

        switch ($url[0]) {
          
            case "accueil":
                require "Views/AccueilView.php";
                break;
            case "livres":
                if (empty($url[1])) {
                    $controller->afficherLivres();
                   
                } else if ($url[1] == "lire") {
                    $controller->afficherUnLivre($url[2]);
                   
                } else if ($url[1] == "ajouter") {
                    $controller->ajoutLivre();

                } else if ($url[1] == "modifier") {
                    $controller->modifierLivre($url[2]);

                } else if ($url[1] == "supprimer") {
                    $controller->supprimerLivre($url[2]);  
                    var_dump($url[2]);

                } else if ($url[1] == "valider"){
                    $controller->ajoutLivreValidation();

                }else if($url[1] == "modifValider"){
                    $controller->modifValider();
                }else {
                    throw new Exception("Page Introuvable" );
                }
                break;
               
                    
        }
    }
} catch (Exception $e) {
    echo  $e->getMessage();
}
