<?php
require_once("config/config.php");
class DecorateImage extends Config
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
    $sql = "select * from decorate_images order by decorate_image_id desc";
    $data = mysqli_fetch_all($this->query($sql), MYSQLI_ASSOC);
    return $data;
  }
  public function getImagebyCategoryId($decorate_category_id)
  {
    $sql = "select * from decorate_images where decorate_category_id='$decorate_category_id' order by decorate_image_id desc";
    $data = mysqli_fetch_all($this->query($sql), MYSQLI_ASSOC);
    return $data;
  }
  public function create($image_url, $thumbnail, $decorate_category_id, $priority)
  {
    $sql = "insert into decorate_images (image_url,thumbnail,decorate_category_id,priority) values ('$image_url','$thumbnail','$decorate_category_id','$priority')";
    $data = $this->query($sql);
    return $data;
  }
  public function find($decorate_image_id)
  {
    $sql = "SELECT * from decorate_images where decorate_image_id='$decorate_image_id'";
    $data = $this->query($sql);
    return $data;
  }
  public function update($decorate_image_id, $decorate_category_id, $priority)
  {
    $sql = "UPDATE decorate_images SET decorate_category_id='$decorate_category_id',priority='$priority' WHERE decorate_image_id='$decorate_image_id'";
    $data = $this->query($sql);
    return $data;
  }
  public function updateFile($decorate_image_id, $image_url, $thumbnail, $decorate_category_id, $priority)
  {
    $sql = "UPDATE decorate_images SET image_url='$image_url',thumbnail='$thumbnail',decorate_category_id='$decorate_category_id',priority='$priority' WHERE decorate_image_id='$decorate_image_id'";
    $data = $this->query($sql);
    return $data;
  }
  public function delete($decorate_image_id)
  {
    $sql = "DELETE FROM  decorate_images WHERE decorate_image_id='$decorate_image_id'";
    $data = $this->query($sql);
    return $data;
  }
  public function updatePriority($decorate_image_id, $priority)
  {
    $sql = "UPDATE decorate_images SET priority='$priority' WHERE decorate_image_id='$decorate_image_id'";
    $data = $this->query($sql);
    return $data;
  }
}
