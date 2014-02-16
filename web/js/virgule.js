$(document).ready(function(){	
    $('.datepicker').datepicker({
        weekStart: 1
    }).on('changeDate', function(){    
        $(this).blur();
    }); 
});

        
$(document).ready(function () {
    $('#checkAll').click(function () {
        if ($("#checkAll").attr("value") == "noneChecked") {
            $("#checkAll").parents("div.form-group").find("input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
                $("#checkAll").html('<i class="icon-check-empty"></i> Tout décocher');
                $("#checkAll").attr("value" , "allChecked")
            });
        } else {
            $("#checkAll").parents("div.form-group").find("input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
                $("#checkAll").html('<i class="icon-check"></i> Tout cocher');
                $("#checkAll").attr("value" , "noneChecked")
            });
        }
    });
});

window.setTimeout(function() {
     $(".alert-global").fadeTo(500, 0).slideUp(500, function(){
          $(this).remove(); 
     });
}, 5000);

$(function(){
    $('#add-comment').click(function(e){
        e.preventDefault();
        bootbox.dialog({
            message: $('#comment-modal-body').html(),
            title: "Ajouter un commentaire",
            buttons: {
                no: {
                    label: "Annuler",
                    className: "btn-default"
                },
                yes: {
                    label: "Enregistrer le commentaire",
                    className: "btn-success",
                    callback: function() {
                        $(".bootbox #comment-form").submit();
                    }
                }
             }
        });
    });
});

$(function(){
    $('#change-student-level').click(function(e){
        e.preventDefault();
        bootbox.dialog({
            message: $('#change-student-level-modal-body').html(),
            title: "Modifier le niveau de l\'apprenant",
            buttons: {
                no: {
                    label: "Annuler",
                    className: "btn-default"
                },
                yes: {
                    label: "Mettre à jour le niveau",
                    className: "btn-success",
                    callback: function() {
                        $(".bootbox #change-student-level-form").submit();
                    }
                }
             }
        });
    });
});

// Override the global checkbox in tables as we're not using the iCheck 

$(document).ready(function(){
    $("span.icon input:checkbox, th input:checkbox").click(function() {
            var checkedStatus = this.checked;
            var checkbox = $(this).parents('.widget-box').find('tr td:first-child input:checkbox');		
            checkbox.each(function() {
                    this.checked = checkedStatus;
                    if (checkedStatus == this.checked) {
                            $(this).closest('.checker > span').removeClass('checked');
                    }
                    if (this.checked) {
                            $(this).closest('.checker > span').addClass('checked');
                    }
            });
    });	
});