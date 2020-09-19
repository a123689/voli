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
      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <span style="font-size:18px" class="m-0 font-weight-bold text-primary">Textborder Categories Data</span>
          <button class="btn btn-outline-success" style="float: right" data-toggle="modal" data-target="#modalAddTextborderCategory">Add</button>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="text-align: center">
              <thead style="background: #d7fef4">
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tfoot style="background: #d7fef4">
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Action</th>
                </tr>
              </tfoot>
              <tbody id="sortTextborderCategory">
                <?php for ($i = 0; $i < count($list); $i++) { ?>
                  <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= $list[$i]['textborder_category_name'] ?></td>
                    <td>
                      <a href="?controller=textborder_images&textborder_category_id=<?= $list[$i]['textborder_category_id'] ?>">
                        <button class="btn btn-outline-success mr-2">Textborder Images</button></a>
                      <button class="btn btn-outline-info mr-2 onEditTextborderCategory" data-textborder_category_id="<?= $list[$i]['textborder_category_id'] ?>" data-textborder_category_name="<?= $list[$i]['textborder_category_name'] ?>">Edit</button>
                      <button class="btn btn-outline-danger onDeleteTextborderCategory" data-textborder_category_id="<?= $list[$i]['textborder_category_id'] ?>">Delete</button>
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
    <div class="modal fade" id="modalAddTextborderCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="?controller=textborder_categories&action=create" method="POST">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add new textborder category</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="inputName">Name </label>
                  <input type="text" class="form-control" required name="textborder_category_name" id="inputName" placeholder="input name text border category">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button class="btn btn-primary" type="submit" name="btnAddTextborderCategory">Add</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modalEditTextborderCategory" tabindex="-1" role="dialog" aria-labelledby="editTextborderCategory" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="?controller=textborder_categories&action=update" method="POST">
            <div class="modal-header">
              <h5 class="modal-title" id="editTextborderCategory">Edit textborder category</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" class="form-control" required name="ed_textborder_category_id" id="inputEditId">
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="inputEditName">Name </label>
                  <input type="text" class="form-control" required name="ed_textborder_category_name" id="inputEditName" placeholder="input name textborder_category">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button class="btn btn-primary" type="submit" name="btnEditTextborderCategory">Update</button>
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
    $('.onEditTextborderCategory').on('click', function() {
      let textborder_category_id = this.getAttribute("data-textborder_category_id");
      let textborder_category_name = this.getAttribute("data-textborder_category_name");

      document.getElementById("inputEditId").value = textborder_category_id
      document.getElementById("inputEditName").value = textborder_category_name
      $("#modalEditTextborderCategory").modal("show");
    });

    $('.onDeleteTextborderCategory').on('click', function() {
      let textborder_category_id = this.getAttribute("data-textborder_category_id");
      if (confirm('Bạn có chắc chắn muốn xóa')) {
        window.location.href = "?controller=textborder_categories&action=delete&textborder_category_id=" + textborder_category_id;
      }
    })
  })
</script>