$(document).ready(function(){

	$("#keyword").on("keyup", function(){
		$("#container").load("ajax/harbingers.php?keyword=" + $("#keyword").val())
	});
});