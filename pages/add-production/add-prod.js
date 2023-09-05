var clearBtn = document.getElementById("clearBtn");
var addPersonButton = document.getElementById("add-person-submit");

function showHint(str, id) {
    if(str.length == 0) {
        document.getElementById(id).innerHTML = null;
        return;
    } else {
        const xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function() {
            console.log(this.responseText);
        }
        xmlhttp.open("POST", "get-person-hint.php");
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("name=" + str);
    }
}

function addPerson(name, dob) {
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function() {
        clearBtn.value = this.responseText;
    }
    xmlhttp.open("POST", "add-person.php");
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send('name=' + name);
}

clearBtn.onclick = () => {
    if(confirm("Clear")) {
        for(let x of document.getElementsByClassName("txtInp")) {
            x.value = null;
        }
    }
}

addPersonButton.onclick = () => {
    let nme = document.getElementById('person-name');
    addPerson(nme.value, null);
}