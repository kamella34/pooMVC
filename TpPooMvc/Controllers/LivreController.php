<?php
require_once "GlobalController.php";
require_once "Models/LivreManager.php";

class LivreController
{
  private $livreManager;

  public function __construct()
  {

    $this->livreManager = new LivreManager();
    $this->livreManager->chargementLivres();
  }
  public function afficherLivres()
  {
    $TsLesLivres = $this->livreManager->getListLivre();
    require 'Views/livresView.php';
  }
  public function afficherUnLivre($idLivre)
  {
    $unLivre = $this->livreManager->getLivreById($idLivre);
    require './Views/lire.php';
  }
  public function ajoutLivre()
  {
    require 'Views/ajouter.php';
  }
  public function ajoutLivreValidation()
  {
    $files = $_FILES["img"];
    $linkImg = "public/image/";
    $ajouterUneImg = GlobalController::ajoutImage($_POST["title"], $files, $linkImg);
    $this->livreManager->ajoutLivreBd($_POST["title"], $_POST["nbr-pages"], $ajouterUneImg);
    header("location:" . URL . "livres");
  }
  function supprimerLivre($idLivre)
  {
    $recupImg = $this->livreManager->getLivreById($idLivre);
    $supprLivre = $recupImg->getImage();
    unlink("public/image/" . $supprLivre);
    $this->livreManager->DeleteLivre($idLivre);
    header("location:" . URL . "livres");
  }

  function modifierLivre($idLivre)
  {
    $recupLivre = $this->livreManager->getLivreById($idLivre);
    require 'Views/modifier.php';
    var_dump("public/image/" . $recupLivre->getImage());
    $titre = $_POST["title"];
    $recupImage = $_FILES["img"];
    var_dump($titre);
    var_dump($recupImage);
  }
  function modifValider()
  {
    $titre = $_POST["title"];
    $recupImage = $_FILES["img"];
    
    var_dump($titre);
    require 'Views/modifValider.php';
  }
}
