<style>
  .switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
  }

  .switch input {
    opacity: 0;
    width: 0;
    height: 0;
  }

  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
  }

  .slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
  }

  input:checked+.slider {
    background-color: #2196F3;
  }

  input:focus+.slider {
    box-shadow: 0 0 1px #2196F3;
  }

  input:checked+.slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
  }

  /* Rounded sliders */
  .slider.round {
    border-radius: 34px;
  }

  .slider.round:before {
    border-radius: 50%;
  }
</style>
<div id="wrapper">
  <?php include('views/layouts/sidebar.php') ?>
  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div class="container-fluid mt-5">
      <!-- Page Heading -->
      <h1 class="h3 mb-2 text-gray-800">Categories Table</h1>
      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <span style="font-size:18px" class="m-0 font-weight-bold text-primary">Categories Data</span>
          <button class="btn btn-outline-success" style="float: right" data-toggle="modal" data-target="#modalAddCategory">Add</button>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="text-align: center">
              <thead style="background: #d7fef4">
                <tr>
                  <th>Priority</th>
                  <th>Name</th>
                  <th>Status</th>
                  <th>Is Pro</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tfoot style="background: #d7fef4">
                <tr>
                  <th>Priority</th>
                  <th>Name</th>
                  <th>Status</th>
                  <th>Is Pro</th>
                  <th>Action</th>
                </tr>
              </tfoot>
              <tbody id="sortCategory">
                <?php for ($i = 0; $i < count($list); $i++) { ?>
                  <tr categoryid="<?= $list[$i]['category_id'] ?>">
                    <td id="category-<?= $list[$i]['category_id'] ?>"><?= $list[$i]['priority'] ?></td>
                    <td><?= $list[$i]['category_name'] ?></td>
                    <td>
                      <label class="switch">
                        <input type="checkbox" disabled <?= $list[$i]['status'] ? "checked" : "" ?>>
                        <span class="slider round"></span>
                      </label>
                    </td>
                    <td>
                      <label class="switch">
                        <input type="checkbox" disabled <?= $list[$i]['is_pro'] ? "checked" : "" ?>>
                        <span class="slider round"></span>
                      </label>
                    </td>
                    <td>
                      <a href="?controller=images&category_id=<?= $list[$i]['category_id'] ?>">
                        <button class="btn btn-outline-success mr-2">Images</button></a>
                      <button class="btn btn-outline-info mr-2 onEditCategory" data-category_id="<?= $list[$i]['category_id'] ?>" data-category_name="<?= $list[$i]['category_name'] ?>" data-status="<?= $list[$i]['status'] ?>" data-is_pro="<?= $list[$i]['is_pro'] ?>" data-priority="<?= $list[$i]['priority'] ?>">Edit</button>
                      <button class="btn btn-outline-danger onDeleteCategory" data-category_id="<?= $list[$i]['category_id'] ?>">Delete</button>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
    <!-- /.container-fluid -->
    <div class="modal fade" id="modalAddCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="?controller=categories&action=create" method="POST">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add new category</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="inputName">Name </label>
                  <input type="text" class="form-control" required name="category_name" id="inputName" placeholder="input name category">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputStatus">Status</label>
                  <select id="inputStatus" class="form-control" name="status">
                    <option value="1" selected>On</option>
                    <option value="0">Off</option>
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label for="inputIsPro">Is Pro</label>
                  <select id="inputIsPro" class="form-control" name="is_pro">
                    <option value="1" selected>Yes</option>
                    <option value="0">No</option>
                  </select>
                </div>
                <div class="form-group col-md-6" style="display: none">
                  <label for="inputPriority">Priority</label>
                  <input type="text" value="<?= count($list) + 1 ?>" class="form-control" required name="priority" id="inputPriority" placeholder="input priority">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button class="btn btn-primary" type="submit" name="btnAddCategory">Add</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modalEditCategory" tabindex="-1" role="dialog" aria-labelledby="editCategory" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="?controller=categories&action=update" method="POST">
            <div class="modal-header">
              <h5 class="modal-title" id="editCategory">Edit category</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" class="form-control" required name="ed_category_id" id="inputEditId">
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="inputEditName">Name </label>
                  <input type="text" class="form-control" required name="ed_category_name" id="inputEditName" placeholder="input name category">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputEditStatus">Status</label>
                  <select id="inputEditStatus" class="form-control" name="ed_status">
                    <option value="1">On</option>
                    <option value="0">Off</option>
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label for="inputEditIsPro">Is Pro</label>
                  <select id="inputEditIsPro" class="form-control" name="ed_is_pro">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                  </select>
                </div>
                <div class="form-group col-md-6" style="display: none">
                  <label for="inputEditPriority">Priority</label>
                  <input type="number" class="form-control" required name="ed_priority" id="inputEditPriority" placeholder="input priority category">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button class="btn btn-primary" type="submit" name="btnEditCategory">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- End of Main Content -->
    <!-- Footer -->
    <footer class="sticky-footer bg-white">
      <div class="container my-auto">
        <div class="copyright text-center my-auto">
          <span>Copyright &copy; VOLIO 2020</span>
        </div>
      </div>
    </footer>
    <!-- End of Footer -->
  </div>
  <!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->
<script>
  $(document).ready(function() {
    $('.onEditCategory').on('click', function() {
      let category_id = this.getAttribute("data-category_id");
      let category_name = this.getAttribute("data-category_name");
      let status = this.getAttribute("data-status");
      let is_pro = this.getAttribute("data-is_pro");
      let priority = this.getAttribute("data-priority");

      document.getElementById("inputEditId").value = category_id
      document.getElementById("inputEditName").value = category_name
      document.getElementById("inputEditStatus").value = status
      document.getElementById("inputEditIsPro").value = is_pro
      document.getElementById("inputEditPriority").value = priority;
      $("#modalEditCategory").modal("show");
    });

    $('.onDeleteCategory').on('click', function() {
      let category_id = this.getAttribute("data-category_id");
      if (confirm('Bạn có chắc chắn muốn xóa')) {
        window.location.href = "?controller=categories&action=delete&category_id=" + category_id;
      }
    })

    $("#sortCategory").sortable({
      update: function(event, ui) {
        let rows = event.target.rows;
        let arraySort = [];
        for (let index = 0; index < rows.length; index++) {
          let element = rows[index];
          arraySort.push(element.getAttribute("categoryid"));
        }
        $.ajax({
          url: "?controller=categories&action=updatePriority",
          method: "POST",
          data: {
            list: arraySort
          },
          success: function(result) {
            for (let index = 0; index < rows.length; index++) {
              rows[index].cells[0].innerHTML = index + 1
            }
          }
        })
      }
    });
  })
</script>