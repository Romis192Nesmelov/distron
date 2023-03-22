$(document).ready(function ($) {

    var body = $('body'),
        formModal = $('#request-modal'),
        loader = $('<div></div>').attr('id','loader').append($('<div></div>')),
        agree = $('input[name=i_agree]');

    agree.change(function () {
        let button = $(this).parents('form.useAjax').find('button[type=submit]');
        if (agree.is(':checked')) button.removeAttr('disabled');
        else button.attr('disabled','disabled');
    });

    $('button[type=submit]').click(function(e) {
        e.preventDefault();
        let formData = new FormData,
            form = $(this).parents('form.useAjax');

        if (!agree.is(':checked')) return false;

        form.find('input, textarea, select').each(function () {
            let self = $(this);
            if (self.attr('type') === 'file') formData.append(self.attr('name'),self[0].files[0]);
            else if (self.attr('type') === 'checkbox' || self.attr('type') === 'radio') formData = processingCheckFields(formData,self);
            else formData = processingFields(formData,self);
        });

        $('.error').css('display','none').html('');
        form.find('input, select, textarea, button').attr('disabled','disabled');
        addLoader(body,loader);

        $.ajax({
            url: form.attr('action'),
            data: formData,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data) {
                formModal.modal('hide');
                unlockAll(body,form,loader);
                form.find('input, textarea').val('');

                let thanksModal = $('#thanks-modal');
                thanksModal.find('h3').html(data.message);
                thanksModal.modal('show');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                let response = jQuery.parseJSON(jqXHR.responseText),
                    replaceErr = {
                        'phone':'«Телефон»',
                        'email':'«E-mail»',
                        'name':'«Имя»'
                    };

                $.each(response.errors, function (field, errorMsg) {
                    let errorBlock = form.find('.error.'+field);
                    errorMsg = errorMsg[0];
                    $.each(replaceErr, function (src,replace) {
                        errorMsg = errorMsg.replace(src,replace);
                    });
                    errorBlock.css('display','block').html(errorMsg);
                });
                unlockAll(body,form,loader);
            }
        });
    });
});

function processingFields(formData, inputObj) {
    if (inputObj.length) {
        $.each(inputObj, function (key, obj) {
            if (obj.type != 'checkbox' && obj.type != 'radio') {
                formData.append(obj.name,obj.value);
            }
        });
    }
    return formData;
}

function processingCheckFields(formData, inputObj) {
    if (inputObj.length) {
        inputObj.each(function(){
            var _self = $(this);
            if(_self.is(':checked')) {
                formData.append(_self.attr('name'),_self.val());
            }
        });
    }
    return formData;
}

function unlockAll(body,form,loader) {
    form.find('input, select, textarea, button').removeAttr('disabled');
    loader.remove();
    body.css({
        'overflow':'auto',
        'padding-right':0
    });
}

function addLoader(body,loader) {
    body.prepend(loader.css('top',window.scrollY));
    body.css({
        'overflow':'hidden',
        'padding-right':20
    });
}
