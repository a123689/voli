<?php
require_once('controllers/base_controller.php');
require_once('models/splash.php');

class SplashesController extends BaseController
{
  function __construct()
  {
    $this->folder = 'splashes';
    if (!is_dir('public/splashes')) {
      mkdir('public/splashes');
    }
  }

  public function index()
  {
    $splash = new Splash();
    $list = $splash->all();
    if (count($list) == 0) {
      $data = array('splash' => ["splash_image" => "empty"]);
      $this->render('index', $data);
    } else {
      $data = array('splash' => $list[0]);
      $this->render('index', $data);
    }
  }
  public function update()
  {
    if (isset($_POST['btn_apply']) && getimagesize($_FILES["fileSplash"]["tmp_name"])) {
      $splash = new Splash();
      $list = $splash->all();
      if (count($list) == 0) {
        # create
        $target_dir = "public/splashes/";
        $filename = basename($_FILES["fileSplash"]["name"]);
        $target_file = $target_dir . $filename;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if (isset($_POST["btn_apply"])) {
          $check = getimagesize($_FILES["fileSplash"]["tmp_name"]);
          if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
          } else {
            echo "File is not an image.";
            $uploadOk = 0;
          }
        }
        // Check file size
        if ($_FILES["fileSplash"]["size"] > 50000000) {
          echo "Sorry, your file is too large.";
          $uploadOk = 0;
        }
        // Allow certain file formats
        if (
          $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
          && $imageFileType != "gif"
        ) {
          echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
          echo "Sorry, your file was not uploaded.";
          // if everything is ok, try to upload file
        } else {
          if (move_uploaded_file($_FILES["fileSplash"]["tmp_name"], $target_file)) {
            $splash->create($filename);
            header("Location: ?controller=splashes&action=index");
          } else {
            echo "Sorry, there was an error uploading your file.";
          }
        }
      } else {
        # update
        $target_dir = "public/splashes/";
        $filename = basename($_FILES["fileSplash"]["name"]);
        $target_file = $target_dir . $filename;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if (isset($_POST["btn_apply"])) {
          $check = getimagesize($_FILES["fileSplash"]["tmp_name"]);
          if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
          } else {
            echo "File is not an image.";
            $uploadOk = 0;
          }
        }
        // Check file size
        if ($_FILES["fileSplash"]["size"] > 50000000) {
          echo "Sorry, your file is too large.";
          $uploadOk = 0;
        }
        // Allow certain file formats
        if (
          $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
          && $imageFileType != "gif"
        ) {
          echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
          echo "Sorry, your file was not uploaded.";
          // if everything is ok, try to upload file
        } else {
          if (move_uploaded_file($_FILES["fileSplash"]["tmp_name"], $target_file)) {
            $res = $splash->update($list[0]["splash_id"], $filename);
            header("Location: ?controller=splashes&action=index");
          } else {
            echo "Sorry, there was an error uploading your file.";
          }
        }
      }
    } else {
      header("Location: ?controller=pages&action=error");
    }
  }
}
