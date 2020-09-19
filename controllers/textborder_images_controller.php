<?php
require_once('controllers/base_controller.php');
require_once('models/textborder_images.php');
require_once('models/textborder_category.php');

class TextborderImagesController extends BaseController
{
  function __construct()
  {
    $this->folder = 'textborder_images';
    if (!is_dir('public/textborder_images')) {
      mkdir('public/textborder_images');
    }
    $this->image_folder = 'public/textborder_images/';
  }

  public function index()
  {
    if (isset($_GET['textborder_category_id'])) {
      $image = new TextborderImage();
      $list = $image->getImagebyCategoryId($_GET['textborder_category_id']);
      $data = array('list_image' => $list);
      $this->render('index', $data);
    } else {
      header("Location: ?controller=pages&action=error");
    }
  }
  public function create()
  {
    if (isset($_POST['btnAddTextborderImage'])) {
      $listImage = $_FILES['image_url'];
      $listThumbnail = json_decode($_POST['listThumbnail']);
      $total = count($listImage['name']);
      $category = new TextborderCategory();
      $currentCategory = $category->find($_POST['textborder_category_id']);
      if (!is_dir('public/textborder_images/' . $currentCategory['textborder_category_name'])) {
        mkdir('public/textborder_images/' . $currentCategory['textborder_category_name']);
      }
      $target_dir = 'public/textborder_images/' . $currentCategory['textborder_category_name'] . '/';
      for ($i = 0; $i < $total; $i++) {
        $image = new TextborderImage();
        $filename = basename($listImage["name"][$i]);
        $target_link = 'public/textborder_images/' . $currentCategory['textborder_category_name'] . '/' . $filename;
        if (move_uploaded_file($listImage["tmp_name"][$i], $target_link)) {

          $img = $listThumbnail[$i];
          $img = str_replace('data:image/png;base64,', '', $img);
          $img = str_replace(' ', '+', $img);

          $fileData = base64_decode($img);
          $filePath = $target_dir . 'thumbnail-' . $filename;
          file_put_contents($filePath, $fileData);

          $data = $image->create($target_link, $filePath, $_POST['textborder_category_id']);
          if (!$data) {
            header("Location: ?controller=pages&action=error");
          }
        } else {
          echo "Sorry, there was an error uploading your file.";
          header("Location: ?controller=pages&action=error");
        }
      }
      header("Location: ?controller=textborder_images&textborder_category_id=" . $_POST['textborder_category_id']);
    } else {
      header("Location: ?controller=pages&action=error");
    }
  }
  public function update()
  {
    $image = new TextborderImage();
    if (isset($_POST['btnEditTextborderImage'])) {

      $category = new TextborderCategory();
      $currentCategory = $category->find($_POST['ed_textborder_category_id']);
      if (!is_dir('public/textborder_images/' . $currentCategory['textborder_category_name'])) {
        mkdir('public/textborder_images/' . $currentCategory['textborder_category_name']);
      }
      if ($_FILES['ed_image_url']['size'] == 0) {
        header("Location: ?controller=pages&action=error");
      } else {
        $file_name = basename($_FILES["ed_image_url"]["name"]);
        $target_file = 'public/textborder_images/' . $currentCategory['textborder_category_name'] . '/' . $file_name;
        if (move_uploaded_file($_FILES["ed_image_url"]["tmp_name"], $target_file)) {
          $img = $_POST['editThumbnail'];
          $img = str_replace('data:image/png;base64,', '', $img);
          $img = str_replace(' ', '+', $img);

          $fileData = base64_decode($img);
          $filePath = 'public/textborder_images/' . $currentCategory['textborder_category_name'] . '/' . 'thumbnail-' . $file_name;
          file_put_contents($filePath, $fileData);
          $data = $image->updateFile($_POST['ed_textborder_image_id'], $target_file, $target_file, $_POST['ed_textborder_category_id']);
          if ($data) {
            header("Location: ?controller=textborder_images&textborder_category_id=" . $_POST['ed_textborder_category_id']);
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
    $image = new TextborderImage();
    $data = $image->delete($_GET['textborder_image_id']);
    header("Location: ?controller=textborder_images&textborder_category_id=" . $_GET['textborder_category_id']);
  }
}
