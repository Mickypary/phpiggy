<?php
// to run in cli
// composer run-script phpiggy
require __DIR__ . "/vendor/autoload.php";
include __DIR__ . '/src/Framework/Database.php';

use App\Config\Paths;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(Paths::ROOT);
$dotenv->load();

use Framework\Database;

$db = new Database($_ENV['DB_DRIVER'], [
  'host' => 'localhost',
  'port' => 3306,
  'dbname' => 'phpiggy'
], 'root', '');

$sqlFile = file_get_contents("./database.sql");
$db->query($sqlFile);

// try {
//   $db->connection->beginTransaction();
//   $db->connection->query("INSERT INTO products VALUE (99, 'Gloves')");
//   $search = "Hats";
//   // $search = "Hats' OR 1=1 -- ";
//   // above search for testing sql injection
//   // Note the 2 -- means sql should ignore the last single quote ' since its not needed
//   // $query = "SELECT * FROM products WHERE name='{$search}'";
//   // Below is using a placeholder ?
//   // $query = "SELECT * FROM products WHERE name=?";
//   // Below is using name parameter
//   $query = "SELECT * FROM products WHERE name= :name";
//   // $stmt = $db->connection->query($query, PDO::FETCH_ASSOC);
//   $stmt = $db->connection->prepare($query);

//   // Incase you want to bind and execute at a later time
//   $stmt->bindValue('name', 'Gloves', PDO::PARAM_STR);
//   $stmt->execute();

//   // For using placeholder
//   // $stmt->execute([
//   //   $search
//   // ]);

//   // For using named parameter
//   // $stmt->execute([
//   //   'name' => $search
//   // ]);
//   var_dump($stmt->fetchAll(PDO::FETCH_OBJ));
//   $db->connection->commit();
// } catch (\Exception $e) {
//   if ($db->connection->inTransaction()) {
//     $db->connection->rollBack();
//   }

//   echo "Transaction failed!";
// }
