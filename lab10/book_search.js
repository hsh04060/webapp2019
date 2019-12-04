window.onload = function() {
    $("b_xml").onclick=function(){
		new Ajax.Request("books.php",{
			method : "get",
			parameters : {category:getCheckedRadio($$("input"))},
			onSuccess: showBooks_XML,
			onFailure: ajaxFailed,
			onException: ajaxFailed
		});
    	    //construct a Prototype Ajax.request object
	}
	
    $("b_json").onclick=function(){
		new Ajax.Request("books_json.php",{
			method : "get",
			parameters : {category:getCheckedRadio($$("input"))},
			onSuccess: showBooks_JSON,
			onFailure: ajaxFailed,
			onException: ajaxFailed
		});
	}
};

function getCheckedRadio(radio_button){
	for (var i = 0; i < radio_button.length; i++) {
		if(radio_button[i].checked){
			return radio_button[i].value;
		}
	}
	return undefined;
}

function showBooks_XML(ajax) {
	var ul = document.getElementById("books");
	var old = $$("#books li");
	for(var j=0;j<old.length;j++){
		old[j].remove();
	}
	var books = ajax.responseXML.getElementsByTagName("book");
	for(var i=0;i<books.length;i++){
		var title = books[i].getElementsByTagName("title")[0].firstChild.nodeValue;
		var author = books[i].getElementsByTagName("author")[0].firstChild.nodeValue;
		var year = books[i].getElementsByTagName("year")[0].firstChild.nodeValue;
		var li= document.createElement("li");
		li.innerHTML= title+", by "+author+"("+year+")";
		ul.appendChild(li);
	}
	document.body.appendChild(ul);
}

function showBooks_JSON(ajax) {
	var ul = document.getElementById("books");
	var old = $$("#books li");
	for(var j=0;j<old.length;j++){
		old[j].remove();
	}
	
	var data = JSON.parse(ajax.responseText);
	for(var i=0;i<data.books.length;i++){
		var title = data.books[i].title;
		var author = data.books[i].author;
		var year = data.books[i].year;
		var li = document.createElement("li");
		li.innerHTML = title+", by "+author+"("+year+")";
		ul.appendChild(li);
	}
	document.body.appendChild(ul);
}

function ajaxFailed(ajax, exception) {
	var errorMessage = "Error making Ajax request:\n\n";
	if (exception) {
		errorMessage += "Exception: " + exception.message;
	} else {
		errorMessage += "Server status:\n" + ajax.status + " " + ajax.statusText + 
		                "\n\nServer response text:\n" + ajax.responseText;
	}
	alert(errorMessage);
}
