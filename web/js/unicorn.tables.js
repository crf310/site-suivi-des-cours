/**
 * Unicorn Admin Template
 * Version 2.1.0
 * Diablo9983 -> diablo9983@gmail.com
**/

$(document).ready(function(){
	
	$('.data-table').dataTable({
		"bJQueryUI": true,
		"sPaginationType": "full_numbers",
		"sDom": '<""l>t<"F"fp>',
                       "iDisplayLength": 20,
                       "aaSorting": [],
                       "oLanguage": {
                           "sProcessing": "Traitement en cours...",
                           "sSearch": "Filtrer&nbsp;:",
                           "sLengthMenu": "Afficher _MENU_ &eacute;l&eacute;ments",
                           "sInfo": "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                           "sInfoEmpty": "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
                           "sInfoFiltered": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                           "sInfoPostFix": "",
                           "sLoadingRecords": "Chargement en cours...",
                           "sZeroRecords": "Aucun &eacute;l&eacute;ment &agrave; afficher",
                           "sEmptyTable": "Aucune donnée disponible dans le tableau",
                           "oPaginate": {
                               "sFirst": "Premier",
                               "sPrevious": "Pr&eacute;c&eacute;dent",
                               "sNext": "Suivant",
                               "sLast": "Dernier"
                           },
                           "oAria": {
                               "sSortAscending": ": activer pour trier la colonne par ordre croissant",
                               "sSortDescending": ": activer pour trier la colonne par ordre décroissant"
                           }
                       }
	});
	
	$('select').select2();
	

	$("span.icon input:checkbox, th input:checkbox").on('ifChecked || ifUnchecked',function() {
		var checkedStatus = this.checked;
		var checkbox = $(this).parents('.widget-box').find('tr td:first-child input:checkbox');		
		checkbox.each(function() {
			this.checked = checkedStatus;
			if (checkedStatus == this.checked) {
				$(this).closest('.' + checkboxClass).removeClass('checked');
			}
			if (this.checked) {
				$(this).closest('.' + checkboxClass).addClass('checked');
			}
		});
	});	
});
