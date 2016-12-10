<?php
require_once "../../vendor/autoload.php";
use \ToolBox\ToolBox;
// initialisation de la connection PDO
ToolBox::init();
echo "debug : ".var_export(ToolBox::isDbDebug(),true).PHP_EOL;
// selectionne toutes les donnees de tous les champs de article
var_dump(ToolBox::selectData("article"));
// selectionne toutes les donnees des champs id et nom de article
var_dump(ToolBox::selectData("article",['id','nom']));
// selectionne les donnees des champs id et nom de article ou id = 1
var_dump(ToolBox::selectData("article",['id','nom'],"id = :id",[":id"=>"1"]));
// selectionne les donnees des champs id et nom de article ou id = 2
var_dump(ToolBox::selectData("article",['id','nom'],"id = :id",[":id"=>"2"]));
