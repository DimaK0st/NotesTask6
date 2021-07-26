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
        alert("Количество добавляемых картинок достигло максимума (" + maxFieldLimit + " картинок)");
        return false;
    }
    countOfFields++;
    curFieldNameId++;
    let div = document.createElement("div");
    div.innerHTML = '<div style="display: flex"> <input required type="file" class="form-control pictures"  name="image_' + countOfFields + '" placeholder="Photo" accept="image/jpeg,image/png,image/gif"> <a href="#" onclick="return deleteField(this)">X</a></div>';

    document.getElementById("parentId").appendChild(div);
    return false;
}
