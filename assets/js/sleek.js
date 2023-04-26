/* ====== Index ======

1. SCROLLBAR SIDEBAR
2. BACKDROP
3. SIDEBAR MENU
4. SIDEBAR TOGGLE FOR MOBILE
5. SIDEBAR TOGGLE FOR VARIOUS SIDEBAR LAYOUT
6. TODO LIST
7. RIGHT SIDEBAR

====== End ======*/

$(document).ready(function () {
  "use strict";

  /*======== SCROLLBAR SIDEBAR ========*/
  var sidebarScrollbar = $(".sidebar-scrollbar");
  if (sidebarScrollbar.length != 0) {
    sidebarScrollbar.slimScroll({
      opacity: 0,
      height: "100%",
      color: "#808080",
      size: "5px",
      touchScrollStep: 50
    })
      .mouseover(function () {
        $(this)
          .next(".slimScrollBar")
          .css("opacity", 0.5);
      });
  }

  /*======== MOBILE OVERLAY ========*/
  if ($(window).width() < 768) {
    $(".sidebar-toggle").on("click", function () {
      $("body").css("overflow", "hidden");
      $('body').prepend('<div class="mobile-sticky-body-overlay"></div>')
    });

    $(document).on("click", '.mobile-sticky-body-overlay', function (e) {
      $(this).remove();
      $("#body").removeClass("sidebar-mobile-in").addClass("sidebar-mobile-out");
      $("body").css("overflow", "auto");
    });
  }

  /*======== SIDEBAR MENU ========*/
  var sidebar = $(".sidebar")
  if (sidebar.length != 0) {
    $(".sidebar .nav > .has-sub > a").click(function () {
      $(this).parent().siblings().removeClass('expand')
      $(this).parent().toggleClass('expand')
    })

    $(".sidebar .nav > .has-sub .has-sub > a").click(function () {
      $(this).parent().toggleClass('expand')
    })
  }


  /*======== SIDEBAR TOGGLE FOR MOBILE ========*/
  if ($(window).width() < 768) {
    $(document).on("click", ".sidebar-toggle", function (e) {
      e.preventDefault();
      var min = "sidebar-mobile-in",
        min_out = "sidebar-mobile-out",
        body = "#body";
      $(body).hasClass(min)
        ? $(body)
          .removeClass(min)
          .addClass(min_out)
        : $(body)
          .addClass(min)
          .removeClass(min_out)
    });
  }

  /*======== SIDEBAR TOGGLE FOR VARIOUS SIDEBAR LAYOUT ========*/
  var body = $("#body");
  if ($(window).width() >= 768) {

    if (typeof window.isMinified === "undefined") {
      window.isMinified = false;
    }
    if (typeof window.isCollapsed === "undefined") {
      window.isCollapsed = false;
    }

    $("#sidebar-toggler").on("click", function () {
      if (
        body.hasClass("sidebar-fixed-offcanvas") ||
        body.hasClass("sidebar-static-offcanvas")
      ) {
        $(this)
          .addClass("sidebar-offcanvas-toggle")
          .removeClass("sidebar-toggle");
        if (window.isCollapsed === false) {
          body.addClass("sidebar-collapse");
          window.isCollapsed = true;
          window.isMinified = false;
        } else {
          body.removeClass("sidebar-collapse");
          body.addClass("sidebar-collapse-out");
          setTimeout(function () {
            body.removeClass("sidebar-collapse-out");
          }, 300);
          window.isCollapsed = false;
        }
      }

      if (
        body.hasClass("sidebar-fixed") ||
        body.hasClass("sidebar-static")
      ) {
        $(this)
          .addClass("sidebar-toggle")
          .removeClass("sidebar-offcanvas-toggle");
        if (window.isMinified === false) {
          body
            .removeClass("sidebar-collapse sidebar-minified-out")
            .addClass("sidebar-minified");
          window.isMinified = true;
          window.isCollapsed = false;
        } else {
          body.removeClass("sidebar-minified");
          body.addClass("sidebar-minified-out");
          window.isMinified = false;
        }
      }
    });
  }

  if ($(window).width() >= 768 && $(window).width() < 992) {
    if (
      body.hasClass("sidebar-fixed") ||
      body.hasClass("sidebar-static")
    ) {
      body
        .removeClass("sidebar-collapse sidebar-minified-out")
        .addClass("sidebar-minified");
      window.isMinified = true;
    }
  }

  /*======== TODO LIST ========*/
  function todoCheckAll() {
    var mdis = document.querySelectorAll(".todo-single-item .mdi");
    mdis.forEach(function (fa) {
      fa.addEventListener("click", function (e) {
        e.stopPropagation();
        e.target.parentElement.classList.toggle("finished");
      });
    });
  }

  if (document.querySelector("#todo")) {
    var list = document.querySelector("#todo-list"),
      todoInput = document.querySelector("#todo-input"),
      todoInputForm = todoInput.querySelector("form"),
      item = todoInputForm.querySelector("input");

    // document.querySelector("#add-task").addEventListener("click", function (e) {
    //   e.preventDefault();
    //   todoInput.classList.toggle("d-block");
    //   item.focus();
    // });

    todoInputForm.addEventListener("submit", function (e) {
      e.preventDefault();
      if (item.value.length <= 0) {
        return;
      }
      list.innerHTML =
        '<div class="todo-single-item d-flex flex-row justify-content-between alert alert-dismissible fade show" role="alert">' +
          '<i class="mdi"></i>' +
          '<span>' +
            item.value +
          '</span>' +
          '<div class="task-content">' +
            '<span data-dismiss="alert" aria-label="Close">' +
              '<svg class="remove-task" id="Capa_1" enable-background="new 0 0 515.556 515.556" height="16" viewBox="0 0 515.556 515.556" width="16" xmlns="http://www.w3.org/2000/svg"><path d="m64.444 451.111c0 35.526 28.902 64.444 64.444 64.444h257.778c35.542 0 64.444-28.918 64.444-64.444v-322.222h-386.666z"/><path d="m322.222 32.222v-32.222h-128.889v32.222h-161.111v64.444h451.111v-64.444z"/></svg>' +
            '</span>' +
          '</div>' +
        '</div>' +
      list.innerHTML;
      item.value = "";
      //Close input field
      // todoInput.classList.toggle("d-block");
      todoCheckAll();
    });

    todoCheckAll();
  }

  /*======== RIGHT SIDEBAR ========*/
  var rightSidebarIn = 'right-sidebar-in';
  var rightSidebarOut = 'right-sidebar-out';

  $('.nav-right-sidebar .nav-link').on('click', function () {

    if (!body.hasClass(rightSidebarIn)) {
      body.addClass(rightSidebarIn).removeClass(rightSidebarOut);

    } else if ($(this).hasClass('show')) {
      body.addClass(rightSidebarOut).removeClass(rightSidebarIn);
    }
  });

  $('.card-right-sidebar .close').on('click', function () {
    body.removeClass(rightSidebarIn).addClass(rightSidebarOut);
  })

  if ($(window).width() <= 1024) {

    var togglerInClass = "right-sidebar-toggoler-in"
    var togglerOutClass = "right-sidebar-toggoler-out"

    body.addClass(togglerOutClass);

    $('.btn-right-sidebar-toggler').on('click', function () {
      if (body.hasClass(togglerOutClass)) {
        body.addClass(togglerInClass).removeClass(togglerOutClass)
      } else {
        body.addClass(togglerOutClass).removeClass(togglerInClass);
      }
    });
  }


  /*======== DROPDOWN NOTIFY ========*/
  var dropdownToggle = $('.notify-toggler');
  var dropdownNotify = $('.dropdown-notify');

  if (dropdownToggle.length !== 0){
    dropdownToggle.on('click', function () {
      if (!dropdownNotify.is(':visible')){
        dropdownNotify.fadeIn(5);
      }else {
        dropdownNotify.fadeOut(5);
      }
    });

    $(document).mouseup(function (e) {
      if (!dropdownNotify.is(e.target) && dropdownNotify.has(e.target).length === 0){
        dropdownNotify.fadeOut(5);
      }
    });
  }

    /*======== TOOLTIPS AND POPOVER ========*/
    var tooltip = $('[data-toggle="tooltip"]')
    if(tooltip.length != 0){
      tooltip.tooltip({
        container: "body",
        template:
          '<div class="tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
      });
    }
  
    var popover = $('[data-toggle="popover"]')
  
    if(popover.length != 0){
      popover.popover();
    }

  /*======== TOASTER ========*/
  function callToaster(positionClass) {
    if (document.getElementById("toaster")) {
      toastr.options = {
        closeButton: true,
        debug: false,
        newestOnTop: false,
        progressBar: true,
        positionClass: positionClass,
        preventDuplicates: false,
        onclick: null,
        showDuration: "300",
        hideDuration: "1000",
        timeOut: "5000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut"
      };
      toastr.success("Welcome to sleek", "Howdy!");
    }
  }

  if (document.dir != "rtl" ){
    callToaster("toast-top-right");
  }else {
    callToaster("toast-top-left");
  }

  /*======== PROGRESS BAR ========*/
  NProgress.done();

  /*======== MULTIPLE SELECT ========*/
  var jsExampleBasicMultiple = $(".js-example-basic-multiple");
  if (jsExampleBasicMultiple.length !== 0){
    jsExampleBasicMultiple.select2({});
  }

  /*======== BASIC DATA TABLE ========*/
  var basicDataTable = $("#basic-data-table");
  if (basicDataTable.length !== 0){
    basicDataTable.DataTable({
      "dom": '<"row justify-content-between top-information"lf>rt<"row justify-content-between bottom-information"ip><"clear">'
    });
  }

  /*======== RESPONSIVE DATA TABLE ========*/
  var responsiveDataTable = $("#responsive-data-table");
  if (responsiveDataTable.length !== 0){
    responsiveDataTable.DataTable({
      "aLengthMenu": [[20, 30, 50, 75, -1], [20, 30, 50, 75, "All"]],
      "pageLength": 20,
      "dom": '<"row justify-content-between top-information"lf>rt<"row justify-content-between bottom-information"ip><"clear">'
    });
  }

  /*======== HOVERABLE DATA TABLE ========*/
  var hoverableDataTable = $("#hoverable-data-table");
  if (hoverableDataTable.length !== 0){
    hoverableDataTable.DataTable({
      "aLengthMenu": [[20, 30, 50, 75, -1], [20, 30, 50, 75, "All"]],
      "pageLength": 20,
      "dom": '<"row justify-content-between top-information"lf>rt<"row justify-content-between bottom-information"ip><"clear">'
    });
  }

  /*======== CIRCLE PROGRESS ========*/
  var gray = '#f5f6fa';
  var circle = $('.circle');
  if(circle.length !== 0) {
    circle.circleProgress ({
      lineCap: "round",
      startAngle: 4.8,
      emptyFill: [gray]
    })
  };

});
