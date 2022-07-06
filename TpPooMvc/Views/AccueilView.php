<?php ob_start() ?>



<?php

$titre = "Acceuil";

$content = ob_get_clean();

require_once "template.php";
