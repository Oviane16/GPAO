
<?php
class create_folder
{

    public function __construct()
    {
    }
    public function creation_repertoire($rep, $lot)
    {
        if (is_dir('c:\work')== false){
            mkdir('c:\work', 0777);
        };
        if (is_dir('c:\work\atraiter')== false){
            mkdir('c:\work\atraiter', 0777);
        };
        if (is_dir('c:\work\fini')== false){
            mkdir('c:\work\fini', 0777);
        };
        if (is_dir('c:\work')== false){
            mkdir('c:\work', 0777);
        };
        if (is_dir('c:\work\\'.$rep)== false){
            mkdir('c:\work\\'.$rep, 0777);
        };
        if (is_dir('c:\work\atraiter\\' . $rep)== false){
            mkdir('c:\work\atraiter\\' . $rep, 0777);
        };
        if (is_dir('c:\work\fini\\' . $rep)== false){
            mkdir('c:\work\fini\\' . $rep, 0777);
        };
        if (is_dir('c:\work\\' .$rep.'\\'.$lot)== false){
            mkdir('c:\work\\'.$rep.'\\'.$lot, 0777);
        };

        if (is_dir('c:\work\\' .$rep.'\\'.$lot)== true){
            return "ok";
        }
        else{
            return "ko";
        };
    }
}

?>

