let whitePieces = document.querySelectorAll(".chessPieceWhite")
let blackPieces = document.querySelectorAll(".chessPieceBlack")
let chessPieces = document.querySelectorAll(".chessPiece")
let gridBoxes = document.querySelectorAll(".chessGridBox")
let grid = document.querySelector(".chessGrid")
let chessTitle = document.querySelector(".chessTitle")
let lockedPiece = null;
let turn = "White";
let turnSignals = [
    document.querySelector(".turnSignalWhite"),
    document.querySelector(".turnSignalBlack")
]
turnSignals[0].style.display = "block";
let step = 0;

let isChecked = false // when true in array: ["White",true]

function chgTurnTo() {
    lockedPiece = null;
    if (turn === "White") {
        turn = "Black";
        turnSignals[1].style.display = "block";
        turnSignals[0].style.display = "none";
    } else {
        turn = "White"
        turnSignals[0].style.display = "block";
        turnSignals[1].style.display = "none";
    }
}

function getTurnOpposite() {
    if (turn === "White") {
        return "Black"
    } else {
        return "White"
    }
}

document.addEventListener("click", (evt) => {
    console.log(evt.target)
    if ((evt.target.className.includes("chessPiece" + turn) || evt.target.className.includes("chessGridBox")) && !lockedPiece) {
        if (evt.target.className.includes("chessGridBox") && evt.target.firstChild && evt.target.firstChild.className.includes(turn)) {
            evt.target.firstChild.style.backgroundColor = "red";
            lockedPiece = evt.target.firstChild;
        } else if (evt.target.className.includes("chessPiece" + turn)) {
            evt.target.style.backgroundColor = "red";
            lockedPiece = evt.target
        } else {
            lockedPiece = null;
            evt.target.style.backgroundColor = "";
        }

        gridBoxes.forEach((e) => {
            e.addEventListener("click", (e) => {
                let coords;
                console.log(e.target.className)
                if (e.target.className.includes("chessPiece")) {
                    coords = e.target.parentNode.id;
                } else if (e.target.className.includes("chessGridBox")) {
                    coords = e.target.id;
                }

                if (lockedPiece && e.target !== lockedPiece && moveCheck(lockedPiece, coords)) {
                    lockedPiece.remove();
                    if (e.target.className.toString().includes("chessPiece" + getTurnOpposite())) {
                        e.target.parentNode.appendChild(lockedPiece)
                    } else {
                        e.target.appendChild(lockedPiece);
                    }
                    lockedPiece.style.backgroundColor = "";
                    let piece = lockedPiece.className.split(" ") //chessPiece + turn   chessPiece  pieceType
                    let pieceType = piece[2]
                    let xy = coords.split(",")
                    let king = document.querySelector(".king.chessPiece" +getTurnOpposite())
                    console.log(king)
                    let kingPos = king.parentElement.id.split(",")
                    if(calcPossibleMoves(pieceType,turn,xy[0],xy[1]).toString().includes(kingPos.toString())){
                        isChecked = [getTurnOpposite(),true]
                        king.style.backgroundColor = "red"
                        chessTitle.innerHTML = "<b>CHECK!</b>"

                    } else {
                        isChecked = false
                    }
                    console.log(isChecked)
                    lockedPiece = null;
                    chgTurnTo();
                } else {
                    document.querySelector(".chessMsg").innerHTML = "Its " + turn + "'s turn"
                }
            })
        })
    } else if (evt.target.className.includes("chessMain")) {
        chessPieces.forEach((e) => {
            e.style.backgroundColor = "";
            lockedPiece = null;
        })
    }
    //deleting killed piece and checking if pawn gets upgrade
    document.querySelectorAll(".chessGridBox").forEach(e => {
        if (e.childElementCount > 1) {
            e.firstChild.remove()
        }
        if (e.id.endsWith("8") && e.querySelector(".pawn")) {
            //i apologize
            if (e.querySelector(".chessPieceWhite")) {
                e.firstChild.textContent = "\u2655"
            } else {
                e.firstChild.textContent = "\u265B"
            }
        }
    })
})

function isCheckMate(pieceColor){
}


function moveCheck(elem, targetPos) {

    let piece = elem.className.split(" ")
    let pieceType = piece[2]
    let pieceColour;
    //deriving piece colour from classname
    if (piece[0].includes("White")) {
        pieceColour = "White";
    } else {
        pieceColour = "Black";
    }
    let piecePosition = elem.parentNode.id.split(",")
    let xPos = parseInt(piecePosition[0])
    let yPos = parseInt(piecePosition[1])
    let Dest = targetPos.split(",")
    let xDest = parseInt(Dest[0]);
    let yDest = parseInt(Dest[1]);
    Dest = [xDest, yDest];
    let possibleMoves = calcPossibleMoves(pieceType, pieceColour, xPos, yPos)
    console.log(Dest)
    console.log(possibleMoves)
    return (possibleMoves.toString().includes(Dest.toString()));
}

function calcPossibleMoves(pieceType, pieceColour, xPos, yPos) {
    let possibleMoves = [];
    //pawn direction needed cause of black and white pieces
    let pawnDirection = 0;

    //direction variables for bishop and knight
    let Coords = [xPos, yPos]

    //in order to check all 4 directions an array is needed
    //x,y   x,-y      -x,y      -x,-y
    let TwoDDirectionArr = [[1, 1], [1, -1], [-1, 1], [-1, -1]]
    let step = 0;
    let TwoDDirection = [1, 1]// changes according to step
    let x = Coords[0]
    let y = Coords[1]
    //for knight and king:
    let x2 = xPos;
    let y2 = yPos;

    switch (pieceType) {
        case "pawn":
            if (pieceColour === "White") {
                pawnDirection = 1;
            } else {
                pawnDirection -= 1;
            }
            let diagRight = document.getElementById(xPos + 1 + "," + (yPos + pawnDirection)) ?? null
            let diagLeft = document.getElementById(xPos - 1 + "," + (yPos + pawnDirection)) ?? null
            if ((yPos === 2 && pieceColour === "White") || (yPos === 7 && pieceColour === "Black")) {
                possibleMoves = [[xPos, yPos + pawnDirection], [xPos, yPos + pawnDirection * 2]]
            } else {
                possibleMoves = [[xPos, yPos + pawnDirection]]
            }
            if (diagRight && diagRight.querySelector(".chessPiece")) {
                let pos = diagRight.id.split(",")
                possibleMoves.push([parseInt(pos[0]), parseInt(pos[1])])
            }
            if (diagLeft && diagLeft.querySelector(".chessPiece")) {
                let pos = diagLeft.id.split(",")
                possibleMoves.push([parseInt(pos[0]), parseInt(pos[1])])
            }
            break;
        case "rook":
            let i;
            for (i = xPos + 1; i <= 8; i++) {
                if (document.getElementById(i + "," + (yPos)).querySelector(".chessPiece" + pieceColour) !== null) {
                    break;
                } else {
                    possibleMoves.push([i, yPos])
                }
            }
            for (i = xPos - 1; i > 0; i--) {
                if (document.getElementById(i + "," + (yPos)).querySelector(".chessPiece" + pieceColour) !== null) {
                    break;
                } else {
                    possibleMoves.push([i, yPos])
                }
            }
            for (i = yPos + 1; i <= 8; i++) {
                if (document.getElementById(xPos + "," + (i)).querySelector(".chessPiece" + pieceColour) !== null) {
                    break;
                } else {
                    possibleMoves.push([xPos, i])
                }
            }
            for (i = yPos - 1; i > 0; i--) {
                if (document.getElementById(xPos + "," + (i)).querySelector(".chessPiece" + pieceColour) !== null) {
                    break;
                } else {
                    possibleMoves.push([xPos, i])
                }
            }
            break;
        case "bishop":

            while (step < 4) {
                TwoDDirection = TwoDDirectionArr[step];
                console.log("Step:" + step + "  direction: " + TwoDDirection)
                do {
                    //incrementing x and y by their "Direction" according to the step
                    x += TwoDDirection[0]
                    y += TwoDDirection[1]

                    console.log(x + " , " + y)
                    if (!document.getElementById(x + "," + y) || document.getElementById(x + "," + y).querySelector(".chessPiece" + pieceColour)) {

                        console.log("break at: " + x + " , " + y)
                        break;
                    } else {
                        possibleMoves.push([x, y])
                    }

                } while (x !== 8 && y !== 8);
                ++step;
                x = xPos
                y = yPos
            }
            break;
        case "knight":
            console.log("knight")
            step = 0;
            let j = 0;
            x = xPos = x2
            y = yPos = y2
            //using same direction technique as bishop
            for (j = 0; j < 4; j++) {
                x = xPos
                x2 = xPos
                y = yPos
                y2 = yPos
                TwoDDirection = TwoDDirectionArr[step];
                // first move variant of knight
                x += TwoDDirection[0]
                y += TwoDDirection[1] * 2
                // second variant
                x2 +=  TwoDDirection[0] * 2
                y2 += TwoDDirection[1]
                console.log(x2 + "  " + y2)
                if (document.getElementById(x + "," + y) && !document.getElementById(x + "," + y).querySelector(".chessPiece" + pieceColour)) {
                    possibleMoves.push([x, y])
                }
                if (document.getElementById(x2 + "," + y2) && !document.getElementById(x2 + "," + y2).querySelector(".chessPiece" + pieceColour)) {
                    possibleMoves.push([x2, y2])
                }
                ++step

            }
            break;
        case "queen":
            possibleMoves = calcPossibleMoves("rook", pieceColour, xPos, yPos) + calcPossibleMoves("bishop", pieceColour, xPos, yPos)
            break;
        case "king":
            let k = 0;
             step = 0;
             x = xPos = x2
            y = yPos = y2
            let nonDiagDirectionArr = [[1, 0], [0, 1], [0, -1], [-1, 0]]
            let nonDiagDirection = [1, 0]
            for (k; k < 8; k++) {
                TwoDDirection = TwoDDirectionArr[step];
                nonDiagDirection = nonDiagDirectionArr[step];
                //for diagonal
                x += TwoDDirection[0]
                y += TwoDDirection[1]
                // for vertical and horizontal axis moves
                x2 += nonDiagDirection[0]
                y2 += nonDiagDirection[1]
                if (document.getElementById(x + "," + y) && !document.getElementById(x + "," + y).querySelector(".chessPiece" + pieceColour)) {
                    possibleMoves.push([x, y])
                }
                if (document.getElementById(x2 + "," + y2) && !document.getElementById(x2 + "," + y2).querySelector(".chessPiece" + pieceColour)) {
                    possibleMoves.push([x2, y2])
                }
                if(k % 2 !== 0){
                    step++
                }
                x = xPos
                x2 = xPos
                y = yPos
                y2 = yPos
            }
            break;
    }
    return possibleMoves;


}