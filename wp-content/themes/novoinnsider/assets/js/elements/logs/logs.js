import $ from 'jquery';

export function saveLogsClick(actionurl){

    var currentURL = window.location.href;

    $.post({
        url: ajax_object.ajax_url,
        method: 'POST',
        data: {
            action: 'save_logs_click',
            nonce: ajax_object.ajax_nonce,
            actionurl: actionurl,
            url: currentURL,
        },
        success: function () {
            console.log('Save');
        },
        error: function () {
            console.log('Error');
        }
    })

}