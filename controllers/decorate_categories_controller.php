<?php
require_once('controllers/base_controller.php');
require_once('models/decorate_category.php');

class DecorateCategoriesController extends BaseController
{
  function __construct()
  {
    $this->folder = 'decorate_categories';
  }

  public function index()
  {
    $category = new DecorateCategory();
    $list = $category->all();
    $data = array('list' => $list);
    $this->render('index', $data);
  }
  public function create()
  {
    $category = new DecorateCategory();
    if (isset($_POST['btnAddDecorateCategory'])) {
      $data = $category->create($_POST['decorate_category_name'], $_POST['status'], $_POST['is_pro'], $_POST['priority']);
      header("Location: ?controller=decorate_categories");
    }
  }
  public function update()
  {
    $category = new DecorateCategory();
    if (isset($_POST['btnEditDecorateCategory'])) {
      $data = $category->update($_POST['ed_decorate_category_id'], $_POST['ed_decorate_category_name'], $_POST['ed_status'], $_POST['ed_is_pro'], $_POST['ed_priority']);
      header("Location: ?controller=decorate_categories&action=index");
    }
  }
  public function delete()
  {
    $category = new DecorateCategory();
    $data = $category->delete($_GET['decorate_category_id']);
    header("Location: ?controller=decorate_categories&action=index");
  }
  public function updatePriority()
  {
    $arrayId = $_POST['list'];
    for ($i = 0; $i < count($arrayId); $i++) {
      $category = new DecorateCategory();
      $category->updatePriority($arrayId[$i], $i + 1);
    }
  }
}
