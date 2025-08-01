$(window).on("load", function () {
  $("body").removeClass("overflow");
});
$(document).ready(function () {
  if ($(window).width() >= 992) {
    sal({
      once: true,
    });
  } else {
    sal({
      once: true,
      disabled: true,
    });
  }
  /************************************ Header ************************************/
  if ($(this).scrollTop() >= 100) {
    $("header").addClass("fixed");
  } else {
    $("header").removeClass("fixed");
  }
  $(window).scroll(function () {
    if ($(this).scrollTop() >= 100) {
      $("header").addClass("fixed");
    } else {
      $("header").removeClass("fixed");
    }
  });
  $("#fixedNavbar ul li a[href^='#']").on("click", function (e) {
    e.preventDefault();
    var hash = this.hash;
    $("html, body").animate(
      {
        scrollTop: $(this.hash).offset().top,
      },
      500,
      function () {
        window.location.hash = hash;
      }
    );
    if ($(window).width() <= 991) {
      $(".navbar").fadeOut(300);
      $(".overlay").fadeOut(300);
      $(".nav,.menu-btn").removeClass("active");
      $("body").removeClass("overflow");
    }
  });
  $(".menu-btn").on("click", function (e) {
    $(".navbar").fadeToggle(300);
    $(".overlay").fadeToggle(300);
    $(".nav,.menu-btn").toggleClass("active");
    $("body").toggleClass("overflow");
  });
  $(".overlay").on("click", function (e) {
    $(".navbar").fadeOut(300);
    $(".overlay").fadeOut(300);
    $(".nav,.menu-btn").removeClass("active");
    $("body").removeClass("overflow");
  });
  //////////** fixed arrow to top**//////////
  $(".arrow-top").click(function () {
    $("html").css("scroll-behavior", "unset");

    $("html,body").animate(
      {
        scrollTop: 0,
      },
      1000,
      "swing"
    );
    setTimeout(() => {
      $("html").css("scroll-behavior", "smooth");
    }, 1000);
  });
  $(this).scrollTop() >= 500
    ? $(".arrow-top").fadeIn(300)
    : $(".arrow-top").fadeOut(300);

  $(window).scroll(function () {
    $(this).scrollTop() >= 500
      ? $(".arrow-top").fadeIn(300)
      : $(".arrow-top").fadeOut(300);
  });
  $("#fixedNavbar ul li a[href^='#'], ul.footer-nav li a[href^='#']").on(
    "click",
    function (e) {
      e.preventDefault();
      var hash = this.hash;
      $("html, body").animate(
        {
          scrollTop: $(this.hash).offset().top - 100,
        },
        500,
        function () {
          window.location.hash = hash;
        }
      );
      if ($(window).width() <= 767) {
        $(".navbar").fadeOut(300);
        $(".overlay").fadeOut(300);
        $(".nav").removeClass("active");
        $("body").removeClass("overflow");
      }
    }
  );
});
