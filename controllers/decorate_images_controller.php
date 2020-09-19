<?php
require_once('controllers/base_controller.php');
require_once('models/decorate_images.php');
require_once('models/decorate_category.php');

class DecorateImagesController extends BaseController
{
  function __construct()
  {
    $this->folder = 'decorate_images';
    if (!is_dir('public/decorate_images')) {
      mkdir('public/decorate_images');
    }
    $this->image_folder = 'public/decorate_images/';
  }

  public function index()
  {
    if (isset($_GET['decorate_category_id'])) {
      $image = new DecorateImage();
      $list = $image->getImagebyCategoryId($_GET['decorate_category_id']);
      $data = array('list_image' => $list);
      $this->render('index', $data);
    } else {
      header("Location: ?controller=pages&action=error");
    }
  }
  public function create()
  {
    if (isset($_POST['btnAddDecorateImage'])) {
      $listImage = $_FILES['image_url'];
      $listThumbnail = json_decode($_POST['listThumbnail']);
      $total = count($listImage['name']);
      $category = new DecorateCategory();
      $currentCategory = $category->find($_POST['decorate_category_id']);
      if (!is_dir('public/decorate_images/' . $currentCategory['decorate_category_name'])) {
        mkdir('public/decorate_images/' . $currentCategory['decorate_category_name']);
      }
      $target_dir = 'public/decorate_images/' . $currentCategory['decorate_category_name'] . '/';
      for ($i = 0; $i < $total; $i++) {
        $image = new DecorateImage();
        $filename = basename($listImage["name"][$i]);
        $target_link = 'public/decorate_images/' . $currentCategory['decorate_category_name'] . '/' . $filename;
        if (move_uploaded_file($listImage["tmp_name"][$i], $target_link)) {

          $img = $listThumbnail[$i];
          $img = str_replace('data:image/png;base64,', '', $img);
          $img = str_replace(' ', '+', $img);

          $fileData = base64_decode($img);
          $filePath = $target_dir . 'thumbnail-' . $filename;
          file_put_contents($filePath, $fileData);

          $data = $image->create($target_link, $filePath, $_POST['decorate_category_id'], $_POST['priority'] + $i);
          if (!$data) {
            header("Location: ?controller=pages&action=error");
          }
        } else {
          echo "Sorry, there was an error uploading your file.";
          header("Location: ?controller=pages&action=error");
        }
      }
      header("Location: ?controller=decorate_images&decorate_category_id=" . $_POST['decorate_category_id']);
    } else {
      header("Location: ?controller=pages&action=error");
    }
  }
  public function update()
  {
    $image = new DecorateImage();
    if (isset($_POST['btnEditDecorateImage'])) {

      $category = new DecorateCategory();
      $currentCategory = $category->find($_POST['ed_decorate_category_id']);
      if (!is_dir('public/decorate_images/' . $currentCategory['decorate_category_name'])) {
        mkdir('public/decorate_images/' . $currentCategory['decorate_category_name']);
      }
      if ($_FILES['ed_image_url']['size'] == 0) {
        $data = $image->update($_POST['ed_decorate_image_id'], $_POST['ed_decorate_category_id'], $_POST['ed_priority']);
        if ($data) {
          header("Location: ?controller=decorate_images&decorate_category_id=" . $_POST['ed_decorate_category_id']);
        } else {
          header("Location: ?controller=pages&action=error");
        }
      } else {
        $file_name = basename($_FILES["ed_image_url"]["name"]);
        $target_file = 'public/decorate_images/' . $currentCategory['decorate_category_name'] . '/' . $file_name;
        if (move_uploaded_file($_FILES["ed_image_url"]["tmp_name"], $target_file)) {
          $img = $_POST['editThumbnail'];
          $img = str_replace('data:image/png;base64,', '', $img);
          $img = str_replace(' ', '+', $img);

          $fileData = base64_decode($img);
          $filePath = 'public/decorate_images/' . $currentCategory['decorate_category_name'] . '/' . 'thumbnail-' . $file_name;
          file_put_contents($filePath, $fileData);
          $data = $image->updateFile($_POST['ed_decorate_image_id'], $target_file, $target_file, $_POST['ed_decorate_category_id'], $_POST['ed_priority']);
          if ($data) {
            header("Location: ?controller=decorate_images&decorate_category_id=" . $_POST['ed_decorate_category_id']);
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
    $image = new DecorateImage();
    $data = $image->delete($_GET['decorate_image_id']);
    header("Location: ?controller=decorate_images&decorate_category_id=" . $_GET['decorate_category_id']);
  }
  public function updatePriority()
  {
    $arrayId = $_POST['list'];
    for ($i = 0; $i < count($arrayId); $i++) {
      $image = new DecorateImage();
      $image->updatePriority($arrayId[$i], $i + 1);
    }
  }
}
