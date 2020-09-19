<div id="wrapper">
  <?php include('views/layouts/sidebar.php') ?>
  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div class="container-fluid mt-5">
      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <span style="font-size:18px" class="m-0 font-weight-bold text-primary">Textborder Image Table Data</span>
          <button class="btn btn-outline-success" style="float: right" data-toggle="modal" data-target="#modalAddTextborderImage">Add</button>
        </div>
        <div class="card-body">
          <div style="position:absolute; top:100000px">
            <img v-for="(image, index) in listImage" :src="image" alt="" :id="'image'+index">
            <img :src="editImage" alt="" id="editImage">
            <canvas></canvas>
          </div>
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="text-align: center">
              <thead style="background: #d7fef4">
                <tr>
                  <th>No</th>
                  <th>Textborder Image Url</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tfoot style="background: #d7fef4">
                <tr>
                  <th>No</th>
                  <th>Textborder Image Url</th>
                  <th>Action</th>
                </tr>
              </tfoot>
              <tbody id="sortTextborderImage">
                <?php for ($i = 0; $i < count($list_image); $i++) { ?>
                  <tr>
                    <td ><?= $i+1 ?></td>
                    <td><?= $list_image[$i]['image_url'] ?></td>
                    <td>
                      <button class="btn btn-outline-info mr-2 onEditTextborderImage" data-textborder_image_id="<?= $list_image[$i]['textborder_image_id'] ?>" data-image_url="<?= $list_image[$i]['image_url'] ?>" data-textborder_category_id="<?= $_GET['textborder_category_id'] ?>">Edit</button>
                      <button class="btn btn-outline-danger onDeleteTextborderImage" data-textborder_image_id="<?= $list_image[$i]['textborder_image_id'] ?>" data-textborder_category_id="<?= $_GET['textborder_category_id'] ?>">Delete</button>
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
    <div class="modal fade" id="modalAddTextborderImage" tabindex="-1" role="dialog" aria-labelledby="addTextborderImage" aria-hidden="true">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <form action="?controller=textborder_images&action=create" method="POST" enctype="multipart/form-data">
            <div class="modal-header">
              <h5 class="modal-title" id="addTextborderImage">Add new image</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div v-if="isLoading" class="lds-roller">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
              </div>
              <div class="form-row" style="display: none">
                <div class="form-group col-md-6 d-none">
                  <input value="<?= $_GET['textborder_category_id'] ?>" type="hidden" class="form-control" required name="textborder_category_id">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="inputFile">Textborder Image Url</label>
                  <input type="file" class="form-control-file" id="inputFile" @change="onFileChange" multiple name="image_url[]">
                  <textarea hidden name="listThumbnail" id="" cols="30" rows="10">{{listThumbnail}}</textarea>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button class="btn btn-primary" type="submit" name="btnAddTextborderImage" v-if="isDone">Add</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modalEditTextborderImage" tabindex="-1" role="dialog" aria-labelledby="lbmodalEditTextborderImage" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <form action="?controller=textborder_images&action=update" method="POST" enctype="multipart/form-data">
            <div class="modal-header">
              <h5 class="modal-title" id="lbmodalEditTextborderImage">Edit TextborderImage</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div v-if="isLoading" class="lds-roller">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
              </div>
              <div class="form-row" style="display: none">
                <div class="form-group col-md-6">
                  <input type="number" class="form-control" required name="ed_textborder_category_id" id="inputEditCategoryId">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="inputEditFile">Textborder Image Url</label>
                  <input type="text" class="form-control" disabled name="" id="inputEditFileView">
                  <input type="file" class="form-control-file" id="inputEditFile" @change="onChangeImage" name="ed_image_url">
                  <textarea hidden name="editThumbnail" id="" cols="30" rows="10">{{editThumbnail}}</textarea>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <input type="hidden" class="form-control" required name="ed_textborder_image_id" id="inputEditId">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button class="btn btn-primary" type="submit" v-if="isDone" name="btnEditTextborderImage">Update</button>
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
    $('.onEditTextborderImage').on('click', function() {
      let textborder_image_id = this.getAttribute("data-textborder_image_id");
      let image_url = this.getAttribute("data-image_url");
      let textborder_category_id = this.getAttribute("data-textborder_category_id");

      document.getElementById("inputEditId").value = textborder_image_id
      document.getElementById("inputEditFileView").value = image_url;
      document.getElementById("inputEditCategoryId").value = textborder_category_id;
      $("#modalEditTextborderImage").modal("show");
    });

    $(".onDeleteTextborderImage").on("click", function() {
      let textborder_image_id = this.getAttribute('data-textborder_image_id')
      let textborder_category_id = this.getAttribute('data-textborder_category_id')
      if (confirm('Bạn có chắc chắn muốn xóa')) {
        window.location.href = "?controller=textborder_images&action=delete&textborder_image_id=" + textborder_image_id + "&textborder_category_id=" + textborder_category_id;
      }
    })
  })
  let vm = new Vue({
    el: "#wrapper",
    data: {
      listImage: [],
      listThumbnail: [],
      isDone: false,
      isLoading: false,
      editThumbnail: "",
      editImage: ""
    },
    methods: {
      onFileChange(e) {
        this.isLoading = true;
        let self = this;
        self.listImage = [];
        self.listThumbnail = [];
        var files = e.target.files;
        if (files) {
          var files_count = files.length;
          for (let i = 0; i < files_count; i++) {
            let canvas = document.querySelector('canvas');
            canvas.height = canvas.width = 0;
            var reader = new FileReader();
            reader.onload = function(e) {
              self.listImage.push(e.target.result);
              setTimeout(() => {
                let imageElement = document.getElementById('image' + i)
                var context = canvas.getContext('2d');
                var imgwidth = imageElement.offsetWidth;
                var imgheight = imageElement.offsetHeight;

                //try max width first...
                let ratio = 175 / imgwidth;
                let new_w = 175;
                let new_h = imgheight * ratio;

                //if that didn't work
                if (new_h > 175) {
                  ratio = 175 / imgheight;
                  new_h = 175;
                  new_w = imgwidth * ratio;
                }

                canvas.width = new_w;
                canvas.height = new_h;
                context.drawImage(
                  imageElement, 0, 0, imgwidth, imgheight, 0, 0, new_w, new_h
                );
                let dataURL = canvas.toDataURL();
                self.listThumbnail.push(dataURL);
                if (self.listThumbnail.length == files.length) {
                  self.isDone = true;
                  self.isLoading = false
                } else {
                  self.isDone = false;
                }
              }, 200);
            }
            reader.readAsDataURL(files[i]);
          }
        }
        console.log(this.listImage);
        console.log(this.listThumbnail);
      },
      onChangeImage(e) {
        this.isLoading = true;
        this.editThumbnail = "";
        let self = this;
        var files = e.target.files;
        if (files) {
          let canvas = document.querySelector('canvas');
          canvas.height = canvas.width = 0;
          var reader = new FileReader();
          reader.onload = function(e) {
            self.editImage = e.target.result;
            setTimeout(() => {
              let imageElement = document.getElementById('editImage')
              var context = canvas.getContext('2d');
              var imgwidth = imageElement.offsetWidth;
              var imgheight = imageElement.offsetHeight;

              //try max width first...
              let ratio = 175 / imgwidth;
              let new_w = 175;
              let new_h = imgheight * ratio;

              //if that didn't work
              if (new_h > 175) {
                ratio = 175 / imgheight;
                new_h = 175;
                new_w = imgwidth * ratio;
              }

              canvas.width = new_w;
              canvas.height = new_h;
              context.drawImage(
                imageElement, 0, 0, imgwidth, imgheight, 0, 0, new_w, new_h
              );
              let dataURL = canvas.toDataURL();
              self.editThumbnail = dataURL;
              if (self.editThumbnail) {
                self.isDone = true;
                self.isLoading = false
              } else {
                self.isDone = false;
              }
            }, 200);
          }
          reader.readAsDataURL(files[0]);
        }
      },
    }
  })
</script>