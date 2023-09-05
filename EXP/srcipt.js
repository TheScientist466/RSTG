var selectBtns = document.getElementsByClassName('select-btn');
var options = document.getElementsByClassName('option');

for(s of selectBtns) {
    s.addEventListener("click", (evt) => {
        evt.currentTarget.parentElement.classList.toggle('active');
    })
}

function sel(toSel) {
    var mElement = toSel.parentElement.parentElement.parentElement;
    mElement.getElementsByClassName('sel-name')[0].innerHTML = toSel.innerHTML;
    toSel.parentElement.parentElement.getElementsByClassName('val-encoder')[0].value = toSel.value;
    mElement.classList.remove('active');
}