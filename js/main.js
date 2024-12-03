(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner(0);
    
    
    // Initiate the wowjs
    new WOW().init();


    // Sticky Navbar
    $(window).scroll(function () {
        if ($(window).width() > 992) {
            if ($(this).scrollTop() > 45) {
                $('.sticky-top .container').addClass('shadow-sm').css('max-width', '100%');
            } else {
                $('.sticky-top .container').removeClass('shadow-sm').css('max-width', $('.topbar .container').width());
            }
        } else {
            $('.sticky-top .container').addClass('shadow-sm').css('max-width', '100%');
        }
    });


    // Hero Header carousel
    $(".header-carousel").owlCarousel({
        items: 1,
        autoplay: true,
        smartSpeed: 2000,
        center: false,
        dots: false,
        loop: true,
        margin: 0,
        nav : true,
        navText : [
            '<i class="bi bi-arrow-left"></i>',
            '<i class="bi bi-arrow-right"></i>'
        ]
    });



    // Project carousel
    $(".project-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        center: false,
        dots: true,
        loop: true,
        margin: 25,
        nav : false,
        navText : [
            '<i class="bi bi-arrow-left"></i>',
            '<i class="bi bi-arrow-right"></i>'
        ],
        responsiveClass: true,
        responsive: {
            0:{
                items:1
            },
            576:{
                items:1
            },
            768:{
                items:2
            },
            992:{
                items:2
            },
            1200:{
                items:2
            }
        }
    });

    // testimonial carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1500,
        center: false,
        dots: true,
        loop: true,
        margin: 25,
        nav : false,
        navText : [
            '<i class="bi bi-arrow-left"></i>',
            '<i class="bi bi-arrow-right"></i>'
        ],
        responsiveClass: true,
        responsive: {
            0:{
                items:1
            },
            576:{
                items:1
            },
            768:{
                items:2
            },
            992:{
                items:2
            },
            1200:{
                items:2
            }
        }
    });


    // Facts counter
    $('[data-toggle="counter-up"]').counterUp({
        delay: 5,
        time: 2000
    });


    
   // Back to top button
   $(window).scroll(function () {
    if ($(this).scrollTop() > 300) {
        $('.back-to-top').fadeIn('slow');
    } else {
        $('.back-to-top').fadeOut('slow');
    }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


})(jQuery);



document.addEventListener("DOMContentLoaded", function () {
    const carousel = document.querySelector(".logo-carousel");
    const clone = carousel.innerHTML; // Clone the logos to create a seamless loop
    carousel.innerHTML += clone;
});


document.getElementById('book-training-button').addEventListener('click', function () {
    // Get form values
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const trainingProgram = document.getElementById('training-program').value;
  
    // Validate form fields
    if (!name || !email || !trainingProgram) {
      alert('Please fill in all required fields.');
      return;
    }
  
    // Construct the mailto link
    const subject = encodeURIComponent('Training Booking Request');
    const body = encodeURIComponent(
      `Hello,\n\nI would like to book the following training program:\n\n` +
        `Name: ${name}\n` +
        `Email: ${email}\n` +
        `Training Program: ${trainingProgram}\n\n` +
        `Best regards,\n${name}`
    );
    const mailtoLink = `mailto:info@shadvisorylimited.com?subject=${subject}&body=${body}`;
  
    // Redirect to the mailto link
    window.location.href = mailtoLink;
  });

  
  

    $(document).ready(function () {
        $("#contactForm").on("submit", function (e) {
            e.preventDefault(); // Prevent form from reloading the page

            $.ajax({
                url: "send_email.php",
                type: "POST",
                data: $(this).serialize(),
                success: function (response) {
                    if (response.trim() === "success") {
                        $("#formResponse")
                            .html("Message sent successfully!")
                            .css("color", "green")
                            .fadeIn();
                        $("#contactForm")[0].reset(); // Reset form fields
                    } else {
                        $("#formResponse")
                            .html("Failed to send message. Please try again.")
                            .css("color", "red")
                            .fadeIn();
                    }
                },
                error: function () {
                    $("#formResponse")
                        .html("An error occurred. Please try again.")
                        .css("color", "red")
                        .fadeIn();
                },
            });
        });
    });






