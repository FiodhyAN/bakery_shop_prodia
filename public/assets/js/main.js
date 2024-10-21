

$(function () {
  "use strict";


  /* scrollar */

  // new PerfectScrollbar(".notify-list")

  // new PerfectScrollbar(".search-content")

  // new PerfectScrollbar(".mega-menu-widgets")



  /* toggle button */

  $(".btn-toggle").click(function () {
    $("body").hasClass("toggled") ? ($("body").removeClass("toggled"), $(".sidebar-wrapper").unbind("hover")) : ($("body").addClass("toggled"), $(".sidebar-wrapper").hover(function () {
      $("body").addClass("sidebar-hovered")
    }, function () {
      $("body").removeClass("sidebar-hovered")
    }))
  })




  /* menu */

  $(function () {
    $('#sidenav').metisMenu();
  });

  $(".sidebar-close").on("click", function () {
    $("body").removeClass("toggled")
  })



  /* dark mode button */

  $(".dark-mode i").click(function () {
    $(this).text(function (i, v) {
      return v === 'dark_mode' ? 'light_mode' : 'dark_mode'
    })
  });


  $(".dark-mode").click(function () {
    $("html").attr("data-bs-theme", function (i, v) {
      return v === 'dark' ? 'light' : 'dark';
    })
  })


  /* sticky header */

  $(document).ready(function () {
    $(window).on("scroll", function () {
      if ($(this).scrollTop() > 60) {
        $('.top-header .navbar').addClass('sticky-header');
      } else {
        $('.top-header .navbar').removeClass('sticky-header');
      }
    });

    if (session) {
      Toastify({
        text: message,
        duration: 3000,
        close: true,
        backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
        className: "success",
      }).showToast();
    }
    $('#product-modal-btn').on('click', function() {
      $('#product-id').val($(this).data('product_id'));
      $('#product-name').text($(this).data('product_name'));
      $('#product-image').attr('src', $(this).data('product_image'));
      $('#product-price').text($(this).data('product_formatted_price'));
      $('#product-stock').text($(this).data('product_stock'));
      $('#quantity-input').attr('max', $(this).data('product_stock'));
      $('#quantity-input').val(1);
      const price = $(this).data('product_price');
      const formatted_price = price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
      $('#total-order').text('Rp. ' + formatted_price);
      if ($(this).data('product_stock') == 0) {
        $('#quantity-input').hide();
        $('#out-of-stock').show();
      } else {
        $('#quantity-input').show();
        $('#out-of-stock').hide();
      }
    });

    $('#plus-btn').on('click', function() {
      let quantity = $('#quantity-input').val();
      let max = $('#product-modal-btn').data('product_stock');
      if (quantity < max) {
        $('#quantity-input').val(parseInt(quantity) + 1);
        const price = $('#product-modal-btn').data('product_price') * (parseInt(quantity) + 1);
        var formatted_price = price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        $('#total-price').val(price);
        $('#total-order').text('Rp. ' + formatted_price);
      }
    });

    $('#minus-btn').on('click', function() {
      let quantity = $('#quantity-input').val();
      if (quantity > 1) {
        const price = $('#product-modal-btn').data('product_price') * (parseInt(quantity) - 1);
        var formatted_price = price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        $('#total-order').text('Rp. ' + formatted_price);
        $('#total-price').val(price);
        $('#quantity-input').val(parseInt(quantity) - 1);
      }
    });
  });


  /* email */

  $(".email-toggle-btn").on("click", function() {
    $(".email-wrapper").toggleClass("email-toggled")
  }), $(".email-toggle-btn-mobile").on("click", function() {
    $(".email-wrapper").removeClass("email-toggled")
  }), $(".compose-mail-btn").on("click", function() {
    $(".compose-mail-popup").show()
  }), $(".compose-mail-close").on("click", function() {
    $(".compose-mail-popup").hide()
  }), 


  /* chat */

  $(".chat-toggle-btn").on("click", function() {
    $(".chat-wrapper").toggleClass("chat-toggled")
  }), $(".chat-toggle-btn-mobile").on("click", function() {
    $(".chat-wrapper").removeClass("chat-toggled")
  }),



  /* switcher */

  $("#BlueTheme").on("click", function () {
    $("html").attr("data-bs-theme", "blue-theme")
  }),

  $("#LightTheme").on("click", function () {
    $("html").attr("data-bs-theme", "light")
  }),

    $("#DarkTheme").on("click", function () {
      $("html").attr("data-bs-theme", "dark")
    }),

    $("#SemiDarkTheme").on("click", function () {
      $("html").attr("data-bs-theme", "semi-dark")
    }),

    $("#BoderedTheme").on("click", function () {
      $("html").attr("data-bs-theme", "bodered-theme")
    })



  /* search control */

  $(".search-control").click(function () {
    $(".search-popup").addClass("d-block");
    $(".search-close").addClass("d-block");
  });


  $(".search-close").click(function () {
    $(".search-popup").removeClass("d-block");
    $(".search-close").removeClass("d-block");
  });


  $(".mobile-search-btn").click(function () {
    $(".search-popup").addClass("d-block");
  });


  $(".mobile-search-close").click(function () {
    $(".search-popup").removeClass("d-block");
  });




  /* menu active */

  $(function () {
    for (var e = window.location, o = $(".metismenu li a").filter(function () {
      return this.href == e
    }).addClass("").parent().addClass("mm-active"); o.is("li");) o = o.parent("").addClass("mm-show").parent("").addClass("mm-active")
  });
});










