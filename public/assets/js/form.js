$(document).ready(function () {
  //Initialize tooltips
  $('.nav-tabs > li a[title]').tooltip();
  
  //Wizard
  $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

      var $target = $(e.target);
  
      if ($target.parent().hasClass('disabled')) {
          return false;
      }
  });

  $(".next-step").click(function (e) {
      var $active = $('.wizard .nav-tabs li.active');
      $active.next().removeClass('disabled');
      nextTab($active);

  });
  $(".skip").click(function (e) {
    var $active = $('.wizard .nav-tabs li.active');
    $active.next().removeClass('disabled');
    skip($active);
  });
  $(".prev-step").click(function (e) {
      var $active = $('.wizard .nav-tabs li.active');
      prevTab($active);
  });
});

function nextTab(elem) {
  $(elem).next().find('a[data-toggle="tab"]').click();
}
function skip(elem) {
  $(elem).next().find('a[data-toggle="tab"]').click();
}
function prevTab(elem) {
  $(elem).prev().find('a[data-toggle="tab"]').click();
}