var clearBtn = document.getElementById("clearBtn");

function showHint(str, id) {
    console.log("hello");
    if(str.length == 0) {
        document.getElementById(id).innerHTML = null;
        return;
    } else {
        const xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function() {
            document.getElementById(id).innerHTML = this.responseText;
        }
        xmlhttp.open("POST", "get-person-hint.php");
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("name=" + str);
    }
}

clearBtn.onclick = () => {
    if(confirm("Clear")) {
        for(let x of document.getElementsByClassName("txtInp")) {
            x.value = null;
        }
    }
}