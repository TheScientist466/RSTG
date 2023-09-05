const editProdForm = document.getElementById("edit-prod");

editProdForm.getElementsByClassName('toggle-passwd-panel')[0].setAttribute('disabled', '');

function selAndGetProd(i) {
    sel(i);
    editProdForm.getElementsByClassName('toggle-passwd-panel')[0].removeAttribute('disabled');
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function() {
        var prod = JSON.parse(this.responseText);
        prod.Dir = prod.Dir == null ? -1 : prod.Dir;
        prod.Wri = prod.Wri == null ? -1 : prod.Wri;
        prod.Lng = prod.Lng == null ? -1 : prod.Lng;
        editProdForm.querySelector("[name=\"name\"]").value = prod.Name;
        sel(editProdForm.querySelector('[name="Dir"]').parentElement.querySelector("[data-val=\"" + prod.Dir + "\"]"));
        sel(editProdForm.querySelector('[name="Wri"]').parentElement.querySelector("[data-val=\"" + prod.Wri + "\"]"));
        sel(editProdForm.querySelector('[name="Lng"]').parentElement.querySelector("[data-val=\"" + prod.Lng + "\"]"));
    }
    xmlhttp.open("POST", "get-prod.php");
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("id=" + i.attributes['data-val'].value);
}