const generatebtn = document.querySelector(".generatebtn");
const mickeylogo = document.querySelector(".container");
const title = document.querySelector(".title");
const countdown = document.querySelector(".countdown");
const timer = document.querySelector(".timer");
const filmchoice = document.querySelector(".filmchoice");
const container = document.querySelector(".container") + document.querySelector(".container flipped");
let visible = true;
let unflipped = true;
let buttonClicks = 0;
let counter = 0;
let filmcount = 0;

function numberOfChoices() {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            filmcount = this.responseText;
        }
    };
    xmlhttp.open("GET", "dbsize.php?q=", true);
    xmlhttp.send();
}

numberOfChoices(); // Calls function that works out how many rows are in the table we cycle through


function rerollhandler() {
    if (unflipped) {
        mickeylogo.classList.add("flipped");
        generatebtn.textContent = "Pick something else!"
        unflipped = false;
    } else if (!unflipped) {
        mickeylogo.classList.remove("flipped");
        unflipped = true;
    }
}

function divhandler() {
    if (visible) {
        title.remove();
        countdown.remove();
        timer.remove()
        visible = false;
    } 
}

function pageReload() {
    buttonClicks++;
    if (buttonClicks == filmcount) {
        generatebtn.textContent = "From the Top!";
        generatebtn.addEventListener("click", () => {
            location.reload();
        })
    }
}

generatebtn.addEventListener("click", () => {
    rerollhandler();
    counter++;
    // console.log(counter);
    // console.log(filmcount); testing for table size and counter input
    pageReload();
})

function chooseFilm() {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            divhandler();
            filmchoice.innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "choosefilm.php?q=", true);
    xmlhttp.send();
}
