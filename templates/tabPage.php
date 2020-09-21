<?php
$Category_args = array(
    'taxonomy' => 'product_cat'
);

$all_categories = get_categories($Category_args);
if ($all_categories) {
    ?>
    <!--<div class="wrap">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-1">Manage Settings</a></li>
            <li><a href="#tab-2">Updates</a></li>
            <li><a href="#tab-3">About</a></li>
        </ul>

        <div class="tab-content">
            <div id="tab-1" class="tab-pane active">

            </div>

            <div id="tab-2" class="tab-pane  ">
                <h3>asdsdasd</h3>
            </div>

            <div id="tab-3" class="tab-pane  ">
                <h3>asdasddsdasd</h3>
            </div>
        </div>

    </div>-->


    <div style="margin-top:15px;margin-bottom: 12px" class="container-fluid print-hide">
        <form method="get" action="admin.php">
            <label>
                <select class="category_filter" name="product_cat">
                    <option value="-1">یک دسته بندی را انتخاب کنید</option>
                    <?php
                    foreach ($all_categories as $categoryProduct) {
                        ?>
                        <option value="<?php echo $categoryProduct->cat_name ?>"><?php echo $categoryProduct->cat_name ?></option>
                    <?php } ?>
                </select>
            </label>
        </form>

    </div>

    <?php
}

$args = array(
    'post_type' => 'product',
    'numberposts' => -1,
);

$AllProduct = get_posts($args);
if (!function_exists('wc_get_product')){
    echo '<p class="alert alert-danger">محصولی در سایت وجود ندارد یا افزونه ووکامرس غیرفعال میباشد</p>';
    return false;
}
 ?>
<div class="container-fluid">
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">نام محصول</th>
            <th scope="col">قیمت</th>
            <th scope="col">موجودی</th>
            <th scope="col">تعداد فروش</th>
        </tr>
        </thead>
        <tbody id="js-filter">
        <div style="display: none;z-index: 8888" id="loaderDiv"><img
                    src="<?php echo plugins_url('myPlugin/assets/images/loading-10.gif') ?>" alt=""></div>
        <?php

        foreach ($AllProduct as $key => $product) {
            if (!function_exists('wc_get_product'))
                return false;
            $product_price = wc_get_product($product->ID);
            ?>
            <tr>
                <th style="text-align: right" scope="row"><?php echo $key + 1 ?></th>
                <td><?php echo $product->post_title ?></td>
                <td><?php echo $product_price->get_price(); ?></td>
                <td><?php echo $product_price->get_stock_status() == 'instock' ? 'موجود' : 'ناموجود' ?></td>
                <td><?php echo $product_price->get_total_sales() ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <button onclick="window.print()" style="position: fixed; bottom: 14px; width: 1100px;opacity: .8"
            class="btn btn-block btn-primary btn-lg" id="print-product">پرینت
    </button>
</div>

