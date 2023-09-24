<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="admin/assets/" data-template="vertical-menu-template-free">

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
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                        $i=1;
                        foreach($products as $val){
                        ?><tr>
                                    <td><?php echo $i.'.';$i++ ?></td>
                                    <td><?php echo $val->name; ?></td>
                                    <td><?php echo $val->price; ?></td>
                                    <td><?php echo $val->description; ?></td>
                                    <td> <img src="{{URL('images',$val->image)}}" style="width: 50px;" /></td>
                                    <td><?php echo $val->getCategory->category; ?></td>
                                    <td>
                                        <div>
                                            <form action="{{URL('editProduct')}}" method="post">
                                                <button type="submit" class="btn btn-primary">Edit</button>
                                                <input type="hidden" name="id" value="<?php echo $val->id; ?>">
                                                @csrf
                                            </form>

                                            <a onclick="return confirm('Are you sure to delete this record (<?php echo($val->name); ?>)')"
                                                href="{{URL('deleteProduct',$val->id)}}" type="submit"
                                                class="btn btn-danger">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                                <?php };
                        ?>
                            </tbody>
                        </table>

                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                        <div
                            class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
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