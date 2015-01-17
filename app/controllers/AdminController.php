<?php
 
class AdminController extends BaseController {
 
    public function getIndex()
    {
        echo "admin";
    }
    public function getBackup()
    {
        $dbhost = 'localhost';
        $dbname = 'db_pdmu';
        $dbuser = 'root';
        $dbpass = '';
         
        $backup_file = $dbname . date("Y-m-d-H-i-s") . '.gz';
         
        // comandos a ejecutar
        $command = "mysqldump --opt -h $dbhost -u $dbuser -p$dbpass $dbname | gzip > $backup_file";
         
        // ejecución y salida de éxito o errores
        system($command,$output);
        echo $output;
    }
}

?>