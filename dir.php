<?php
//        if ($handle = opendir('\\\\192.168.10.122\\images\\ACTE\\ACTE013\\ACTE0130001\\')) {
        if ($handle = opendir('c:\\work\\fini\\CHDE012\\')) {
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != "..") {
                    if (substr(strrchr($file, "."), 1 )=='xls')
                        echo $file . "<br/>\n";
                }
            }
            closedir($handle);
        }

?>
