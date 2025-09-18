// this is filter review code
jQuery(document).ready(function ($) {
  function loadPosts(slug) {
    $("#reviews-tab-content").html("<p>Loading...</p>");

    $.post(
      reviews_ajax.ajax_url,
      {
        action: "load_reviews_tab_posts",
        slug: slug,
      },
      function (response) {
        if (response.success) {
          $("#reviews-tab-content").html(response.data);
        } else {
          $("#reviews-tab-content").html("<p>No posts found.</p>");
        }
      }
    );
  }

  // Initial load (Film by default)
  loadPosts("film");
  // Click tab
  $(".review-tabs-nav li").on("click", function (e) {
    e.preventDefault();
    $(".review-tabs-nav li").removeClass("active");
    $(this).addClass("active");
    let slug = $(this).find("a").attr("href");
    loadPosts(slug);
  });
});

//end