<?php
namespace ToolBox;

class ToolBox
{
    /** @var \PDO $database */
    private static $database = null;
    /**
     * @var bool true si init() a ete lance et que la config a fonctionne
     */
    private static $db_conf = false;
    /**
     * @var null|string hote database
     */
    private static $db_host = null;
    /**
     * @var int port database
     */
    private static $db_port = 3306;
    /**
     * @var null|string nom utilisateur database
     */
    private static $db_user = null;
    /**
     * @var null|string mot de passe utilisateur database
     */
    private static $db_pass = null;
    /**
     * @var null|string nom database
     */
    private static $db_name = null;
    /**
     * @var bool debug?
     */
    private static $db_debug = false;

    /**
     * @return \PDO
     * @throws ToolBoxException
     */
    public static function getDatabase()
    {
        if (false === static::$db_conf) {
            throw new ToolBoxException("Merci d'initialiser la configuration avec ToolBox::init().",100);
        }
        return static::$database;
    }

    /**
     * @throws ToolBoxException
     */
    public static function init()
    {
        // si le fichier de config n'existe pas, exception 101
        if(!file_exists(__DIR__."/conf.php")){
            throw new ToolBoxException("Fichier de configuration toolbox/conf.php inexistant.",101);
        }
        // si les constantes sont mal definies, exception 102
        if(
            !defined("\\ToolBox\\PHP_TOOLBOX_DB_PASS")
            || !defined("\\ToolBox\\PHP_TOOLBOX_DB_DEBUG")
            || !defined("\\ToolBox\\PHP_TOOLBOX_DB_NAME")
            || !defined("\\ToolBox\\PHP_TOOLBOX_DB_HOST")
            || !defined("\\ToolBox\\PHP_TOOLBOX_DB_PORT")
            || !defined("\\ToolBox\\PHP_TOOLBOX_DB_USER")
        ){
            throw new ToolBoxException("Constantes non définies dans le fichier de configuration toolbox/conf.php.",102);
        }
        static::$db_debug = PHP_TOOLBOX_DB_DEBUG;
        static::$db_name = PHP_TOOLBOX_DB_NAME;
        static::$db_host = PHP_TOOLBOX_DB_HOST;
        static::$db_port = PHP_TOOLBOX_DB_PORT;
        static::$db_user = PHP_TOOLBOX_DB_USER;
        static::$db_pass = PHP_TOOLBOX_DB_PASS;
        static::$db_conf = true;
        // connection a la base de donnees
        try{
            static::$database = new \PDO(
                "mysql:dbname=".static::$db_name.";host=".static::$db_host.";port=".static::$db_port,
                static::$db_user,
                static::$db_pass
            );
        } catch(\PDOException $exception) {
            throw new ToolBoxException("Configuration de la connection PDO erronnée", 103);
        }
        // Changement d'encodage de communication en UTF-8
        static::$database->exec("SET NAMES UTF8;");
    }

    /**
     * @param $tableName
     * @param array $fields liste des champs
     * @param string $where les conditions SQL
     * @param array $values liste des valeurs ":index" => "valeur"
     * @return mixed
     */
    public static function selectData(
        $tableName,
        array $fields = [],
        $where = "",
        array $values = []
    )
    {
        $sql = "SELECT\n\t";
        if($fields !== []){
            $sql .= implode(",\n\t", $fields);
        } else {
            $sql .= "*\n";
        }
        $sql .= "\nFROM\n\t$tableName\n";
        if($where !== ""){
            $sql .= "WHERE\n\t$where\n";
        }
        $sql .= ";";
        if(true === static::$db_debug){
            echo $sql.PHP_EOL;
        }
        // prepare sql
        $stmt = static::$database->prepare($sql);
        if($values !== []){
            foreach($values as $index => $value){
                if(true === static::$db_debug) {
                    echo "binding '$index' with value '$value'".PHP_EOL;
                }
                $stmt->bindValue($index, $value);
            }
        }
        $stmt->execute();
        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        if(true === static::$db_debug) {
            var_dump($stmt->errorInfo());
        }
        return $data;
    }

    /**
     * @return boolean
     */
    public static function isDbDebug(): bool
    {
        return self::$db_debug;
    }

}
