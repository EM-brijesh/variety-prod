jQuery(document).ready(function ($) {
    function fetchNews(search = '') {
        $.ajax({
            url: newsSearchAjax.ajaxurl,
            method: 'POST',
            data: {
                action: 'search_news_posts',
                search: search,
            },
            success: function (response) {
                $('#news-results').html(response);
            }
        });
    }


    $(document).on("click","#searchBnt",function(){
        let search = $("#news-search").val();
        //console.log("ssss",search1);
        window.location.href=`https://variety.amaruventures.in/search-listing/?q=${search}`;
    })


    $(document).on("keypress", "#data-search-form-3", function (e) {
        if (e.which === 13) { // 13 = Enter key
            let search = $(this).val();
            window.location.href = `https://variety.amaruventures.in/search-listing/?q=${search}`;
        }
    });

    $(document).on("keypress", "#news-search", function (e) {
        if (e.which === 13) { // 13 = Enter key
            let search = $(this).val();
            window.location.href = `https://variety.amaruventures.in/search-listing/?q=${search}`;
        }
    });

    $(document).on("click",".search404",function(){
        let search = $("#search_404").val();
        //console.log("ssss",search1);
        window.location.href=`https://variety.amaruventures.in/search-listing/?q=${search}`;
    })


    
// this searching

$(document).on("click", "#searchbtn", function () {
    console.log("dfgfdgdfiiii");
    var search1 = $("#data-search-form-3").val().trim();
    
    if (search1 !== '') {
        window.location.href = '/search-listing/?q=' + encodeURIComponent(search1);
    }else{
        window.location.href = '/search-listing/?q=' + encodeURIComponent(search1);
    }
});

$(document).on("click", "#searchbtndd", function () {
   
    var search1 = $("#data-search-forms").val().trim();
    console.log("dfgfdgdfiiii",search1);
    if (search1 !== '') {
        window.location.href = '/search-listing/?q=' + encodeURIComponent(search1);
    }else{
        window.location.href = '/search-listing/?q=' + encodeURIComponent(search1);
    }
});

$(document).on("keypress", "#data-search-forms", function (e) {
    if (e.which === 13) { // 13 = Enter key
        let search = $(this).val();
        window.location.href = `https://variety.amaruventures.in/search-listing/?q=${search}`;
    }
});

//end

});



