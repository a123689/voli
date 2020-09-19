<?php
require_once("config/config.php");
class Font extends Config
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
    $sql = "select * from fonts order by font_id desc";
    $data = mysqli_fetch_all($this->query($sql), MYSQLI_ASSOC);
    return $data;
  }
  public function create($font_name, $font_country, $font_url)
  {
    $sql = "insert into fonts (font_name,font_country,font_url) values ('$font_name','$font_country','$font_url')";
    $data = $this->query($sql);
    return $data;
  }
  public function find($font_id)
  {
    $sql = "SELECT * from fonts where font_id='$font_id'";
    $data = $this->query($sql);
    return $data;
  }
  public function update($font_id, $font_name, $font_country)
  {
    $sql = "UPDATE fonts SET font_name='$font_name',font_country='$font_country' WHERE font_id='$font_id'";
    $data = $this->query($sql);
    return $data;
  }
  public function updateFile($font_id, $font_url, $font_name, $font_country)
  {
    $sql = "UPDATE fonts SET font_url='$font_url',font_name='$font_name',font_country='$font_country' WHERE font_id='$font_id'";
    $data = $this->query($sql);
    return $data;
  }
  public function delete($font_id)
  {
    $sql = "DELETE FROM  fonts WHERE font_id='$font_id'";
    $data = $this->query($sql);
    return $data;
  }
}
