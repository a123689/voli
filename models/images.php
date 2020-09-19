<?php
require_once("config/config.php");
class Image extends Config
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
    $sql = "select * from images order by image_id desc";
    $data = mysqli_fetch_all($this->query($sql), MYSQLI_ASSOC);
    return $data;
  }
  public function getImagebyCategoryId($category_id)
  {
    $sql = "select * from images where category_id='$category_id' order by image_id desc";
    $data = mysqli_fetch_all($this->query($sql), MYSQLI_ASSOC);
    return $data;
  }
  public function create($image_url, $thumbnail, $category_id, $priority)
  {
    $sql = "insert into images (image_url,thumbnail,category_id,priority) values ('$image_url','$thumbnail','$category_id','$priority')";
    $data = $this->query($sql);
    return $data;
  }
  public function find($image_id)
  {
    $sql = "SELECT * from images where image_id='$image_id'";
    $data = $this->query($sql);
    return $data;
  }
  public function update($image_id, $category_id, $priority)
  {
    $sql = "UPDATE images SET category_id='$category_id',priority='$priority' WHERE image_id='$image_id'";
    $data = $this->query($sql);
    return $data;
  }
  public function updateFile($image_id, $image_url, $thumbnail, $category_id, $priority)
  {
    $sql = "UPDATE images SET image_url='$image_url',thumbnail='$thumbnail',category_id='$category_id',priority='$priority' WHERE image_id='$image_id'";
    $data = $this->query($sql);
    return $data;
  }
  public function delete($image_id)
  {
    $sql = "DELETE FROM  images WHERE image_id='$image_id'";
    $data = $this->query($sql);
    return $data;
  }
  public function updatePriority($image_id, $priority)
  {
    $sql = "UPDATE images SET priority='$priority' WHERE image_id='$image_id'";
    $data = $this->query($sql);
    return $data;
  }
}
