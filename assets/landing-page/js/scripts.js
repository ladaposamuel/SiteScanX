/*!
* Start Bootstrap - Small Business v5.0.6 (https://startbootstrap.com/template/small-business)
* Copyright 2013-2023 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-small-business/blob/master/LICENSE)
*/

$(function () {

    const loginBtn = document.querySelector('#loginbtn');
    const emailInput = document.querySelector('#inputEmail');
    const passwordInput = document.querySelector('#inputPassword');
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


    loginBtn.addEventListener('click', async (event) => {
        event.preventDefault();
        const email = emailInput.value || '';
        const password = passwordInput.value || '';
        loginBtn.innerHTML = 'Signing In...';
        loginBtn.disabled = true;
        try {
            const url = new URL('../../../public/ajax/process-auth.php', window.location.href);
            const params = {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: new URLSearchParams({
                    action: 'login',
                    email,
                    password,
                })
            };
            const response = await fetch(url, params);
            const jsonResponse = await response.json();

            if (jsonResponse.status && jsonResponse?.status_code === 200) {
                window.location.href = '/admin/dashboard.php';
            } else {
                appendAlert(jsonResponse.message, 'warning')
            }
        } catch (error) {
            loginBtn.disabled = false;
            loginBtn.innerHTML = 'Sign In';
            appendAlert('An error occurred while signing in ' + error, 'warning')
        } finally {
            loginBtn.disabled = false;
            loginBtn.innerHTML = 'Sign In';
        }
    });

});
