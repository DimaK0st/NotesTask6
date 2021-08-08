let servResponse = document.querySelector('#response');

document.forms.formsLogin.onsubmit = function (e) {
    let login = document.forms.formsLogin.inputLogin.value;
    let password = document.forms.formsLogin.inputPassword.value;
    let _token = document.forms.formsLogin._token.value;
    e.preventDefault();
    let objXMLHttpRequest = new XMLHttpRequest();

    objXMLHttpRequest.onreadystatechange = function () {
        if (objXMLHttpRequest.readyState === 4) {
            if (objXMLHttpRequest.status === 200) {
                let res = objXMLHttpRequest.responseText;
                switch (parseInt(res)) {
                    case 1:
                        servResponse.style.color = "blue";
                        servResponse.textContent = "Успешный вход";
                        window.location.href = '/'
                        break;
                    case 2:
                        alert("Вы ввели не верный пароль");
                        break;
                    case 3:
                        alert("Пользователь не существует");
                        break;
                }
            } else {
                alert('Error Code: ' + objXMLHttpRequest.status);
                alert('Error Message: ' + objXMLHttpRequest.statusText);
            }
        }
    }

    objXMLHttpRequest.open('POST', '/post/authorization');
    objXMLHttpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    objXMLHttpRequest.send("&login=" + login + "&password=" + password + "&_token=" + _token);
}
