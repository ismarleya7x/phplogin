$("document").ready(function() {
    $("#btnCadastrar").click(function() {
        $(".login-form").css("display", "none");
        $(".register-form").css("display", "block");

    });

    $("#btnEntrar").click(function() {
        $(".login-form").css("display", "block");
        $(".register-form").css("display", "none");

    });
});