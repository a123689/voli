<?php
require_once("config/config.php");
class TextborderCategory extends Config
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
    $sql = "select * from textborder_categories order by textborder_category_id desc";
    $data = mysqli_fetch_all($this->query($sql), MYSQLI_ASSOC);
    return $data;
  }
  public function create($textborder_category_name)
  {
    $sql = "insert into textborder_categories (textborder_category_name) values ('$textborder_category_name')";
    $data = $this->query($sql);
    return $data;
  }
  public function find($textborder_category_id)
  {
    $sql = "SELECT * from textborder_categories where textborder_category_id='$textborder_category_id'";
    $data = $this->query($sql)->fetch_assoc();
    return $data;
  }
  public function update($textborder_category_id, $textborder_category_name)
  {
    $sql = "UPDATE textborder_categories SET textborder_category_name='$textborder_category_name' WHERE textborder_category_id='$textborder_category_id'";
    $data = $this->query($sql);
    return $data;
  }
  public function delete($textborder_category_id)
  {
    $sql = "DELETE FROM  textborder_categories WHERE textborder_category_id='$textborder_category_id'";
    $data = $this->query($sql);
    return $data;
  }
}
