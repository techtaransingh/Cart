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
<form action="" method="post" enctype="multipart/form-data">
    <div>
    <h3>Edit Product</h3>
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
    
    <label for="exampleInputPassword1">Name</label>
    <input type="text" class="form-control"name="name" value="{{$productValues->name}}" id="exampleInputPassword1" >
    @error('name')
                <p class="text-danger">{{ $message }}</p>
            @enderror
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Price</label>
    <input type="text" class="form-control"name="price" value="{{$productValues->price}}" id="exampleInputPassword1" >
    @error('price')
    <p class="text-danger">{{ $message }}</p>
    @enderror
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Description</label>
    <input type="text" class="form-control"name="description" value="{{$productValues->description}}" id="exampleInputPassword1" >
    @error('description')
    <p class="text-danger">{{ $message }}</p>
    @enderror
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Image</label>
    <input type="file" class="form-control" name="image" value="{{$productValues->image}}" id="exampleInputPassword1" >
    @error('image')
    <p class="text-danger">{{ $message }}</p>
    @enderror
    <img src="{{URL('images',$productValues->image)}}" width="80px">
    <p>{{$productValues->image}}</p>
  </div>
  <div style="margin-top: 40px;margin-bottom:20px">
  <select name="category_id" value="{{$productValues->category_id}}" class="form-select" aria-label="Default select example">
  <option selected disabled>Select Category</option>
  <?php foreach($categories as $val){?>
    <option value="{{ $val->id }}" @selected($productValues->category_id == $val->id) > <?php print_r($val->category);    ?></option>
  <?php
    };
    ?>
</select>
@error('category_id')
    <p class="text-danger">{{ $message }}</p>
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