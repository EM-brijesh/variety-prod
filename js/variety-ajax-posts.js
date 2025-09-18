
var page = 2;
var loading = false;
jQuery(window).scroll(function () {
    if (jQuery(window).scrollTop() + jQuery(window).height() >= jQuery(document).height() - 100 && !loading) {
        loading = true;
        jQuery.ajax({
            type: 'POST',
            url: variety_ajax_object.ajax_url,
            data: {
                action: 'load_variety_posts',
                nonce: variety_ajax_object.nonce,
                page: page
            },
            success: function (response) {
                if (response.trim() !== '') {
                    jQuery('#variety-posts-container').append(response);
                    page++;
                    loading = false;
                    //observeNewForms();
                    //console.log("fsdfdsfdsds",observeNewForms())
                } else {
                    jQuery('#variety-loader').hide();
                }
            }
        });
    }
});

