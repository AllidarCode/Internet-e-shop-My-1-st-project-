    <?php
    require_once('files/functions.php');
    protected_area();
    
    $row = db_select('categories', 'parent_id != 0 ');
    $categories = [];
    
    foreach ($rows as $val) {
        $categories [$val['id']] = $val['name'];
    }
    
    if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
        $_SESSION['form']['value'] = $_POST;
        
        $imgs = upload_images($_FILES);
        $date['name'] = $_POST['name'];
        $date['buying_price'] = $_POST['buying_price'];
        $date['price'] = $_POST['price'];
        $date['category_id'] = $_POST['category_id'];
        $date['description'] = $_POST['description'];
        $date['photos'] = json_decode($imgs);
        $date['user_id'] = $_SESSION['user']['id'];
        
        if (db_insert('products', $data)) {
            alert('success', 'Product created successfully.');
            header('Location: admin-products.php');
            unset($_SESSION['form']);
        } else {
            alert('danger', 'Failed to create product, please try again.');
            header('Location: admin-products-add.php');
        }
        die();
    }
    
    require_once('files/header.php');
?>

<div class="page-title-overlap bg-dark pt-4">
    <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">
                    <li class="breadcrumb-item"><a class="text-nowrap" href="index.php"><i class="ci-home"></i>Home</a></li>
                    <li class="breadcrumb-item text-nowrap"><a href="#">Account</a>
                    </li>
                    <li class="breadcrumb-item text-nowrap active" aria-current="page">Orders history
                    </li>
                </ol>
            </nav>
        </div>
        <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
            <h1 class="h3 text-light mb-0">Products add</h1>
        </div>
    </div>
</div>
<div class="container pb-5 mb-2 mb-md-4">
    <div class="row">
        <?php
            require_once('/files/account-sidebar.php'); ?>
        <!-- Content  -->
        <section class="col-lg-8 pt-lg-4 pb-4 mb-3">
            <div class="pt-2 px-4 ps-lg-0 pe-xl-5">
                <!-- Title-->
                <div
                    class="d-sm-flex flex-wrap justify-content-between align-items-center pb-2">
                    <h2 class="h3 py-2 me-2 text-center text-sm-start">Add New Product</h2>
                    <div class="py-2">
                        <select class="form-select me-2" id="unp-category">
                            <option>Select category</option>
                            <option>Photos</option>
                            <option>Graphics</option>
                            <option>UI Design</option>
                            <option>Web Themes</option>
                            <option>Fonts</option>
                            <option>Add-Ons</option>
                        </select>
                    </div>
                </div>
                <form action="admin-products-add.php" method="POST" method="POST" enctype="multipart/form-data">
                    <div class="mb-3 pb-2">
                        <div class="row">
                            <div class="col-md-12">
                                <?= text_input([
                                    'name' => 'name',
                                ]) ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <?= select_input([
                                    'name' => 'category_id',
                                    'label' => 'Category',
                                ], $categories) ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mt-2">
                                <?= text_input([
                                    'name'  => 'Buying price',
                                    'label' => 'Buying price',
                                ]) ?>
                            </div>
                            <div class="col-md-6 mt-2">
                                <?= text_input([
                                    'name'  => 'price',
                                    'label' => 'Selling price',
                                ]) ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mt-3">
                                <div class="form-group">
                                    <label for="photo">Product photo 1</label>
                                    <input class="form-control" name="photo_1" type="file" accept=".jpg,.jperg,.png">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mt-3">
                                    <label for="photo">Product photo 2</label>
                                    <input class="form-control" name="photo_2" type="file" accept=".jpg,.jperg,.png">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mt-3">
                                <div class="form-group">
                                    <label for="photo">Product photo 3</label>
                                    <input class="form-control" name="photo_3" type="file" accept=".jpg,.jperg,.png">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mt-3">
                                    <label for="photo">Product photo 4</label>
                                    <input class="form-control" name="photo_4" type="file" accept=".jpg,.jperg,.png">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mt-3">
                                <div class="form-group">
                                    <label for="photo">Product photo 4</label>
                                    <input class="form-control" name="photo_5" type="file" accept=".jpg,.jperg,.png">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mt-3">
                                    <label for="photo">Product photo 6</label>
                                    <input class="form-control" name="photo_6" type="file" accept=".jpg,.jperg,.png">
                                </div>
                            </div>
                        </div>
                        <div class="row mtp-4">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="description">description</label><textarea name="description" id="description" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <!-- description -->
                    </div>
                    <button class="btn btn-primary d-block w-100" type="submit">
                        <i class="ci-cloud-upload fs-lg me-2"></i>SUBMIT
                    </button>
                </form>
            </div>
        </section>
    </div>
</div>

<?php
    require_once('files/footer.php');
?>