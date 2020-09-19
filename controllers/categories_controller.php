<?php
require_once('controllers/base_controller.php');
require_once('models/category.php');

class CategoriesController extends BaseController
{
  function __construct()
  {
    $this->folder = 'categories';
  }

  public function index()
  {
    $category = new Category();
    $list = $category->all();
    $data = array('list' => $list);
    $this->render('index', $data);
  }
  public function create()
  {
    $category = new Category();
    if (isset($_POST['btnAddCategory'])) {
      $data = $category->create($_POST['category_name'], $_POST['status'], $_POST['is_pro'], $_POST['priority']);
      header("Location: ?controller=categories&action=index");
    }
  }
  public function update()
  {
    $category = new Category();
    if (isset($_POST['btnEditCategory'])) {
      $data = $category->update($_POST['ed_category_id'], $_POST['ed_category_name'], $_POST['ed_status'], $_POST['is_pro'], $_POST['ed_priority']);
      header("Location: ?controller=categories&action=index");
    }
  }
  public function delete()
  {
    $category = new Category();
    $data = $category->delete($_GET['category_id']);
    header("Location: ?controller=categories&action=index");
  }
  public function updatePriority()
  {
    $arrayId = $_POST['list'];
    for ($i = 0; $i < count($arrayId); $i++) {
      $category = new Category();
      $category->updatePriority($arrayId[$i], $i + 1);
    }
  }
}
