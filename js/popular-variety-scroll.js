jQuery(document).ready(function($) {
    let loading = false;

function loadMorePosts() {
    if (loading) return;

    let container = $('#popular-variety-posts');
    let offset = parseInt(container.attr('data-offset'));
    let limit = parseInt(container.attr('data-limit'));

    loading = true;
    $('#popular-loader').show();

    $.ajax({
        url: popularVarietyAjax.ajaxurl,
        type: 'POST',
        data: {
            action: 'load_more_popular_variety',
            offset: offset,
            limit: limit
        },
        success: function(response) {
            if ($.trim(response)) {
                container.append(response);
                container.attr('data-offset', offset + limit);
            }
            $('#popular-loader').hide();
            loading = false;
        }
    });
}

$(window).scroll(function() {
    console.log("ooooooooooooscroller");
    
    if ( $(window).scrollTop() + $(window).height() >= $(document).height() - 100 ) {
        loadMorePosts();
    }
});
});