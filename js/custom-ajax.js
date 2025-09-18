jQuery(document).ready(function($) {

  // this is home page newsletter code
    $('#custom-cfdb7-form').on('submit', function(e) {
      e.preventDefault();
      var email = $('#email').val();
      if(email==""){
                  $('#form-response').html('<p>Email address cannot be empty.</p>');
                  return false;
      }
      if(email!="" && /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)==false){
                  $('#form-response').html('<p>Please enter a valid email address.</p>');
                  return false;
      }
      $.ajax({
        url: my_ajax_object.ajax_url,
        type: 'POST',
        data: {
          action: 'insert_cfdb7_email',
          email: email
        },
        success: function(response) {
          $('#form-response').addClass("mail-added-success").html('<p>' + response + '</p>');
          $(".alertmenu-header-form").addClass("d-none");
          $('#custom-cfdb7-form')[0].reset();
        },
        error: function() {
          $('#form-response').html('<p>Something went wrong!</p>');
        }
      });
    });


    $('#custom-cfdb71-form').on('submit', function(e) {
      e.preventDefault();
      var email = $('#emailnew').val();
      var news = $('#newssss').val();
            if(email==""){
                  $('#form-responsed').html('<p>Email address cannot be empty.</p>');
                  return false;
      }
      if(email!="" && /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)==false){
                  $('#form-responsed').html('<p>Please enter a valid email address.</p>');
                  return false;
      }
      $.ajax({
        url: my_ajax_object.ajax_url,
        type: 'POST',
        data: {
          action: 'insert_cfdb7_email',
          email: email,news:news
        },
        success: function(response) {
          $('#form-responsed').addClass("mail-added-success").html('<p>' + response + '</p>');
          $('#custom-cfdb71-form')[0].reset();
        },
        error: function() {
          $('#form-responsed').html('<p>Something went wrong!</p>');
        }
      });
    });
    //end
   // home pahe footer page
    $('#custom-cfdb8-form').on('submit', function(e) {
      e.preventDefault();
      var email = $('#emailsss').val();
      var news= $("#newsss").val();
                  if(email==""){
                  $('#form-responses').html('<p>Email address cannot be empty.</p>');
                  return false;
      }
      if(email!="" && /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)==false){
                  $('#form-responses').html('<p>Please enter a valid email address.</p>');
                  return false;
      }
      $.ajax({
        url: my_ajax_object.ajax_url,
        type: 'POST',
        data: {
          action: 'insert_cfdb7_email',
          email: email,news:news
        },
        success: function(response) {
          $('#form-responses').addClass("mail-added-success").html('<p>' + response + '</p>');
          $('#custom-cfdb8-form')[0].reset();
        },
        error: function() {
          $('#form-responses').html('<p>Something went wrong!</p>');
        }
      });
    });


    $('#custom-cfdb121-form').on('submit', function(e) {
      e.preventDefault();
      var email = $('#home_new_emails').val();
      var news = $("#home_news").val();
      //console.log("dddd",email);
                        if(email==""){
                  $('#form-responses').html('<p>Email address cannot be empty.</p>');
                  return false;
      }
      if(email!="" && /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)==false){
                  $('#form-responses').html('<p>Please enter a valid email address.</p>');
                  return false;
      }
      $.ajax({
        url: my_ajax_object.ajax_url,
        type: 'POST',
        data: {
          action: 'insert_cfdb7_email',
          email: email,news:news
        },
        success: function(response) {
          console.log(response)
          $('#form-responses').addClass("mail-added-success").html('<p>' + response + '</p>');
          $('#custom-cfdb121-form')[0].reset();
        },
        error: function() {
          $('#form-responses').html('<p>Something went wrong!</p>');
        }
      });
    });


    $('#custom-cfdb5250-form').on('submit', function(e) {
      e.preventDefault();
      var email = $('#home_new_emails1').val();
      var news = $("#home_news1").val();
      //console.log("dddd",email);
                        if(email==""){
                  $('.respo').html('<p>Email address cannot be empty.</p>');
                  return false;
      }
      if(email!="" && /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)==false){
                  $('.respo').html('<p>Please enter a valid email address.</p>');
                  return false;
      }
      $.ajax({
        url: my_ajax_object.ajax_url,
        type: 'POST',
        data: {
          action: 'insert_cfdb7_email',
          email: email,news:news
        },
        success: function(response) {
          console.log(response)
          $('.respo').addClass("mail-added-success").html('<p>' + response + '</p>');
          $('#custom-cfdb5250-form')[0].reset();
        },
        error: function() {
          $('.respo').html('<p>Something went wrong!</p>');
        }
      });
    });


    $('#custom-cfdb525-form').on('submit', function(e) {
      e.preventDefault();
      var email = $('#emails_second_new').val();
      var news = $("#new_secound").val();
      //console.log("dddd",email);
                              if(email==""){
                  $('.formresponses').html('<p>Email address cannot be empty.</p>');
                  return false;
      }
      if(email!="" && /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)==false){
                  $('.formresponses').html('<p>Please enter a valid email address.</p>');
                  return false;
      }
      $.ajax({
        url: my_ajax_object.ajax_url,
        type: 'POST',
        data: {
          action: 'insert_cfdb7_email',
          email: email,news:news
        },
        success: function(response) {
          console.log(response)
          $('.formresponses').addClass("mail-added-success").html('<p>' + response + '</p>');
          $('#custom-cfdb525-form')[0].reset();
        },
        error: function() {
          $('.formresponses').html('<p>Something went wrong!</p>');
        }
      });
    });

    



    $('#custom-cfdb81-form').on('submit', function(e) {
      e.preventDefault();
      var email = $('#emails').val();
      var news= $("#newssss").val();
                                    if(email==""){
                  $('#form-responsesw').html('<p>Email address cannot be empty.</p>');
                  return false;
      }
      if(email!="" && /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)==false){
                  $('#form-responsesw').html('<p>Please enter a valid email address.</p>');
                  return false;
      }
      $.ajax({
        url: my_ajax_object.ajax_url,
        type: 'POST',
        data: {
          action: 'insert_cfdb7_email',
          email: email,news:news
        },
        success: function(response) {
          $('#form-responsesw').addClass("mail-added-success").html('<p>' + response + '</p>');
          $('#custom-cfdb81-form')[0].reset();
        },
        error: function() {
          $('#form-responsesw').html('<p>Something went wrong!</p>');
        }
      });
    });


    $('#custom-cfdb7-formss').on('submit', function(e) {
      e.preventDefault();
      var email = $('#emailss').val();
      var news= $("#newsss").val();
                                    if(email==""){
                  $('#form-responsess').html('<p>Email address cannot be empty.</p>');
                  return false;
      }
      if(email!="" && /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)==false){
                  $('#form-responsess').html('<p>Please enter a valid email address.</p>');
                  return false;
      }
      $.ajax({
        url: my_ajax_object.ajax_url,
        type: 'POST',
        data: {
          action: 'insert_cfdb7_email',
          email: email,news:news
        },
        success: function(response) {
          $('#form-responsess').addClass("mail-added-success").html('<p>' + response + '</p>');
          $("#emailss").hide();
          $('#custom-cfdb8-formss')[0].reset();
        },
        error: function() {
          $('#form-responses').html('<p>Something went wrong!</p>');
        }
      });
    });


    $('#custom-cfdb10-form').on('submit', function(e) {
      e.preventDefault();
      var email = $('#emailid').val();
      var news= $("#newss").val();
      console.log("news",news);
                                          if(email==""){
                  $('#form-responsesss').html('<p>Email address cannot be empty.</p>');
                  return false;
      }
      if(email!="" && /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)==false){
                  $('#form-responsesss').html('<p>Please enter a valid email address.</p>');
                  return false;
      }
      $.ajax({
        url: my_ajax_object.ajax_url,
        type: 'POST',
        data: {
          action: 'insert_cfdb7_email',
          email: email,news:news
        },
        success: function(response) {
          $('#form-responsesss').addClass("mail-added-success").html('<p>' + response + '</p>');
          $('#custom-cfdb10-form')[0].reset();
        },
        error: function() {
          $('#form-responsesss').html('<p>Something went wrong!</p>');
        }
      });
    });




  
  $(document).on('submit', '.observer-subscribe-form', function(e) {
    e.preventDefault();

    var $form = $(this); // the current form being submitted
    var $form1 = $(this).parent().parent();
    var email = $form.find('input[name="emailjoin"]').val();
    var listid = $form.find('input[name="listid"]').val();
    //console.log("innerbutton",$form1);

    $.ajax({
      url: my_ajax_object.ajax_url,
      type: 'POST',
      data: {
        action: 'insert_cfdb7_email',
        email: email,
        news: listid
      },
      success: function(response) {
        $form.find('.js-msg-subscribe').removeClass('d-none').html(response);
        $form.find('.variety-love-input-wrap').addClass('d-none');
        $form1.find('.imglove').addClass('d-none');
        $form[0].reset();
      },
      error: function() {
        $form.find('.js-errors-subscribe').removeClass('d-none').html('Something went wrong!');
      }
    });
  });


  $(document).on('submit', '.signup-form-data', function(e) {
    e.preventDefault();

    var $form = $(this); // the current form being submitted
    var email = $form.find('input[name="emailn"]').val();
    var listid = $form.find('input[name="news"]').val();
    //console.log("innerbutton",email);

    $.ajax({
      url: my_ajax_object.ajax_url,
      type: 'POST',
      data: {
        action: 'insert_cfdb7_email',
        email: email,
        news: listid
      },
      success: function(response) {
        $form.find('.form-responsed').removeClass('d-none').html(response);
        $form.find('.justify-content-start').addClass('d-none');
        $form[0].reset();
      },
      error: function() {
        $form.find('.js-errors-subscribe').removeClass('d-none').html('Something went wrong!');
      }
    });
  });


//end

// this is form zoom functinality
      function checkVisibility() {
        const sections = document.querySelectorAll('.loveandfilm-wrapper');
        const windowHeight = window.innerHeight;
        sections.forEach((section) => {
          const rect = section.getBoundingClientRect();
          const visible = rect.top < windowHeight * 0.8 && rect.bottom > windowHeight * 0.2;
          if (visible) {
            section.classList.add('variety-zoom-frm');
          } else {
            section.classList.remove('variety-zoom-frm');
          }
        });
      }
      // Initial check
      checkVisibility();
      // On scroll
      window.addEventListener('scroll', checkVisibility);
      // On resize (in case viewport changes)
      window.addEventListener('resize', checkVisibility);
      // If using AJAX to load more `.loveandfilm-wrapper`
      // Call this after you append HTML:
      window.observeNewWrappers = function () {
        setTimeout(() => {
          checkVisibility(); // Re-run for new content
        }, 200);
      };
// Now this function can use the globally defined observer


document.addEventListener("click", function (e) {
  // Check if the clicked element has the class "social-toggle-btn"
  if (e.target.classList.contains("social-toggle-btn")) {
    const container = e.target.closest("#socialContainer");
    if (container) {
      container.classList.toggle("show");
    }
  }
});


  });
  