<?php
require_once('controllers/base_controller.php');
require_once('models/font.php');

class FontsController extends BaseController
{
  function __construct()
  {
    $this->folder = 'fonts';
    if (!is_dir('public/fonts')) {
      mkdir('public/fonts');
    }
    $this->font_folder = 'public/fonts/';
  }

  public function index()
  {
    $font = new Font();
    $list = $font->all();
    $data = array('list_font' => $list);
    $this->render('index', $data);
  }
  public function create()
  {
    if (isset($_POST['btnAddFont'])) {
      $font = new Font();
      if ($_FILES['fileFont']['size'] > 0) {
        $target_link = $this->font_folder . $_FILES['fileFont']["name"];
        if (move_uploaded_file($_FILES['fileFont']["tmp_name"], $target_link)) {
          $data = $font->create($_POST['font_name'], $_POST['font_country'], $target_link);
          if (!$data) {
            header("Location: ?controller=pages&action=error");
          } else {
            header("Location: ?controller=fonts");
          }
        } else {
          header("Location: ?controller=pages&action=error");
        }
      } else {
        header("Location: ?controller=pages&action=error");
      }
    } else {
      header("Location: ?controller=pages&action=error");
    }
  }
  public function update()
  {
    $font = new Font();
    if (isset($_POST['btnEditFont'])) {
      if ($_FILES['edFileFont']['size'] == 0) {
        $data = $font->update($_POST['ed_font_id'], $_POST['ed_font_name'], $_POST['ed_font_country']);
        if ($data) {
          header("Location: ?controller=fonts");
        } else {
          header("Location: ?controller=pages&action=error");
        }
      } else {
        $file_name = basename($_FILES["edFileFont"]["name"]);
        $target_file = 'public/fonts/' . $file_name;
        if (move_uploaded_file($_FILES["edFileFont"]["tmp_name"], $target_file)) {
          $data = $font->updateFile($_POST['ed_font_id'], $target_file, $_POST['ed_font_name'], $_POST['ed_font_country']);
          if ($data) {
            header("Location: ?controller=fonts");
          } else {
            header("Location: ?controller=pages&action=error");
          }
        } else {
          header("Location: ?controller=pages&action=error");
        }
      }
    } else {
      header("Location: ?controller=pages&action=error");
    }
  }
  public function delete()
  {
    $font = new Font();
    $data = $font->delete($_GET['font_id']);
    header("Location: ?controller=fonts");
  }
}
