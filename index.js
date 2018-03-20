$(document).ready(function(){

  
  //Bootstrap scrollspy
    
  if ($(window).width() >= 766) {
    
    $('body').scrollspy({ target: '#navbar', offset: 60 });
    
  } else {
    
    $('body').scrollspy({ target: '#navbar', offset: 178 });
    
  }

  //Add smooth scrolling on all links inside the navbar
  $("#navbar a").on('click', function(event) {

    //Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {

      //Prevent default anchor click behavior
      event.preventDefault();

      //Store hash
      var hash = this.hash;

      //Using jQuery's animate() method to add smooth page scroll
      //The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      

      if ($(window).width() >= 766) {
    
        $('html, body').animate({

          scrollTop: $(hash).offset().top - 60       

        }, 800, function(){

        //Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;

        });
        
      } else {
    
        $('html, body').animate({

          scrollTop: $(hash).offset().top - 178     

        }, 800, function(){

        //Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;

        });
        
      }

    } // End if

  });
  

  //Set navbar to open after landing page

    var window_height = $(window).height();

    $(window).scroll(function () {

      if ($(this).scrollTop() > (window_height - 178)) {

        $('.navbar').slideDown();

      } else {

        $('.navbar').slideUp();

      }

  });
  

  //Animation of navbar contact links

  $('.navbar_contact_link').mouseenter(function() {

    $(this).animate({'opacity': '1'}, 300);

  });

  $('.navbar_contact_link').mouseleave(function() {

    $(this).animate({'opacity': '0.75'}, 300);

  });

  $('.navbar_contact_link').click(function() {

    $(this).animate({'opacity': '0'}, 150).animate({'opacity': '1'}, 150);

    var href = $(this).closest('a').attr('href');
    setTimeout(function() {window.location.href = href}, 600);
    return false;

  });

  $(window).trigger('resize');
  

  //Animation for landing page

  $('#landing_logo').delay(5000).animate({opacity: 1}, 1500);
  $('#original_tag').delay(500).fadeIn(1500).delay(500).fadeOut(1500, function() {

    $('#sticking_tag').fadeIn(1500);

  });
  

  //Setting height of project boxes equal to width even with screen resize

  $(window).resize(function() {

    var project_box_width = $('.project_box').width();

    if ($(this).width() >= 560) {

      $('.project_box').css({'height': project_box_width, 'line-height': project_box_width + 'px'});

    } else {

      $('.project_box').css({'height': '50px', 'line-height': 'normal'});

    }

  });

  $(window).resize();
  

  //Animation of project boxes

  $('.project_box').mouseenter(function() {

    if ($(this).width() >= 560) {

      $(this).animate({'opacity': '1', 'font-size': '1.3em'}, 300);

    } else {

      $(this).animate({'opacity': '1', 'font-size': '1.1em'}, 300);

    }

  });

  $('.project_box').mouseleave(function() {

    $(this).animate({'opacity': '0.85', 'font-size': '1em'}, 300);

  });

  $('.project_box').click(function() {

    $(this).effect('highlight', {'color': 'white'}, 300);

    var href = $(this).closest('a').attr('href');
    setTimeout(function() {window.location.href = href}, 600);
    return false;

  });
  
  
  //Submission of contact form
  
  var form = $('#contact_form');
  var alert = $('#form_alert');
  
  	//Cancels the form submission  
  $(form).submit(function(event) {
        
    event.preventDefault();
        
    //Serialize the form data    
    var form_data = $(form).serialize();
    
    //Submit the form using AJAX    
    $.ajax ({
      type: 'POST',
      url: $(form).attr('action'),
      data: form_data
    })
  
    .done(function(response) {
    
      $(alert).removeClass('alert-danger');
      $(alert).addClass('alert-success');

      //Set the message text
      $(alert).text(response);

      //Clear the form    
      $('#form_email').val('');
      $('#form_name').val('');    
      $('#form_subject').val('');
      $('#form_message').val('');
      
    })
  
    .fail(function(data) {
    
      $(alert).removeClass('alert-success');
      $(alert).addClass('alert-danger');

      // Set the message text.
      if (data.responseText !== '') {
          $(alert).text(data.responseText);
      } else {
          $(alert).text('An error has occurred and your message cannot be sent. Try again or use the manual link to the right (sorry!)');
      }
      
    });
    
  });
    

  //Animation of contact links

  $('.contact_link').mouseenter(function() {

    $(this).animate({'opacity': '1', 'font-size': '1.3em'}, 300);

  });

  $('.contact_link').mouseleave(function() {

    $(this).animate({'opacity': '0.85', 'font-size': '1em'}, 300);

  });

  $('.contact_link').click(function() {

    $(this).animate({'opacity': '0'}, 150).animate({'opacity': '1'}, 150);

    var href = $(this).closest('a').attr('href');
    setTimeout(function() {window.location.href = href}, 600);
    return false;

  });

});


  //Leaving page warning

  $(window).bind('beforeunload', function(){
    return 'Are you sure you want to leave?';
  });

