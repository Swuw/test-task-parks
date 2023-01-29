
jQuery(function($) {
    $(document).on('click', '.categories,.pagination', function(e) {
        e.preventDefault();

        let thisbutton = $(this);
        let activeCategory = $('.green-hover');
        let ajax_url = '/wp-admin/admin-ajax.php';

        if(thisbutton.hasClass('categories')){
            var id = thisbutton.attr('data-id');
            var paged = 1;

            $.ajax({
                type: 'POST',
                url: ajax_url,
                data: {
                    action: 'post_park_load',
                    category_id: id,
                    paged: paged
                },
                beforeSend: function () {
                    activeCategory.removeClass('green-hover');
                    thisbutton.addClass('loading');
                },
                success: function (data) {
                    thisbutton.removeClass('loading');
                    $(".cards-container").empty();
                    thisbutton.addClass('green-hover');
                    $(".cards-container").append(data);
                },
                complete: function () {
                    // $('.loading').remove();
                }
            });
        } else if(thisbutton.hasClass('pagination')){
            var id = activeCategory.attr('data-id');
            var paged = thisbutton.attr('data-page');

            $.ajax({
                type: 'POST',
                url: ajax_url,
                data: {
                    action: 'post_park_load',
                    category_id: id,
                    paged: paged
                },
                beforeSend: function () {

                    thisbutton.addClass('loading');
                },
                success: function (data) {
                    thisbutton.removeClass('loading');
                    $(".cards-container").empty();

                    $(".cards-container").append(data);
                },
                complete: function () {
                    // $('.loading').remove();
                }
            });
        }

    });
});
