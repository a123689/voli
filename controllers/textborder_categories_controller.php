<?php
require_once('controllers/base_controller.php');
require_once('models/textborder_category.php');

class TextborderCategoriesController extends BaseController
{
  function __construct()
  {
    $this->folder = 'textborder_categories';
  }

  public function index()
  {
    $category = new TextborderCategory();
    $list = $category->all();
    $data = array('list' => $list);
    $this->render('index', $data);
  }
  public function create()
  {
    $category = new TextborderCategory();
    if (isset($_POST['btnAddTextborderCategory'])) {
      $data = $category->create($_POST['textborder_category_name']);
      header("Location: ?controller=textborder_categories");
    }
  }
  public function update()
  {
    $category = new TextborderCategory();
    if (isset($_POST['btnEditTextborderCategory'])) {
      $data = $category->update($_POST['ed_textborder_category_id'], $_POST['ed_textborder_category_name']);
      header("Location: ?controller=textborder_categories&action=index");
    }
  }
  public function delete()
  {
    $category = new TextborderCategory();
    $data = $category->delete($_GET['textborder_category_id']);
    header("Location: ?controller=textborder_categories&action=index");
  }
}
