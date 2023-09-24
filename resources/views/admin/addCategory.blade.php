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
<form action="{{URL('addCategory')}}" method="post">
<div>
    <h3>Add Category</h3>
    </div>
   
    <?php

    if($success = session('success')){?>
        <div class="alert alert-success">
    
            <p class="text-center"><?php echo $success;?></p>
        </div>
      <?php  
    }

    ?>
    <div class="form-group">
    <label for="exampleInputPassword1">Category</label>
    <input type="text" class="form-control"name="category" id="categoryInput" >
    @error('category')
    <p class="text-danger">{{$message}}</p>
    @enderror
  </div>
@csrf
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
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
     </body>
</html>