<?php
// connect to MySQL database.
class Database {
    public $connection;
    public $statement;

    public function __construct($config, $username, $password)
    {
        $dsn = 'mysql:'.http_build_query($config, '', ';');
        $this->connection  = new PDO($dsn, $username, $password, [PDO::ATTR_DEFAULT_FETCH_MODE=> PDO::FETCH_ASSOC]);
    }
    public function query($query, $params = []) {
        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($params);
        return $this;
    }
    public function find() {
        return $this->statement->fetch();
    }
    public function findOrFail() {
        $result = $this->find();
        if (! $result) {
            abort();
        }

        return $result;
    }

    public function get() {
        return $this->statement->fetchAll();
    }
    
    public function delete($params) {
      $this->query("DELETE FROM user WHERE username = :user", ["user" => $params]);
    }

  public function update($params = []) {
    dd($params);
    $this->query("UPDATE user SET level= :level, xp= :xp, coins = :coins WHERE username = :user", [
      "level" => $params["level"], 
      "xp" => $params["xp"], 
      "coins" => $params["coins"],
      "user" => $params["username"],
    ]);
  }

  public function getPlayerStats ($params) {
    return $this->query(
      "SELECT username, level, lesson_count, xp, coins FROM user WHERE username= :user", 
      ["user" => $params])->get()[0];
  }

  public function login($params = []) {
   $stmt = $this->query("SELECT * FROM user WHERE username = :user", ['user' => $params[0]])->get();
  $count = sizeof($stmt);
  if ($count == 1) {
    $stmt = $stmt[0];;
    
    if (password_verify($params[1], $stmt["password"])) {
      session_start();
        $_SESSION["username"] = $stmt['username'];
        $_SESSION["isAdmin"] = $stmt['isAdmin'];

      header("Location: /profile");
    } else {
      echo '<script>alert("Anmeldung fehlgeschlagen!");</script>';
    }
  } else {
    echo '<script>alert("Anmeldung fehlgeschlagen!");</script>';
  } 
  }

  public function getUsers($params = []) {
    return $this->query("SELECT username, email, level FROM user WHERE username != :user", ['user' => $params])->get();
  }

  public function register($params = []) {
     $stmt = $this->query("SELECT * FROM user WHERE username = :user", ['user' => $params['Username']])->get();
  $count = sizeof($stmt);
  if($count == 0 && Validator::string($params['Username'], 1, 255)){
    $checkEmail = $this->query("SELECT * FROM user WHERE email = :email", ['email' => $params['Email-Adresse']])->find();
    if(!$checkEmail && Validator::string($params['Email-Adresse'], 1, 255)) {
      if($params["Passwort"] == $params["pw2"] && Validator::string($params['Passwort'], 8, 255)) {
    //Username ist frei
      //User anlegen
        $hash = password_hash($params["Passwort"], PASSWORD_BCRYPT);
        $this->query("INSERT INTO user (username, vorname, nachname, email, password, lesson_count, level, xp, coins) VALUES (
          :username, :vorname, :nachname, :email, :password, :lesson_count, :level, :xp, :coins )", [
            'username' => $params['Username'],
            'vorname' => $params['Vorname'],
            'nachname' => $params['Nachname'],
            'email' => $params['Email-Adresse'],
            'password' => $hash,
            'lesson_count' => 0,
            'level' => 1,
            'xp' => 0,
            'coins' => 0
          ]);
        header("Location: /login");
      } else {
        echo "Die Passwörter stimmen nicht überein";
      }
  } else {
    echo "Der Username ist bereits vergeben";
  }
} 
  }
}
