function inputFileChange(){
    $("input[type=file]").on("change",function(){
        var actual = this;
        var file = this.files[0];
        var reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = function (evt) {
            $(actual).closest("div.file-container").find("img.img-thumbnail").attr("src",evt.target.result);
            $(actual).closest("div.file-container").find("img.img-thumbnail").css("display","inline-block");
        };
        $(this).closest("div.custom-file").find("label.custom-file-label").text(file.name);
    });
}

function inputFileSet(model){
    var actual = "#" + model.id;

    $.ajax({
        url: model.ruta,
        type: 'POST',
        headers: {
            Accept: 'application/json',
            Authorization: 'Bearer ' + model.token
        },
        data: model.datos
    }).done(function(response){
        $(actual).closest("div.file-container").find("img.img-thumbnail").attr("src","data:image/png;base64," + response);
        $(actual).closest("div.file-container").find("img.img-thumbnail").css("display","inline-block");
    });
}

var notificar = function (tipo,texto){
    var container = `<div id="alert-container" class="w-100 mt-5 row"></div>`
    if ($("#alert-container").length == 0){
        $("main").append(container);
    }

    var alert = `<div class="col-sm-4 offset-sm-8 alert alert-${tipo}" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                ${texto}
            </div>`;

    $("#alert-container").append(alert);
}

var removeValidation =  function(id){
    $(id + " input").removeClass("is-valid");
    $(id + " select").removeClass("is-valid");
    $(id + " textarea").removeClass("is-valid");

    $(id + " input").removeClass("is-invalid");
    $(id + " select").removeClass("is-invalid");
    $(id + " textarea").removeClass("is-invalid");
}

var listarUbigeo = function(token, model, callback){
    var ruta = `/api/ubigeo/listar/${model.idTipo}`;
    if (model.idPadre != null){
        ruta += `/${model.idPadre}`;
    }
    $.ajax({
        url: ruta,
        type: 'GET',
        headers: {
            Accept: 'application/json',
            Authorization: 'Bearer ' + token
        }
    }).done(callback);
}
