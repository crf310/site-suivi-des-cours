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