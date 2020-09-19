<?php
require_once("config/config.php");
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
    $sql = "select * from categories order by category_id desc";
    $data = mysqli_fetch_all($this->query($sql), MYSQLI_ASSOC);
    return $data;
  }
  public function create($category_name,$status, $is_pro, $priority)
  {
    $sql = "insert into categories (category_name,status,is_pro,priority) values ('$category_name','$status','$is_pro','$priority')";
    $data = $this->query($sql);
    return $data;
  }
  public function find($category_id)
  {
    $sql = "SELECT * from  categories where category_id='$category_id'";
    $data = $this->query($sql)->fetch_assoc();
    return $data;
  }
  public function update($category_id, $category_name,$status, $is_pro, $priority)
  {
    $sql = "UPDATE categories SET category_name='$category_name', status='$status', is_pro='$is_pro',priority='$priority' WHERE category_id='$category_id'";
    $data = $this->query($sql);
    return $data;
  }
  public function delete($category_id)
  {
    $sql = "DELETE FROM  categories WHERE category_id='$category_id'";
    $data = $this->query($sql);
    return $data;
  }
  public function updatePriority($category_id, $priority)
  {
    $sql = "UPDATE categories SET priority='$priority' WHERE category_id='$category_id'";
    $data = $this->query($sql);
    return $data;
  }
}
