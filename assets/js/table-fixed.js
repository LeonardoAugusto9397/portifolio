/** Table Fixed **/
(function() {
    var demo, fixedTable;

    fixedTable = function(el) {
        var $body, $header, $sidebar;
        $body = $(el).find('.fixedTable-body');
        $sidebar = $(el).find('.fixedTable-sidebar table');
        $header = $(el).find('.fixedTable-header table');
        return $($body).scroll(function() {
        $($sidebar).css('margin-top', -$($body).scrollTop());
        return $($header).css('margin-left', -$($body).scrollLeft());
        });
    };

    demo = new fixedTable($('#demo'));

}).call(this);

/** Table Search **/
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});