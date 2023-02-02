
     
 let colorNodes = document.getElementsByClassName("colorBox");
 let colorArray = new Array(colorElArray.length);
 
function getColors(){
     let colorNodes = document.getElementsByClassName("colorBox");
 let colorArray = new Array(colorElArray.length);
          for(i=0;i<=colorElArray.length-1;i++){
colorArray[i] = colorElArray[i].id;
}
    return colorArray;
}