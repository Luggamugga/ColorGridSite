<?php
function returnDBCreds(){
    if ( str_starts_with($_SERVER["HTTP_HOST"], "localhost")){
        return ['localhost', "gridDB", "root", "asdf"];
    } else {
        return ["db5011366642.hosting-data.io", "dbs9593474", "dbu1596496", "IonosPass123!"];
    }
}
