







$("#upfile1").click(function () {
    $("#file1").trigger('click');
});









function ResetSearch(){
  $("#search-user-name").val(null);
  $(".search-results-heading").hide();
  $("#spinner-search").hide();
  $("#display-search-results").hide();
  $("#display-search-results").html("");
}