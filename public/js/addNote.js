let countOfFields = 1; // Текущее число полей
let curFieldNameId = 1; // Уникальное значение для атрибута name
let maxFieldLimit = 5; // Максимальное число возможных полей


function deleteField(a) {
    let contDiv = a.parentNode;
    contDiv.parentNode.removeChild(contDiv);
    countOfFields--;
    curFieldNameId--;
    return false;
}
function addField() {
    if (countOfFields >= maxFieldLimit) {
        alert("Количество добавляемых картинок достигло максимума (" + maxFieldLimit+" картинок)");
        return false;
    }
    countOfFields++;
    curFieldNameId++;
    let div = document.createElement("div");
    div.innerHTML = '<div style="display: flex"> <input required type="file" class="form-control pictures"  name="image_'+countOfFields+'" placeholder="Photo" accept="image/jpeg,image/png,image/gif"> <a href="#" onclick="return deleteField(this)">X</a></div>';

    document.getElementById("parentId").appendChild(div);
    return false;
}

/*
document.forms.formsRegister.onsubmit = function (e) {
    e.preventDefault();


    var list=document.getElementsByClassName("pictures");
    console.log(list)
    for (var i=0; i<list.length; i++)
    {
        console.log(list[i].value)
        console.log(list[i].files)

    }


    var file = document.getElementById("myFile").files[0]
    var formData = new FormData();
    formData.append("thefile", file);

    console.log(formData)


    let _token=document.forms.formsRegister._token.value;

        var objXMLHttpRequest = new XMLHttpRequest();

        objXMLHttpRequest.onreadystatechange = function () {
            console.log(objXMLHttpRequest)
            if (objXMLHttpRequest.readyState === 4) {
                if (objXMLHttpRequest.status === 200) {
                    let res = objXMLHttpRequest.responseText;
                    alert(res)
                    switch (parseInt(res)) {
                        case 1:
                            servResponse.style.color = "blue";
                            servResponse.textContent = "Данные добавлены";
                            window.location.href = '/authorization'
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

            objXMLHttpRequest.open('POST', '/post/addNote');
            objXMLHttpRequest.setRequestHeader('Content-Type', 'multipart/form-data');
            objXMLHttpRequest.send(formData);
        }
}
*/

