$(function() {
	
});


$(".load-view").on("click", function () {
	view = $(this).attr("view");
	
	$("ul.navbar-nav li").each(function () {
		$(this).attr("class", "");
	})
	$(this).parent().attr("class", "active");
	
	load_view( view );
});


// TEMPLATE & API

function load_view ( view ) {
	var url = "/index.php?view=" + view;
    $.ajax( url ).always( function ( response, status ) {
    	$("#main").html( response );		
    } );
	
}


function api_call (apiname, type, data, success = undefined , error = undefined) {
	var url = "/index.php";
	var url_parameters = {
			"view": apiname
	};
	
	if ( type == "GET" ) {
		for (var key in data) {			
			url_parameters[key] = data[key];			
		}		
	}
	str_url_parameters = "";
	for (var key in url_parameters) {			
		str_url_parameters = str_url_parameters + key + "=" + encodeURI(url_parameters[key]) + "&";			
	}		
	
	
	url = url + "?" + str_url_parameters;
	//console.log(url);
	
	var call = {
	        type: type,
	        url: url,
	        dataType: 'json'
	};
	
	if ( type == "POST" ) {
		call["data"] = data		
	}
		
    $.ajax( call ).always( function ( response, status ) {
		var data = response;
		if ( status != "success") {
			data = response.responseJSON;
		}
		
		//console.log(response);
		if ( typeof(data) == "object") {
			if ( "text" in data ) {
				alert( data["text"] );
			}
		//} else {
		//	alert(typeof( data ));
		}
		
		if ( status == "success" && typeof(success) !== 'undefined' ) {			
			success( data );
		} else if ( typeof(error) !== 'undefined'  ) {
			error( data );
		}
		
    } );
	
}