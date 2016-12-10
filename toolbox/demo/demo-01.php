<?php
require_once "../../toolbox/conf.php";
require_once "../../toolbox/ToolBox.php";
require_once "../../toolbox/ToolBoxException.php";
// initialisation de la connection PDO
\ToolBox\ToolBox::init();
var_dump(\ToolBox\ToolBox::getDatabase());
