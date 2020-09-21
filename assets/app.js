(function ($) {

    $(document).ready(function () {
        $('.category_filter').on('change'  ,function (e) {
            e.preventDefault();

            var category = $(this).val();

            $.ajax({
                url:wpAjax.ajaxUrl,
                data : {action : 'filter', category: category},
                type:'post',
                beforeSend: function() {
                    $("#loaderDiv").show();
                },
                success:function (result) {
                    $("#loaderDiv").hide();
                    $('#js-filter').html(result);
                },
                error : function (result) {
                    // console.warn(result)
                }
            })

        })
    })

})(jQuery)