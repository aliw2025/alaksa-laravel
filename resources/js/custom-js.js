$(document).ready(function (){
    $("#a-fib").attr("disabled", true)
    $("#vent-arrhy").attr("disabled", true)
    $("#avblock").attr("disabled", true)
    $("#bbb").attr("disabled", true)
    /* historyofArrythima Check*/
    $("#historyofArrythima").change(function (){
        if ($(this).is(":checked")) {
            $("#a-fib").attr("disabled", false)
            $("#vent-arrhy").attr("disabled", false)
            $("#avblock").attr("disabled", false)
            $("#bbb").attr("disabled", false)
        } else {
            $("#a-fib").attr("disabled", true)
            $("#vent-arrhy").attr("disabled", true)
            $("#avblock").attr("disabled", true)
            $("#bbb").attr("disabled", true)

        }
    });
});
