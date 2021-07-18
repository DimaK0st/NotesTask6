var servResponse = document.querySelector('#response');

document.forms.formsRegister.onsubmit = function (e) {
    e.preventDefault();

    let email = document.forms.formsRegister.inputEmail.value;
    let login = document.forms.formsRegister.inputLogin.value;
    let password = document.forms.formsRegister.inputPassword.value;
    let rePassword = document.forms.formsRegister.inputRePassword.value;

    if (password !== rePassword) {
        alert("Passwords not coincidence");
    } else if (password === login) {
        alert("Login similar password");
    } else if (!/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]+\.[a-z]{2,8}$/.test(email)) {
        alert("Email not valid");
    } else {
        var objXMLHttpRequest = new XMLHttpRequest();

        objXMLHttpRequest.onreadystatechange = function () {
            if (objXMLHttpRequest.readyState === 4) {
                if (objXMLHttpRequest.status === 200) {
                    let res = objXMLHttpRequest.responseText;
                    switch (parseInt(res)) {
                        case 1:
                            servResponse.style.color = "blue";
                            servResponse.textContent = "Данные добавлены";
                            window.location.href = '/auth'
                            break;
                        case 2:
                            servResponse.style.color = "red";
                            servResponse.textContent = "Пользователь с таким логином/почтой уже зарегистрирован";
                            break;
                        case 3:
                            break;
                    }
                } else {
                    alert('Error Code: ' + objXMLHttpRequest.status);
                    alert('Error Message: ' + objXMLHttpRequest.statusText);
                }
            }
        }

        objXMLHttpRequest.open('POST', '/post/register');
        objXMLHttpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        objXMLHttpRequest.send("&email=" + email + "&login=" + login + "&password=" + password);
    }
}