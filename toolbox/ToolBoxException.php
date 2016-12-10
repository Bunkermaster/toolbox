<?php
namespace ToolBox;

/**
 * Class ToolBoxException
 * codes :
 * 100 ToolBox::init() pas execute
 * 101 Le fichier toolbox/conf.php n'existe pas
 * 102 Constantes PDO non definies dans toolbox/conf.php
 * 103 Probleme de configuration de la connection PDO dans toolbox/conf.php
 * @author Yann Le Scouarnec <yann.le-scouarnec@hetic.net>
 * @package lib
 */
class ToolBoxException extends \Exception
{
}