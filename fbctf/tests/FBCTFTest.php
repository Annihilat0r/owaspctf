<?hh

abstract class FBCTFTest
  extends PHPUnit_Extensions_Database_TestCase {

  static private $pdo = null;
  private $conn = null;

  final public function getConnection(
  ): PHPUnit_Extensions_Database_DB_IDatabaseConnection {

    if ($this->conn === null) {
      $config = parse_ini_file('../settings.ini');
      $host = must_have_idx($config, 'DB_HOST');
      $db_name = must_have_idx($config, 'DB_NAME');
      $username = must_have_idx($config, 'DB_USERNAME');
      $password = must_have_idx($config, 'DB_PASSWORD');

      if (self::$pdo === null) {
        self::$pdo = new PDO("mysql:dbname=$db_name;host=$host", $username, $password);
      }

      $this->conn = $this->createDefaultDBConnection(self::$pdo, $db_name);
    }

    return $this->conn;
  }

  final public function getDataSet(
  ): PHPUnit_Extensions_Database_DataSet_IDataSet {
    return $this->createXMLDataSet(
      dirname(__FILE__).'/_files/seed.xml',
    );
  }
}
