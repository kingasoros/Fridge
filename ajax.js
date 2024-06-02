document.addEventListener('DOMContentLoaded', function() {
    fetchUserData();

    document.getElementById('submit').addEventListener('click', function(event) {
        event.preventDefault();
        if (validateForm()) {
            saveChanges();
        }
    });
});

function fetchUserData() {
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "fetch_user_data.php", true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            let response = JSON.parse(xhr.responseText);
            if (response.status === 'success') {
                let data = response.data;
                document.getElementById('u_name').innerText = data.user_name;
                document.getElementById('f_name').innerText = data.first_name;
                document.getElementById('l_name').innerText = data.last_name;
                document.getElementById('phone').innerText = data.phone_numb;
            } else {
                displayResponse(response);
            }
        }
    };
    xhr.send();
}

function validateForm() {
    let u_name = document.getElementById('u_name').innerText;
    let f_name = document.getElementById('f_name').innerText;
    let l_name = document.getElementById('l_name').innerText;
    let phone = document.getElementById('phone').innerText;

    let isValid = true;

    if (u_name === "") {
        showErrorMessage(document.getElementById('u_name'), 'Username has to be provided');
        isValid = false;
    } else {
        hideErrorMessage(document.getElementById('u_name'));
    }

    if (f_name === "") {
        showErrorMessage(document.getElementById('f_name'), 'First name has to be provided');
        isValid = false;
    } else {
        hideErrorMessage(document.getElementById('f_name'));
    }

    if (l_name === "") {
        showErrorMessage(document.getElementById('l_name'), 'Last name has to be provided');
        isValid = false;
    } else {
        hideErrorMessage(document.getElementById('l_name'));
    }

    if (phone === "") {
        showErrorMessage(document.getElementById('phone'), 'Phone number has to be provided');
        isValid = false;
    } else {
        hideErrorMessage(document.getElementById('phone'));
    }

    return isValid;
}

function saveChanges() {
    sendData();
}

function sendData() {
    let u_name = document.getElementById('u_name').innerText;
    let f_name = document.getElementById('f_name').innerText;
    let l_name = document.getElementById('l_name').innerText;
    let phone = document.getElementById('phone').innerText;


    let data = {
        user_name: u_name,
        first_name: f_name,
        last_name: l_name,
        phone_numb: phone
    };

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "update_user_data.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");

    alert(`The editing is succesfull.`);

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            let response = JSON.parse(xhr.responseText);
            displayResponse(response);
        }
    };

    xhr.send(JSON.stringify(data));
}

function displayResponse(response) {
    let responseDiv = document.getElementById('responseMessage');
    responseDiv.innerHTML = '';

    if (response.status === 'success') {
        responseDiv.style.color = 'green';
        responseDiv.textContent = response.message;
    } else if (response.status === 'error') {
        responseDiv.style.color = 'red';
        response.errors.forEach(function(error) {
            let errorElement = document.createElement('p');
            errorElement.textContent = error;
            responseDiv.appendChild(errorElement);
        });
    }
}

function showErrorMessage(element, message) {
    let errorSpan = element.nextElementSibling;
    if (!errorSpan || !errorSpan.classList.contains('error-message')) {
        errorSpan = document.createElement('span');
        errorSpan.classList.add('error-message');
        element.parentNode.insertBefore(errorSpan, element.nextSibling);
    }
    errorSpan.textContent = message;
}

function hideErrorMessage(element) {
    let errorSpan = element.nextElementSibling;
    if (errorSpan && errorSpan.classList.contains('error-message')) {
        errorSpan.textContent = '';
    }
}
