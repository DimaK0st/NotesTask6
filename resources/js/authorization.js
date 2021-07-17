let servResponse = document.querySelector('#response');

document.forms.formsLogin.onsubmit= function (e){
    let login=document.forms.formsLogin.inputLogin.value;
    let password=document.forms.formsLogin.inputPassword.value;
    e.preventDefault();
    let objXMLHttpRequest = new XMLHttpRequest();

    objXMLHttpRequest.onreadystatechange = function () {
        if (objXMLHttpRequest.readyState === 4) {
            if (objXMLHttpRequest.status === 200) {
                let res= objXMLHttpRequest.responseText;
                switch (parseInt(res)) {
                    case 1:
                        servResponse.style.color = "blue";
                        servResponse.textContent = "Успешный вход";
                        window.location.href = '/successAuth'
                        break;
                    case 2:
                        servResponse.style.color = "red";
                        servResponse.textContent = "Вы ввели не верные данные/ пользователь не существует";
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

    objXMLHttpRequest.open('POST', '/post/auth');
    objXMLHttpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    objXMLHttpRequest.send("&login="+login+ "&password="+password);
}
