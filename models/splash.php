<?php
require_once("config/config.php");
class Splash extends Config
{
  private $conn = null;
  public function connection()
  {
    $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
    if ($this->conn->connect_error) {
      die("Connection failed: " . $this->conn->connect_error);
    } else {
      mysqli_set_charset($this->conn, "utf8");
      return $this->conn;
    }
  }
  public function query($sql)
  {
    $result = mysqli_query($this->connection(), $sql);
    return $result;
  }
  public function all()
  {
    $sql = "select * from splashes limit 1";
    $data = mysqli_fetch_all($this->query($sql), MYSQLI_ASSOC);
    return $data;
  }
  public function create($splash_image)
  {
    $sql = "insert into splashes (splash_image) values ('$splash_image')";
    $data = $this->query($sql);
    return $data;
  }
  public function find($splash_id)
  {
    $sql = "SELECT * from  splashes where splash_id='$splash_id'";
    $data = $this->query($sql);
    return $data;
  }
  public function update($splash_id, $splash_image)
  {
    $sql = "UPDATE splashes SET splash_image='$splash_image' WHERE splash_id='$splash_id'";
    $data = $this->query($sql);
    return $data;
  }
  public function delete($splash_id)
  {
    $sql = "DELETE FROM  splashes WHERE splash_id='$splash_id'";
    $data = $this->query($sql);
    return $data;
  }
}
