var lockCount = 1;
var locked = false;

function gridLock() {
    lockCount++;
    if (lockCount % 2 === 0) {
        locked = true;
        document.getElementById("lockButt").textContent = "Unlock Grid";
    } else if (lockCount % 2 !== 0) {
        locked = false;
        document.getElementById("lockButt").textContent = "Lock Grid";
    }
}


/*for (let i = 1; i <= 64; i++) {
    var newDiv = document.createElement("div");
    newDiv.setAttribute("class", "box");
    newDiv.setAttribute("id", i);
    newDiv.textContent = "";
    var parentDiv = document.getElementById("grid");
    parentDiv.appendChild(newDiv);
}*/

var colorId = "black"
var colorSelector = document.getElementById("colors")
var colorBoxes = document.getElementsByClassName("colorBox")

colorSelector.addEventListener("click", (e) => {
    if (locked === false) {
        colorId = e.target.id;
    }
    for (let i = 0; i < colorBoxes.length; i++) {
        colorBoxes[i].style.border = "solid 1px black";
    }
    e.target.style.border = "solid 1.5px white";
})

colorSelector.addEventListener("dblclick", (e) => {
    colorId = e.target.id;
    var target = document.getElementById(colorId);
    target.outerHTML = "";

})

var gridBox = document.getElementById("grid");
gridBox.addEventListener("click", (e) => {
    var idName = e.target.id;
    var box = document.getElementById(idName);
    if (locked === false && idName !== "grid") {
        box.style.backgroundColor = colorId;
    }
})
let mouseDown = false;
gridBox.addEventListener("mousedown",(e)=>{
    mouseDown = true;
    console.log("mouse")
})
gridBox.addEventListener("mouseup",(e)=>{
    mouseDown = false;
})

document.addEventListener("mouseup",(e)=>{
   mouseDown = false;
})
gridBox.addEventListener("mousemove",(e)=>{
    if(mouseDown){
        console.log("moved");
        var idName = e.target.id;
        var box = document.getElementById(idName);
        if (locked === false && idName !== "grid") {
            box.style.backgroundColor = colorId;
        }
    }
})

gridBox.addEventListener("dblclick", (e) => {
    var idName = e.target.id;
    var box = document.getElementById(idName);
    if (locked === false && idName !== "grid") {
        box.style.backgroundColor = "white";
    }
})

var inputDiv = document.querySelector(".InputDiv");
var inputColor = document.getElementById("colorInput");
var inputButt = document.getElementById("colorButt");

function clearInput() {
    inputColor.value = "";
}

function isColor(strColor) {
    var s = new Option().style;
    s.color = strColor;
    return s.color === strColor;
}

function getColors() {
    let colorNodes = document.getElementsByClassName("colorBox");
    let colorElArray = Array.from(colorNodes);
    let colorArray = new Array(colorNodes.length);
    for (let i = 0; i <= colorElArray.length - 1; i++) {
        colorArray[i] = colorElArray[i].id;
    }
    return colorArray;
}

inputButt.addEventListener("click", (e) => {

    var color = inputColor.value;
    if (color !== "" && isColor(color) && !getColors().includes(color)) {
        var newColorBox = document.createElement("div");
        newColorBox.setAttribute("class", "colorBox");
        newColorBox.setAttribute("id", color);
        newColorBox.style.backgroundColor = color;
        var parent = document.querySelector("#colors");
        parent.appendChild(newColorBox)
        clearInput();


    } else {
        window.alert("not a valid color");
        clearInput();
    }


})

function resetGrid() {
    var divs = document.getElementsByClassName("box");
    var arrayDivs = Array.from(divs);
    for (let i = 0; i < arrayDivs.length; i++) {
        arrayDivs[i].style.backgroundColor = "white";
    }

}

function resetColors() {
    console.log("bla");
    var colors = document.getElementsByClassName("colorBox");
    var arrayColors = Array.from(colors);
    for (let i = 0; i < arrayColors.length; i++) {
        console.log(arrayColors[i]);
        arrayColors[i].outerHTML = "";
    }

}

function getColorsGrid() {
    var boxes = document.querySelectorAll(".box")
    var box_array = Array.from(boxes);
    let boxColorArray = {};
    let i = 0;
    box_array.forEach(box => {
        boxColorArray[i] = box.style.backgroundColor;
        let newInp = document.createElement("input");
        newInp.setAttribute("type", "hidden");
        newInp.setAttribute("name", "g" + i);
        //newInp.setAttribute("value",boxColorArray[i]);
        if (boxColorArray[i] === "") {
            newInp.value = "white";
        } else {
            newInp.value = boxColorArray[i];
        }

        let parentDiv = document.getElementById("parent");
        parentDiv.appendChild(newInp);
        i++;
    })
}

function randomIntFromInterval(min, max) { // min and max included
    return Math.floor(Math.random() * (max - min + 1) + min)
}

function createRandomGrid() {
    let colorArray = ["red", "green", "blue", "darkred", "darkblue", "darkgreen", "purple", "orange", "yellow", "lightblue", "white", "white", "white"];
    for (let i = 0; i < 64; i++) {
        let randIndex = randomIntFromInterval(0, colorArray.length - 1);
        let currentBox = document.getElementById(i.toString());
        currentBox.style.backgroundColor = colorArray[randIndex];
    }
}

//check for mouse drag