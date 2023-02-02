<?php 
session_start(); // Section Start
error_reporting(E_ALL); // 0 , E_ALL & ~E_NOTICE
date_default_timezone_set('Asia/Bangkok'); // Thai TimeZone +07.00
/**
 * Connect Database Class
 */
class Database {
    /** DSN -> Data Source Name */
    private static $host = 'localhost';
    private static $dbname = 'w3schools';
    private static $username = 'root';
    private static $password = '';
    private static $response = true;
    private static $connect = null;

    /** Static Class Connect Mysqy */
    public static function connect() {
        try{
            self::$connect = new PDO('mysql:host='.self::$host.';
                                        dbname='.self::$dbname.'; 
                                        charset=utf8', 
                                        self::$username, 
                                        self::$password);
            self::$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // ตั้งค่า ใช้ตัวเลขใน SQL ได้ ผ่าน Sql Limit
            self::$connect->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            return self::$connect;
        }catch(PDOException $e){
            echo 'Database could not be connected: ' . $e->getMessage();
            exit();
        }
    }
    /** Static Class Mysql */
    public static function query($query = null, $params = array()) {
        if(self::$connect instanceof PDO){
            try{
                /** Query SQL */
                $statement = self::$connect->prepare($query);
                /** Ingetion */
                $statement->execute($params);
                /** explode SQL Array [0] */
                $command = strtoupper(explode(' ', $query)[0]);
                switch ($command) {
                    case 'SELECT' :
                        /** SELECT SQL */
                        self::$response = $statement->fetchAll(PDO::FETCH_ASSOC);
                        break;
                    case 'INSERT' :
                        /** INSERT SQL */
                        self::$response = self::$connect->lastInsertId();
                        break;
                    default:
                        /** UPDATE, DELETE SQL */
                        self::$response = $statement->rowCount();
                }
                // print_r(self::$response);
                return self::$response;
            } catch (Throwable $e) {
                http_response_code(500);
                echo "Err : " . $e->getMessage();
                exit();
            }
        }else{
            http_response_code(500);
            echo 'Plese connected DataBase';
            exit();
        }
    }
}
/** TEST Static Connect */
Database::connect();
// print_r($conn);
// Database::query();
// Database::query("SELECT * FROM categories");
// Database::query("UPDATE `categories` SET `Description` = 'Cheeses' WHERE `categories`.`CategoryID` = 4");
// Database::query("INSERT INTO `categories` ( `CategoryName`, `Description`) VALUES ('sdsds', 'dsdsdsds')");
// Database::query("DELETE FROM categories WHERE `categories`.`CategoryID` = 13");
?>