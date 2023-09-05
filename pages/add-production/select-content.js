var selectBtns = document.getElementsByClassName('select-btn');
var options = document.getElementsByClassName('option');
var tPannel = document.getElementsByClassName('toggle-passwd-panel');
var passwdArea = document.getElementsByClassName('passwd-area')[0];

for(p of tPannel) {
    p.addEventListener("click", (evt) => {
        var passwdPanel = document.getElementsByClassName('passwd-panel')[0];
        var formContent = document.getElementsByTagName('body')[0];
        var submitButton = document.getElementById('form-submit');
        submitButton.setAttribute('form', evt.currentTarget.parentElement.parentElement.getAttribute('id'));
        passwdPanel.classList.toggle('active');
        formContent.classList.toggle('no-scroll');
        passwdArea.value = null;
    })
}

for(s of selectBtns) {
    s.addEventListener("click", (evt) => {
        evt.currentTarget.parentElement.classList.toggle('active');
    })
}

function sel(toSel) {
    var mElement = toSel.parentElement.parentElement.parentElement;
    mElement.getElementsByClassName('sel-name')[0].innerHTML = toSel.innerHTML;
    toSel.parentElement.parentElement.getElementsByClassName('val-encoder')[0].value = toSel.attributes['data-val'].value == '-1' ? null : toSel.attributes['data-val'].value;
    //console.log(toSel.parentElement.parentElement.getElementsByClassName('val-encoder')[0].value);
    //console.log(toSel.attributes['data-val'].value);
    mElement.classList.remove('active');
}

function submitScript(form) {
    form.getElementsByClassName('passwd-container')[0].value = passwdArea.value;
    //alert(passwdArea.value);
}