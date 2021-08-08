let countOfFields
if (!document.getElementById('tempNoteAdd')===null)
{
    countOfFields=document.getElementById('tempNoteAdd').value
}
else {
    countOfFields=0
}
let curFieldNameId = 1;
let maxFieldLimit = 5;
tinymce.init({
    selector: '.inputTextNote',
    plugins: 'a11ychecker advcode casechange export formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
    toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter pageembed permanentpen table',
    toolbar_mode: 'floating',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
});

btnAddField.onclick = function() {
    addField();
};

var list=document.getElementsByClassName("figure-delete");
let length=list.length
for (var i=0; i<length; i++)
{
    let content=list[i]
    let path=document.getElementById("id-figure-delete-"+(i+1)).getAttribute('src')
    list[i].addEventListener('click', function(){
        deleteField(content,path);
    }, false);

}


function deleteField(a, path) {
    alert(a)
    if (path != 0) {
        document.getElementById('tempNoteDelete').value += path + ",";
    }
    contDiv = a.parentNode;
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
