/*!
    * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2023 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
//
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});

$(function () {

    const logOutBtn = document.querySelector('#logoutBtn');
    const alertPlaceholder = document.querySelector('#liveAlertPlaceholder');


    const appendAlert = (message, type) => {
        const wrapper = document.createElement('div');
        wrapper.innerHTML = [
            `<div class="alert alert-${type} alert-dismissible" role="alert">`,
            `   <div>${message}</div>`,
            '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
            '</div>'
        ].join('');

        alertPlaceholder.append(wrapper);

        setTimeout(() => {
            wrapper.remove();
        }, 10000);
    };


    logOutBtn.addEventListener('click', async (event) => {
        event.preventDefault();
        try {
            const url = new URL('../../../public/ajax/process-auth.php', window.location.href);
            const params = {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: new URLSearchParams({
                    action: 'logout'
                })
            };
            const response = await fetch(url, params);
            const jsonResponse = await response.json();

            if (jsonResponse.status && jsonResponse?.status_code === 200) {
                window.location.href = window.location.hostname + '/index.php';
            } else {
                appendAlert(jsonResponse.message, 'warning')
            }
        } catch (error) {
            appendAlert('An error occurred while signing out ' + error, 'warning')
        } finally {
        }
    });

});
