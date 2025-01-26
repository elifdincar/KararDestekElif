// =========== Aktif Menü ===========
$(document).ready(function () {
  var activeurl = window.location.pathname;
  if (activeurl == '/') {
    activeurl = '/gosterge-paneli.php';
  }
  activeurl = activeurl.replace('/', '');
  $('a[href="' + activeurl + '"]').parent('li').addClass('active');
});

// =========== Left sidebar ===========
$(document).on('click', '#sidebar li', function(){
  $(this).addClass('active').siblings().removeClass('active');
});

//// =========== Left sidebar dp toggle ===========
$('.sub-menu ul').hide();
$('.sub-menu a').click(function(){
  $(this).parent(".sub-menu").children("ul").slideToggle("100");
  $(this).find(".right").toggleClass("fa-caret-up fa-caret-down");
});

//// =========== Left sidebar toggle ===========
$(document).ready(function(){
  $("#toogleSidebar").click(function(){
    $(".left-menu").toggleClass("hide");
    $(".content-wrapper").toggleClass("hide");
  });
});