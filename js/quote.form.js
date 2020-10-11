/**
*
* -----------------------------------------------------------------------------
*
* Template : SEO Ninja - HTML5 Template 
* Author : rs-theme
* Author URI : http://www.rstheme.com/
*
* -----------------------------------------------------------------------------
*
**/

jQuery(document).ready(function($) {
    'use strict';

    // Get the form.
    var form = $('#get-quote');

    // Get the messages div.
    var formMessage = $('#form-message');

    // Set up an event listener for the contact form.
    $(form).submit(function(e) {
        // Stop the browser from submitting the form.
        e.preventDefault();

        // Serialize the form data.
        var formData = $(form).serialize();

        // Submit the form using AJAX.
        $.ajax({
            type: 'POST',
            url: $(form).attr('action'),
            data: formData
        })
        .done(function(response) {
            // Make sure that the formMessages div has the 'success' class.
            $(formMessage).removeClass('error');
            $(formMessage).addClass('success');

            // Set the message text.
            $(formMessage).text(response);

            // Clear the form.
            $('#qname, #qemail, #qphone, #qwebsite, #qmessage').val('');
        })
        .fail(function(data) {
            // Make sure that the formMessages div has the 'error' class.
            $(formMessage).removeClass('success');
            $(formMessage).addClass('error');

            // Set the message text.
            if (data.responseText !== '') {
                $(formMessage).text(data.responseText);
            } else {
                $(formMessage).text('Oops! An error occured and your message could not be sent.');
            }
        });
    });

    $(form).submit(function(event){
        event.preventDefault();
        var $form = $(this);

        $.ajax({
            type: 'POST',
            url: $form.attr('action'),
            data: $form.serialize(),
            success: function(response) {
                $(formMessage).removeClass('error');
                $(formMessage).addClass('success');
                // Set the message text.
                $(formMessage).text(response);
                // Clear the form.
                $('#qname, #qemail, #qphone, #qwebsite, #qmessage').val('');

                $.magnificPopup({
                    items: {
                        src: $elm.html(),
                        type: 'inline'
                    }
                });

            },
            error: function(error) {
                // Do something with the error
            }
        });
    });

});