$(document).ready(function () {
    //window.print();
    var $form_one = $("#upload-sealcertifiedone");
    $form_one.on('ajaxForm.success', function (evt, response) {
        location.reload();
    });

    var $form_two = $("#upload-sealcertifiedtwo");
    $form_two.on('ajaxForm.success', function (evt, response) {
        location.reload();
    });

    $(".signature-input").blur(function () {
        var timeout = null;
        clearTimeout(timeout);
        timeout = setTimeout(() => {
            var url = MapasCulturais.createUrl('seal', 'saveSignatureNames', [MapasCulturais.entity.id]);
            $.ajax({
                url: url,
                type: 'post',
                data: {
                    signature_one: $("#name_sealcertifiedone").val(),
                    signature_two: $("#name_sealcertifiedtwo").val(),
                }
            })
                .done(function (data) {
                    MapasCulturais.Messages.success("Assinatura salva!");
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                })
                .fail(function (jqXHR, textStatus, msg) {
                    alert('Erro inesperado, fale com administrador.');
                });

        }, 3000);
    });

    $(".remove-signature").click(function () {

        if(confirm('Deseja realmente deletar esta assinatura?')){

        $(this).parent().find(".signature-input").addClass("removing");
        var data = {};
        if (!$("#name_sealcertifiedone").hasClass("removing")) {
            data.signature_one = $("#name_sealcertifiedone").val();
        } else {
            $("#name_sealcertifiedone").removeClass("removing");
        }

        if (!$("#name_sealcertifiedtwo").hasClass("removing")) {
            data.signature_two = $("#name_sealcertifiedtwo").val();
        } else {
            $("#name_sealcertifiedtwo").removeClass("removing");
        }

        $(this).parent().find(".signature-input").val(null);

        var url = MapasCulturais.createUrl('seal', 'saveSignatureNames', [MapasCulturais.entity.id]);
        $.ajax({
            url: url,
            type: 'post',
            data: data
        })
        .done(function (data) {
            MapasCulturais.Messages.success("Assinatura removida!");
            setTimeout(() => {
                    location.reload();
            }, 1500);
        })
        .fail(function (jqXHR, textStatus, msg) {
                alert('Erro inesperado, fale com administrador.');
        });

        }
    
    });   
});



