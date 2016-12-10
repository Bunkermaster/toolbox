<?php
require_once "../../vendor/autoload.php";
// initialisation de la connection PDO
\ToolBox\ToolBox::init();
var_dump(\ToolBox\ToolBox::getDatabase());
