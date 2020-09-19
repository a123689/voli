<div id="wrapper">
  <?php include('views/layouts/sidebar.php') ?>
  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div class="container-fluid mt-5">
      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <span style="font-size:18px" class="m-0 font-weight-bold text-primary">Font Table Data</span>
          <button class="btn btn-outline-success" style="float: right" data-toggle="modal" data-target="#modalAddFont">Add</button>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="text-align: center">
              <thead style="background: #d7fef4">
                <tr>
                  <th>No.</th>
                  <th>Font Name</th>
                  <th>Font Country</th>
                  <th>Font Url</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tfoot style="background: #d7fef4">
                <tr>
                  <th>No.</th>
                  <th>Font Name</th>
                  <th>Font Country</th>
                  <th>Font Url</th>
                  <th>Action</th>
                </tr>
              </tfoot>
              <tbody>
                <?php for ($i = 0; $i < count($list_font); $i++) { ?>
                  <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= $list_font[$i]['font_name'] ?></td>
                    <td><?= $list_font[$i]['font_country'] ?></td>
                    <td><?= $list_font[$i]['font_url'] ?></td>
                    <td>
                      <button class="btn btn-outline-info mr-2 onEditFont" data-font_id="<?= $list_font[$i]['font_id'] ?>" data-font_name="<?= $list_font[$i]['font_name'] ?>" data-font_url="<?= $list_font[$i]['font_url'] ?>" data-font_country="<?= $list_font[$i]['font_country'] ?>">Edit</button>
                      <button class="btn btn-outline-danger onDeleteFont" data-font_id="<?= $list_font[$i]['font_id'] ?>">Delete</button>
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
    <div class="modal fade" id="modalAddFont" tabindex="-1" role="dialog" aria-labelledby="addFont" aria-hidden="true">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <form action="?controller=fonts&action=create" method="POST" enctype="multipart/form-data">
            <div class="modal-header">
              <h5 class="modal-title" id="addFont">Add new font</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="fontName">Font Name</label>
                  <input type="text" class="form-control" required name="font_name">
                </div>
                <div class="form-group col-md-6">
                  <label for="fontCountry">Font Country</label>
                  <input type="text" class="form-control" required name="font_country">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="inputFile">Font Url</label>
                  <input type="file" class="form-control-file" id="inputFile" name="fileFont">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button class="btn btn-primary" type="submit" name="btnAddFont">Add</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modalEditFont" tabindex="-1" role="dialog" aria-labelledby="lbmodalEditFont" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <form action="?controller=fonts&action=update" method="POST" enctype="multipart/form-data">
            <div class="modal-header">
              <h5 class="modal-title" id="lbmodalEditFont">Edit Font</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="editFontName">Font Name</label>
                  <input type="text" class="form-control" required name="ed_font_name" id="inputEditFontName">
                </div>
                <div class="form-group col-md-6">
                  <label for="edFontCountry">Font Country</label>
                  <input type="text" class="form-control" required name="ed_font_country" id="inputEditFontCountry">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="inputEditFile">Font Url</label>
                  <input type="file" class="form-control-file" id="inputEditFile" name="edFileFont">
                  <input type="text" name="" id="inputEditFontUrl" disabled class="form-control">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <input type="hidden" class="form-control" required name="ed_font_id" id="inputEditId">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button class="btn btn-primary" type="submit" name="btnEditFont">Update</button>
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
    $('.onEditFont').on('click', function() {
      let font_id = this.getAttribute("data-font_id");
      let font_name = this.getAttribute("data-font_name");
      let font_country = this.getAttribute("data-font_country");
      let font_url = this.getAttribute("data-font_url");

      document.getElementById("inputEditId").value = font_id
      document.getElementById("inputEditFontName").value = font_name;
      document.getElementById("inputEditFontCountry").value = font_country;
      document.getElementById("inputEditFontUrl").value = font_url;
      $("#modalEditFont").modal("show");
    });

    $(".onDeleteFont").on("click", function() {
      let font_id = this.getAttribute('data-font_id')
      let category_id = this.getAttribute('data-category_id')
      if (confirm('Bạn có chắc chắn muốn xóa')) {
        window.location.href = "?controller=fonts&action=delete&font_id=" + font_id + "&category_id=" + category_id;
      }
    })
  })
</script>