<div class="wrap">
    <?php settings_errors();?>

    <form method="post" action="options.php">
        <?php
        settings_fields('plugin_setting');
        do_settings_sections('print_products');
        submit_button();
        ?>
    </form>
</div>