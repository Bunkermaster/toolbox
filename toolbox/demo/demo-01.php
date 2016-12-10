<?php
require_once "../../vendor/autoload.php";
use \ToolBox\ToolBox;
// initialisation de la connection PDO
ToolBox::init();
var_dump(ToolBox::getDatabase());
