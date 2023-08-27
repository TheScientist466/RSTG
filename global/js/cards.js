const leftButton = document.getElementById('left-but');
const rightButton = document.getElementById('right-but');

var imgs = document.getElementsByClassName('gallery-item');
changeBgToSrc();

//setInterval(goRight, 2500);

function goRight() {
    var index;
    for(var i = 0; i < imgs.length; i++) {
        for(c of imgs[i].classList) {
            if(c.startsWith('gallery-item-1')) {
                imgs[i].classList.remove('gallery-item-1');
                index = (i + 1) < imgs.length ? (i + 1) : 0;
                break;
            }
        }
    }
    var ctr = 1;
    while(ctr <= 5) {
        imgs[index].classList.remove('gallery-item-'.concat((ctr + 1).toString()));
        imgs[index].classList.add('gallery-item-'.concat(ctr.toString()));
        index = ((index + 1) < imgs.length) ? (index + 1) : 0;
        ctr++;
    }
}

rightButton.onclick = () => {
    var index;
    for(var i = 0; i < imgs.length; i++) {
        for(c of imgs[i].classList) {
            if(c.startsWith('gallery-item-1')) {
                imgs[i].classList.remove('gallery-item-1');
                index = (i + 1) < imgs.length ? (i + 1) : 0;
                break;
            }
        }
    }
    var ctr = 1;
    while(ctr <= 5) {
        imgs[index].classList.remove('gallery-item-'.concat((ctr + 1).toString()));
        imgs[index].classList.add('gallery-item-'.concat(ctr.toString()));
        index = ((index + 1) < imgs.length) ? (index + 1) : 0;
        ctr++;
    }
    changeBgToSrc();
}

leftButton.onclick = () => {
    var index;
    for(var i = 0; i < imgs.length; i++) {
        for(c of imgs[i].classList) {
            if(c.startsWith('gallery-item-1')) {
                index = (i - 1) < 0 ? imgs.length - 1 : i - 1;
                found = true;
                break;
            }
        }
    }
    var ctr = 0;
    while(ctr < 5) {
        imgs[index].classList.remove('gallery-item-'.concat(ctr.toString()));
        imgs[index].classList.add('gallery-item-'.concat((ctr + 1).toString()));
        index = ((index + 1) < imgs.length) ? (index + 1) : 0;
        ctr++;
    }
    imgs[index].classList.remove('gallery-item-'.concat(ctr.toString()));
    changeBgToSrc()
}

function changeBgToSrc() {
    document.getElementById('festival-card-backdrop').style.backgroundImage = ('url(' + document.getElementsByClassName('gallery-item-3')[0].src + ')');
}