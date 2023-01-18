 function familias(){
 	var xhttp = new XMLHttpRequest();       
 	xhttp.onreadystatechange = function() {
 	 if (this.readyState == 4 && this.status == 200) {  
 		// crear lista
 		var lista = document.createElement("ul");
 		// meter los datos de la respuesta en un array
 		var cats = JSON.parse(this.response);				
		// para cada elemento del array 
		for(var i = 0; i < cats.length; i++){
			//se crea un elemento ul con el campo  nombre 
			var elem = document.createElement("li");
			elem.innerHTML = cats[i]["nombre"];
			// se aÃ±ade a la lista
			lista.appendChild(elem);		
		}
		var body = document.getElementById("principal");
		// eliminar el contenido actual
		body.innerHTML = "";
		body.appendChild(lista);
		
	 }
	};
	xhttp.open("GET", "datos_familias_json.php", true);     
	xhttp.send(); 
	// para que no se siga el link que llama a esta funciÃ³n
	return false;
}