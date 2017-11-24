function load(object)
{
	var id = object.id;
	var value = object.value;
	$.ajax({
		url: 'update.php',
		method: "POST",
		data: { id: id, value: value }
	})
	.done(function(){
		if (value == "Деактивировать")
			value = "Активировать";
		else
			value = "Деактивировать";
		object.value = value;
	})
	.fail(function(result){
		alert(result);
	});
}
