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

    let scanLogBox = $('#scanLogBox');
    scanLogBox.hide();


    const logOutBtn = document.querySelector('#logoutBtn');
    const initateScanBtn = document.querySelector('#initateScanBtn');
    const viewScannedResultsBtn = document.querySelector('#viewScannedResultsBtn');
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
                window.location.href = window.location.protocol + '//' + window.location.host;
            } else {
                appendAlert(jsonResponse.message, 'warning')
            }
        } catch (error) {
            appendAlert('An error occurred while signing out ' + error, 'warning')
        } finally {
        }
    });

    var stopFetching = false; // Flag variable to control the fetching process

    function fetchLog(url) {
        $.ajax({
            url: '../../../admin/ajax/process-scan.php', // Replace 'log.php' with the actual PHP file name
            data: {url: url},
            dataType: 'html',
            type: 'POST',
            success: function (response) {
                $('#log').html(response);

                if (response.includes('Homepage scan completed')) {
                    stopFetching = true;
                    return;
                }

                if (!stopFetching) {
                    setTimeout(function () {
                        fetchLog(url);
                    }, 1000);
                }
            },
            error: function () {
                $('#log').html('Error fetching log.');
                if (!stopFetching) {
                    setTimeout(function () {
                        fetchLog(url);
                    }, 1000);
                }
            }
        });
    }


    initateScanBtn.addEventListener('click', async (event) => {
        event.preventDefault();
        let webUrlInput = $('#website').val();
        if (webUrlInput) {
            scanLogBox.show();
            fetchLog(webUrlInput);
        } else {
            appendAlert('Please enter a valid website url', 'warning')
        }

    });

    viewScannedResultsBtn.addEventListener('click', async (event) => {
        event.preventDefault();

        // refresh page

    });

});
