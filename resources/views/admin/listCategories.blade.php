<!DOCTYPE html>

<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="admin/assets/"
  data-template="vertical-menu-template-free"
>
  <head>
  @include('admin.head')
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
@include('admin.menu')
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->
          @include('admin.navbar')
       

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

   <div class="container" style="margin-top: 20px;">
   <?php
   if($success = session('success')){?>
        <div class="alert alert-success">
    
            <p class="text-center"><?php echo $success;?></p>
        </div>
      <?php  
    }
    
    ?>
   <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">S.No.</th>
      <th scope="col">Category</th>
      <th scope="col">Action</th>
      
    </tr>
  </thead>
  <tbody>
   
    <?php 
$i=1;

foreach ($categories as $key => $value) {?>
       <tr>
       <td><?php echo $i.'.'; $i++; ?></td>
      <td><?php echo($value->category);?> </td>
      <td>
        <div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal" data-id="{{ $value->id }}" data-name="{{ $value->category }}">Edit</button>
      <a onclick="return confirm('Are you sure to delete this record (<?php echo($value->category); ?>)')" href="{{URL('deleteCategory',$value->id)}}" type="submit" class="btn btn-danger">Delete</a>
      
      
      </div>
    </td>
    </tr>
   <?php
   };
   ?>
  </tbody>
</table>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    @csrf
                    <input type="hidden" name="id" id="editId">
                    <div class="form-group">
                        <label for="editName">Category</label>
                        <input type="text" class="form-control" id="editName" name="category">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="updateCategory">Save changes</button>
            </div>
        </div>
    </div>
</div>

    

   </div>
            <!-- / Content -->

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                 
                     </div>
                
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

   
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    @include('admin.script')
    <script>
    $(document).ready(function() {
    var categoryId; // Declare categoryId variable outside of event handlers

    // Handle the "Update" button click to open the modal
    $('body').on('click', 'button[data-target="#editModal"]', function() {
        categoryId = $(this).data('id'); // Set categoryId here
        var categoryName = $(this).data('name');

        $('#editId').val(categoryId);
        $('#editName').val(categoryName);
    });

    // Handle the "Save changes" button click to update the category via AJAX
    $('#updateCategory').on('click', function() {
        var formData = $('#editForm').serialize();
        
        $.ajax({
            url: '/updateCategory/' + categoryId, // Use the categoryId here
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.success) {
                    $('#editModal').modal('hide');
                    // Update the item in the table if needed
                    // You may also reload the page or update the item without reloading
                    alert('Category updated successfully.'); // Show a success message
                    location.reload(); // Reload the page
                }
            },
            error: function(xhr) {
              
            }
        });
    });
});
</script>

     </body>
</html>