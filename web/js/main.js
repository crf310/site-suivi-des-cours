function afficher_cacher(id, afficher, cacher) {
	if (document.getElementById(id).style.display != "none") {
		document.getElementById(id).style.display = "none";
		document.getElementById('bouton_' + id).value = '' + afficher + '';
	} else {
		document.getElementById(id).style.display = "block";
		document.getElementById('bouton_' + id).value = '' + cacher + '';
	}
	return true;
}