<?php
require_once("config/config.php");
class TextborderImage extends Config
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
    $sql = "select * from textborder_images order by textborder_image_id desc";
    $data = mysqli_fetch_all($this->query($sql), MYSQLI_ASSOC);
    return $data;
  }
  public function getImagebyCategoryId($textborder_category_id)
  {
    $sql = "select * from textborder_images where textborder_category_id='$textborder_category_id' order by textborder_image_id desc";
    $data = mysqli_fetch_all($this->query($sql), MYSQLI_ASSOC);
    return $data;
  }
  public function create($image_url, $thumbnail, $textborder_category_id)
  {
    $sql = "insert into textborder_images (image_url,thumbnail,textborder_category_id) values ('$image_url','$thumbnail','$textborder_category_id')";
    $data = $this->query($sql);
    return $data;
  }
  public function find($textborder_image_id)
  {
    $sql = "SELECT * from textborder_images where textborder_image_id='$textborder_image_id'";
    $data = $this->query($sql);
    return $data;
  }
  public function update($textborder_image_id, $textborder_category_id)
  {
    $sql = "UPDATE textborder_images SET textborder_category_id='$textborder_category_id' WHERE textborder_image_id='$textborder_image_id'";
    $data = $this->query($sql);
    return $data;
  }
  public function updateFile($textborder_image_id, $image_url, $thumbnail, $textborder_category_id)
  {
    $sql = "UPDATE textborder_images SET image_url='$image_url',thumbnail='$thumbnail',textborder_category_id='$textborder_category_id' WHERE textborder_image_id='$textborder_image_id'";
    $data = $this->query($sql);
    return $data;
  }
  public function delete($textborder_image_id)
  {
    $sql = "DELETE FROM  textborder_images WHERE textborder_image_id='$textborder_image_id'";
    $data = $this->query($sql);
    return $data;
  }
}
