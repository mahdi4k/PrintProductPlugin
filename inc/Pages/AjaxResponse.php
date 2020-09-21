<?php


namespace Inc\Pages;


class AjaxResponse
{
    public function register()
    {
        add_action('wp_ajax_nopriv_filter', array($this, 'filter_ajax'));

        add_action('wp_ajax_filter', array($this, 'filter_ajax'));
    }

    public function filter_ajax()
    {
        $category_id = $_POST['category'];

        $args = array(
            'post_type' => 'product',
            'numberposts' => -1,
            'product_cat' => $category_id
        );

        $AllProduct = get_posts($args);

        foreach ($AllProduct as $key => $product) {
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

        <?php

        die();

    }

}