$('document').ready(function(e){
    $.post(gateway, {
        name: "John", 
        time: "2pm"
    }).done(function (data) {
        $('#invoice-form').html(data);
    }).fail();
});
$('#payment_form').on('submit', function(e){
    e.preventDefault();
    $('.message').remove();
    var action = $(this).attr('action'), 
    formData = $(this).serializeArray();
    $.post(action, formData).done(function(data){
        $.each(data.messages, function(type, message){
            if(type !== 'common'){
                $('#'+type).parent().append('<div class="message ' + data.status + '">' + message + '</div>');
            }else{
                $.each(message, function(i, ms){
                    $('#common').append('<div class="message ' + data.status + '">' + ms + '</div>');
                });
            }
        });
        console.log(data);
    });
});
