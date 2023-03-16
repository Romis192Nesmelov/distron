$(document).ready(function ($) {
    $('form.useAjax button[type=submit]').click(function(e) {
        e.preventDefault();

        var popup = $(this).parents('.base-form.popup'),
            form = $(this).parents('form'),
            button = form.find('button[type=submit]'),
            agree = form.find('input[name=i_agree]'),
            formData = new FormData;

        if (!agree.is(':checked')) return false;

        agree.change(function () {
            if (agree.is(':checked')) button.removeAttr('disabled');
            else button.attr('disabled','disabled');
        });

        form.find('input, textarea, select').each(function () {
            var self = $(this);
            if (self.attr('type') == 'file') formData.append(self.attr('name'),self[0].files[0]);
            else if (self.attr('type') == 'checkbox' || self.attr('type') == 'radio') formData = processingCheckFields(formData,self);
            else formData = processingFields(formData,self);
        });

        $('.error_text').html('');
        form.find('input, select, textarea, button').attr('disabled','disabled');
        addingLoader();

        $.ajax({
            url: form.attr('action'),
            data: formData,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data) {
                closePopup(popup.attr('id'));
                unlockAll(form);
                form.find('input, textarea').val('');

                $('#thanx_popup h3').html(data.message);

                $.fancybox.open({
                    src: '#thanx_popup',
                    type: 'inline'
                });
            },
            error: function (jqXHR, textStatus, errorThrown) {
                var responseMsg = jQuery.parseJSON(jqXHR.responseText),
                    replaceErr = {
                        'phone':'«Телефон»',
                        'email':'«E-mail»',
                        'user_name':'«Имя»'
                    };

                $.each(responseMsg, function (field, error) {
                    var errorMsg = error[0],
                        errorBlock = form.find('.input-'+field);

                    $.each(replaceErr, function (src,replace) {
                        errorMsg = errorMsg.replace(src,replace);
                    });
                    errorBlock.html(errorMsg);
                });
                unlockAll(form);
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

function unlockAll(form) {
    form.find('input, select, textarea, button').removeAttr('disabled');
    removingLoader();
}

function closePopup(id) {
    $.fancybox.close({src: '#'+id});
}