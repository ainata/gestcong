$("#btn_ajout_employer").click( function(){
	alert('rooro');
	$.post("AjoutEmployer.php",$("#form_employer :input").serializeArray(),function(info){$("#resultat").html(info);});
	clear();
	
});

$("#form_employer").submit(function(){
	return false;
}
);
function clear()
{
	$("#form_employer :input").each(function() {
        $(this).val('');
    });
}
