<?php
require_once('controllers/base_controller.php');
require_once('models/images.php');
require_once('models/category.php');

class ImagesController extends BaseController
{
  function __construct()
  {
    $this->folder = 'images';
    if (!is_dir('public/images')) {
      mkdir('public/images');
    }
    $this->image_folder = 'public/images/';
  }

  public function index()
  {
    if (isset($_GET['category_id'])) {
      $image = new Image();
      $list = $image->getImagebyCategoryId($_GET['category_id']);
      $data = array('list_image' => $list);
      $this->render('index', $data);
    } else {
      header("Location: ?controller=pages&action=error");
    }
  }
  public function create()
  {
    if (isset($_POST['btnAddImage'])) {
      $listImage = $_FILES['image_url'];
      $listThumbnail = json_decode($_POST['listThumbnail']);
      $total = count($listImage['name']);
      $category = new Category();
      $currentCategory = $category->find($_POST['category_id']);
      if (!is_dir('public/images/' . $currentCategory['category_name'])) {
        mkdir('public/images/' . $currentCategory['category_name']);
      }
      $target_dir = 'public/images/' . $currentCategory['category_name'] . '/';
      for ($i = 0; $i < $total; $i++) {
        $image = new Image();
        $filename = basename($listImage["name"][$i]);
        $target_link = 'public/images/' . $currentCategory['category_name'] . '/' . $filename;
        if (move_uploaded_file($listImage["tmp_name"][$i], $target_link)) {

          $img = $listThumbnail[$i];
          $img = str_replace('data:image/png;base64,', '', $img);
          $img = str_replace(' ', '+', $img);

          $fileData = base64_decode($img);
          $filePath = $target_dir . 'thumbnail-' . $filename;
          file_put_contents($filePath, $fileData);

          $data = $image->create($target_link, $filePath, $_POST['category_id'], $_POST['priority'] + $i);
          if (!$data) {
            header("Location: ?controller=pages&action=error");
          }
        } else {
          echo "Sorry, there was an error uploading your file.";
          header("Location: ?controller=pages&action=error");
        }
      }
      header("Location: ?controller=images&category_id=" . $_POST['category_id']);
    } else {
      header("Location: ?controller=pages&action=error");
    }
  }
  public function update()
  {
    $image = new Image();
    if (isset($_POST['btnEditImage'])) {
      $category = new Category();
      $currentCategory = $category->find($_POST['ed_category_id']);
      if (!is_dir('public/images/' . $currentCategory['category_name'])) {
        mkdir('public/images/' . $currentCategory['category_name']);
      }
      if ($_FILES['ed_image_url']['size'] == 0) {
        $data = $image->update($_POST['ed_image_id'], $_POST['ed_category_id'], $_POST['ed_priority']);
        if ($data) {
          header("Location: ?controller=images&category_id=" . $_POST['ed_category_id']);
        } else {
          header("Location: ?controller=pages&action=error");
        }
      } else {
        $file_name = basename($_FILES["ed_image_url"]["name"]);
        $target_file = 'public/images/' . $currentCategory['category_name'] . '/' . $file_name;
        if (move_uploaded_file($_FILES["ed_image_url"]["tmp_name"], $target_file)) {
          $img = $_POST['editThumbnail'];
          $img = str_replace('data:image/png;base64,', '', $img);
          $img = str_replace(' ', '+', $img);

          $fileData = base64_decode($img);
          $filePath = 'public/images/' . $currentCategory['category_name'] . '/' . 'thumbnail-' . $file_name;
          file_put_contents($filePath, $fileData);
          $data = $image->updateFile($_POST['ed_image_id'], $target_file, $filePath, $_POST['ed_category_id'], $_POST['ed_priority']);
          if ($data) {
            header("Location: ?controller=images&category_id=" . $_POST['ed_category_id']);
          } else {
            header("Location: ?controller=pages&action=error");
          }
        } else {
          echo "Sorry, there was an error uploading your file.";
        }
      }
    } else {
      header("Location: ?controller=pages&action=error");
    }
  }
  public function delete()
  {
    $image = new Image();
    $data = $image->delete($_GET['image_id']);
    header("Location: ?controller=images&category_id=" . $_GET['category_id']);
  }
  public function updatePriority()
  {
    $arrayId = $_POST['list'];
    for ($i = 0; $i < count($arrayId); $i++) {
      $image = new Image();
      $image->updatePriority($arrayId[$i], $i + 1);
    }
  }
}
