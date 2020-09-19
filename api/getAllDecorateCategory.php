<?php
require_once("../config/config.php");
class Category extends Config
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
    $sql = "select * from decorate_categories order by decorate_category_id desc";
    $data = mysqli_fetch_all($this->query($sql), MYSQLI_ASSOC);
    $allData =  $data;
    for ($i = 0; $i < count($allData); $i++) {
      $sql2 = "select * from decorate_images where decorate_category_id ='" . $allData[$i]['decorate_category_id'] . "'";
      $data2 = mysqli_fetch_all($this->query($sql2), MYSQLI_ASSOC);
      $allData[$i]['list'] = $data2;
    }
    echo json_encode($allData);
  }
}
$cate = new Category();
$cate->all();