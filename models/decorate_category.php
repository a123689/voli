<?php
require_once("config/config.php");
class DecorateCategory extends Config
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
    return $data;
  }
  public function create($decorate_category_name, $status, $is_pro, $priority)
  {
    $sql = "insert into decorate_categories (decorate_category_name,status,is_pro,priority) values ('$decorate_category_name','$status','$is_pro','$priority')";
    $data = $this->query($sql);
    return $data;
  }
  public function find($decorate_category_id)
  {
    $sql = "SELECT * from decorate_categories where decorate_category_id='$decorate_category_id'";
    $data = $this->query($sql)->fetch_assoc();
    return $data;
  }
  public function update($decorate_category_id, $decorate_category_name, $status, $is_pro, $priority)
  {
    $sql = "UPDATE decorate_categories SET decorate_category_name='$decorate_category_name', status='$status', is_pro='$is_pro',priority='$priority' WHERE decorate_category_id='$decorate_category_id'";
    $data = $this->query($sql);
    return $data;
  }
  public function delete($decorate_category_id)
  {
    $sql = "DELETE FROM  decorate_categories WHERE decorate_category_id='$decorate_category_id'";
    $data = $this->query($sql);
    return $data;
  }
  public function updatePriority($decorate_category_id, $priority)
  {
    $sql = "UPDATE decorate_categories SET priority='$priority' WHERE decorate_category_id='$decorate_category_id'";
    $data = $this->query($sql);
    return $data;
  }
}
