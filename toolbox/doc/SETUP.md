# Configuration

## Créer la base de données locale
Créer la base de données de votre projet.
Executer le SQL suivant pour ajouter la table de démonstration de la ToolBox :
``` sql
CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `nom`, `description`, `prix`, `image`) VALUES
(1, 'Toybox', 'la boite à jouets!', 12, 'img/toybox.jpg');
```

## Composer
### Installer composer
[Composer](https://getcomposer.org/download/)

### Installer la ToolBox
Composer définit l'autoload de la ToolBox. Lancer la commande suivante dans le terminal:
```
cd repertoire/de/votre/projet/
composer dumpautoload
```

## Configurer la connection base de données
Pour configurer l'accès à la base de donnée, nous utiliserons des constantes d'espace de nom. Elles sont initialisées dans le fichier suivant :
```
toolbox/conf.php
```

Ce fichier contient la déclaration de toutes les constantes de connection PDO comme suit :
``` php
<?php
namespace ToolBox;

// PHP_TOOLBOX_DB_DEBUG true affiche tous les elements des requetes executees par la toolbox
const PHP_TOOLBOX_DB_DEBUG = false;
const PHP_TOOLBOX_DB_HOST = "localhost";
const PHP_TOOLBOX_DB_PORT = "3306";
const PHP_TOOLBOX_DB_NAME = "toolbox";
const PHP_TOOLBOX_DB_USER = "root";
const PHP_TOOLBOX_DB_PASS = "root";
```

## Utiliser la base de données directement
```
<?php
use \ToolBox\ToolBox;

$database = ToolBox::getDatabase(); 
```

La variable ```$database``` contient désormais l'instance de PDO qui permet de manipuler la base de données.

## Utiliser la base de données à travers les fonctions de la ToolBox
