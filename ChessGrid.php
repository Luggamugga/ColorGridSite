<?php
$chessPiecesUniCodeWhite = array(
    "rook" => "&#x2656",
    "knight" => "&#x2658",
    "bishop" => "&#x2657",
    "king" => "&#x2654",
    "queen" => "&#x2655",
    "pawn" => "&#x2659",
);
$chessPiecesUniCodeBlack = array(
    "rook" => "&#x265C",
    "knight" => "&#x265E",
    "bishop" => "&#x265D",
    "king" => "&#x265A",
    "queen" => "&#x265B",
    "pawn" => "&#x265F"
);
$keysWhite = array_keys($chessPiecesUniCodeWhite);
$keysBlack = array_keys($chessPiecesUniCodeBlack);
$rowcount = 1;
$columncount = 0;

for ($i = 1; $i <= 64; $i++) {
    //increase column num:
    $columncount++;
    //set chess board pattern
    if ($i % 2 === 0 && $rowcount % 2 !== 0) {
        echo "<div class='chessGridBox black' id='{$columncount},{$rowcount}'>";
    } else if ($rowcount % 2 !== 0 && $i % 2 !== 0) {
        echo "<div class='chessGridBox white' id='{$columncount},{$rowcount}'>";
    } else if ($rowcount % 2 === 0 && $i % 2 === 0) {
        echo "<div class='chessGridBox white' id='{$columncount},{$rowcount}'>";
    } else if ($rowcount % 2 === 0 && $i % 2 !== 0) {
        echo "<div class='chessGridBox black' id='{$columncount},{$rowcount}'>";
    }
    //set pieces:
    if ($i <= 5) {
        echo "<div class='chessPieceWhite chessPiece {$keysWhite[$i-1]}'>{$chessPiecesUniCodeWhite[$keysWhite[$i-1]]}</div>";
    } else if($i <= 8){
        echo "<div class='chessPieceWhite chessPiece {$keysWhite[8-$i]}'>{$chessPiecesUniCodeWhite[$keysWhite[8-$i]]}</div>";
    } else if($i <= 16){
        echo "<div class='chessPieceWhite chessPiece pawn'>{$chessPiecesUniCodeWhite["pawn"]}</div>";
    }
     if($i > 48 && $i <= 56){
        echo "<div class='chessPieceBlack chessPiece pawn'>{$chessPiecesUniCodeBlack["pawn"]}</div>";
    } else if($i > 56 && $i <= 61){
        echo "<div class='chessPieceBlack chessPiece {$keysBlack[$i-57]}'>{$chessPiecesUniCodeBlack[$keysBlack[$i-57]]}</div>";
    } else if($i>61) {
        echo "<div class='chessPieceBlack chessPiece {$keysBlack[64-$i]}'>{$chessPiecesUniCodeBlack[$keysBlack[64-$i]]}</div>";
    }

    echo "</div>";

    //increment row
    if ($i % 8 === 0) {
        $rowcount++;
        //set column to 0 on new row
        $columncount = 0;
    }

}


?>