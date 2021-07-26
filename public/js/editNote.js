let countOfFields = document.getElementById('tempNoteAdd').value; // Текущее число полей
let curFieldNameId = 1; // Уникальное значение для атрибута name
let maxFieldLimit = 5; // Максимальное число возможных полей
tinymce.init({
    selector: '.inputTextNote',
    plugins: 'a11ychecker advcode casechange export formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
    toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter pageembed permanentpen table',
    toolbar_mode: 'floating',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
});

function deleteField(a, path) {
    if (path != 0) {
        document.getElementById('tempNoteDelete').value += path + ",";
    }
    console.log("A");
    console.log(a);
    let contDiv = a.parentNode;
    console.log(contDiv);
    contDiv = contDiv.parentNode;
    console.log(contDiv);
    contDiv.parentNode.removeChild(contDiv);
    countOfFields--;
    curFieldNameId--;
    return false;
}

function addField(init) {
    if (countOfFields >= maxFieldLimit && init != 'init') {
        alert("Количество добавляемых картинок достигло максимума (" + maxFieldLimit + " картинок)");
        return false;
    }
    countOfFields++;
    curFieldNameId++;
    let div = document.createElement("div");
    div.innerHTML = '<div style="display: flex"> <input required type="file" class="form-control pictures"  name="image_' + countOfFields + '" placeholder="Photo" accept="image/jpeg,image/png,image/gif"> <a href="#" onclick="return deleteField(this,0)">X</a></div>';

    document.getElementById("parentId").appendChild(div);

    return false;
}
