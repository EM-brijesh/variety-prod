jQuery(document).ready(function($){
  let typingTimer;

  function fetch_posts(paged = 1){
    let formData = $('#custom-filters').serialize();
    formData += '&action=filter_posts&paged=' + paged;

    $.ajax({
      url: filter_ajax.ajaxurl,
      type: 'POST',
      data: formData,
      beforeSend: function(){
        $('#results-list').html('<p>Loading...</p>');
      },
      success: function(data){
        const counter = $(data).filter('#results-counter').html() || '';
        const list = $(data).filter('#results-list').html() || '';
        const pagination = $(data).filter('.ajax-pagination').html() || '';

        $('#results-counter').html(counter);
        $('#results-list').html(list);

        if(pagination){
          if($('.ajax-pagination').length){
            $('.ajax-pagination').html(pagination);
          } else {
            $('#results-list').after('<div class="ajax-pagination">' + pagination + '</div>');
          }
        } else {
          $('.ajax-pagination').remove();
        }

        const dynamicIds = ['cat', 'tag', 'author', 'content_type'];
        dynamicIds.forEach(type => {
          const jsonHtml = $(data).filter(`#dynamic-${type}-counts`).html();
          if(jsonHtml){
            try {
              const counts = JSON.parse(jsonHtml);
              updateCounts(type, counts);
            } catch(e){
              console.warn(`Invalid JSON for ${type} counts`, e);
            }
          }
        });
        


      }
    });
  }

  // function updateCounts(type, counts){
  //   let selector = {
  //     cat: ".count-news[data-cat]",
  //     tag: ".count-news[data-tag]",
  //     author: ".count-news[data-author]",
  //     content_type: ".count-news[data-content-type]"
  //   }[type];

  //   if(!selector) return;

  //   let totalVisible = 0;

  //   document.querySelectorAll(selector).forEach(span => {
  //     const idAttr = type === "content_type" ? "data-content-type" : `data-${type}`;
  //     const id = span.getAttribute(idAttr);
  //     const count = counts[id] ?? 0;
  //     span.textContent = count;

  //     const wrapper = span.closest("label");
  //     if(wrapper){
  //       wrapper.style.display = (count === 0 ? "none" : "");
  //       if(count > 0) totalVisible++;
  //     }
  //   });

  //   const sectionWrapper = document.querySelector(`[data-section-wrapper="${type}"]`);
  //   if(sectionWrapper){
  //     sectionWrapper.style.display = (totalVisible === 0 ? "none" : "");
  //   }
  // }


  function updateCounts(type, counts){
    let selector = {
      cat: ".count-news[data-cat]",
      tag: ".count-news[data-tag]",
      author: ".count-news[data-author]",
      content_type: ".count-news[data-content-type]"
    }[type];
  
    if(!selector) return;
  
    let totalVisible = 0;
  
    document.querySelectorAll(selector).forEach(span => {
      const idAttr = type === "content_type" ? "data-content-type" : `data-${type}`;
      const id = span.getAttribute(idAttr);
      const count = counts[id] ?? 0;
      span.textContent = count;
  
      const wrapper = span.closest("label");
      if(wrapper){
        wrapper.style.display = (count === 0 ? "none" : "");
        if(count > 0) totalVisible++;
      }
    });
  
    const sectionWrapper = document.querySelector(`[data-section-wrapper="${type}"]`);
    if(sectionWrapper){
      sectionWrapper.style.display = (totalVisible === 0 ? "none" : "");
    }
  }

  // Filters
  $('#custom-filters input, #custom-filters select').on('change', () => fetch_posts(1));

  // Live search suggestions
  $('#news-search').on('keyup', function(){
    clearTimeout(typingTimer);
    const query = $(this).val().trim();

    if(query.length < 2){ 
      $('#search-suggestions').empty().hide();
      return;
    }

    typingTimer = setTimeout(() => {
      $.ajax({
        url: filter_ajax.ajaxurl,
        type: 'POST',
        data: {
          action: 'get_search_suggestions',
          q: query
        },
        success: function(data){
          $('#search-suggestions').html(data).show();
        }
      });
    }, 200);
  });

  // When suggestion clicked
  $(document).on('click', '.suggestion-item', function(){
    const text = $(this).text();
    $('#news-search').val(text);
    $('#search-suggestions').empty().hide();
    fetch_posts(1);
  });

  // Pagination
  $(document).on('click', '.ajax-pagination a', function(e){
    e.preventDefault();
    const paged = $(this).data('page');
    if(paged){
      fetch_posts(paged);
      $('html, body').animate({ scrollTop: $('#results-list').offset().top - 100 }, 400);
    }
  });

  // Clear filters
  $('#clear-filters').on('click', function(){
    $('#custom-filters input[type="checkbox"]').prop('checked', false);
    $('#custom-filters select').prop('selectedIndex', 0);
    $('#news-search').val('');
    fetch_posts(1);
  });

  // Initial fetch
  fetch_posts(1);
});



jQuery(document).ready(function($){

  let typingTimer;

  // Live search typing
  $('#news-search').on('keyup', function(){
    clearTimeout(typingTimer);
    const query = $(this).val().trim();

    if(query.length < 2){ 
      $('#search-suggestions').empty().hide();
      return;
    }

    typingTimer = setTimeout(() => {
      $.ajax({
        url: filter_ajax.ajaxurl,
        type: 'POST',
        data: {
          action: 'get_search_suggestions',
          q: query
        },
        success: function(data){
          if(data.trim() !== ''){
            $('#search-suggestions').html(data).show();
          } else {
            $('#search-suggestions').empty().hide();
          }
        }
      });
    }, 200);
  });

  // When suggestion clicked → fill input & run fetch
  $(document).on('click', '.suggestion-item', function(){
    const text = $(this).text();
    $('#news-search').val(text);
    $('#search-suggestions').empty().hide();
    fetch_posts(1); // your existing function
  });

});