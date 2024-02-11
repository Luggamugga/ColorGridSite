<?php
for ($i = 0; $i < 64; $i++) {
    $string = "<div class='box' id='" . $i . "' style='background-color:" . $array["g" . $i] . "'></div>";
    echo $string;
}

?>
