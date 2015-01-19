<?php
 
class AdminController extends BaseController {
 
    public function getIndex()
    {
        $backups = array();
        $directorio = opendir("backups"); //ruta actual
        while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
        {
            if (!is_dir($archivo))//verificamos si es o no un directorio
            {
                $backups[] = $archivo;
            }
        }
        return View::make('administracion.administracion')->with('backups',$backups);
    }
    public function getBackup()
    {
        AdminController::backup_tables('localhost','root','','db_pdmu');
        // DB::table('donativos')->truncate();
        // DB::table('arrestos')->truncate();
        // DB::table('asistencias')->truncate();
        // DB::table('reminders')->truncate();
        return Redirect::to('admin');
    }
    public function backup_tables($host,$user,$pass,$name,$tables = "*")
    {
        // $tables = 'tipoarmas,companiasysubzonas,tipocuerpos,personas,elementos,matriculas,arrestos,grados,ascensos,asistencias,cargos,cargo_elemento,documentos,tipoeventos,eventos,elemento_evento,examens,elemento_examen,emails,facebooks,pagos,reconocimientos,status,telefonos,tutores,twitters,users,roles,role_user,reminders,donativos';
        $link = mysql_connect($host,$user,$pass);
        mysql_select_db($name,$link);
        
        //get all of the tables
        if($tables == '*')
        {
            $tables = array();
            $result = mysql_query('SHOW TABLES');
            while($row = mysql_fetch_row($result))
            {
                $tables[] = $row[0];
            }
        }
        else
        {
            $tables = is_array($tables) ? $tables : explode(',',$tables);
        }
        $return='';
        //cycle through
        foreach($tables as $table)
        {
            
            $return.= 'DROP TABLE IF EXISTS '.$table.';';
            $row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
            $return.= "\n\n".$row2[1].";\n\n";

            $return.="\n\n\n";
        }
        //////inserts
        foreach($tables as $table)
        {
            $result = mysql_query('SELECT * FROM '.$table);
            $num_fields = mysql_num_fields($result);
            for ($i = 0; $i < $num_fields; $i++) 
            {
                while($row = mysql_fetch_row($result))
                {
                    $return.= 'INSERT INTO '.$table.' VALUES(';
                    for($j=0; $j<$num_fields; $j++) 
                    {
                        $row[$j] = addslashes($row[$j]);
                        $row[$j] = str_replace("\n","\\n",$row[$j]);
                        if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
                        if ($j<($num_fields-1)) { $return.= ','; }
                    }
                    $return.= ");\n";
                }
            }
        }
        //////////////triggers
        $triggers = array();
        $result = mysql_query('SHOW TRIGGERS');
        while($row = mysql_fetch_row($result))
        {
            $triggers[] = $row[0];
        }
        $return.="DELIMITER $$\n\n\n";
        foreach($triggers as $trigger)
        {
            $return.= 'DROP TRIGGER IF EXISTS '.$trigger.';';
            $row2 = mysql_fetch_row(mysql_query('SHOW CREATE TRIGGER '.$trigger));
            $return.= "\n\n".$row2[2].";\n\n";
        }
        $return.="DELIMITER ;\n\n\n";
        //////////////triggers
        //save file
        $handle = fopen('backups/db-backup-'.date('Y-m-d').'.sql','w+');
        fwrite($handle,$return);
        fclose($handle);
    }
    public function getDownload($file){
        return Response::download('backups/'.$file);
    }
    public function getDelete($file){
        File::delete('backups/'.$file);
        return Redirect::to('admin');
    }
    public function getRestore($file){
        AdminController::SplitSQL('localhost','root','','centroto_db_pdmu','backups/'.$file);
        echo "full";
    }
    public function SplitSQL($host,$user,$pass,$name,$file, $delimiter = ';')
    {
        $link = mysql_connect($host,$user,$pass);
        mysql_select_db($name,$link);
        set_time_limit(0);

        if (is_file($file) === true)
        {
            $file = fopen($file, 'r');

            if (is_resource($file) === true)
            {
                $query = array();

                while (feof($file) === false)
                {
                    $query[] = fgets($file);

                    if (preg_match('~' . preg_quote($delimiter, '~') . '\s*$~iS', end($query)) === 1)
                    {
                        $query = trim(implode('', $query));

                        if (mysql_query($query) === false)
                        {
                            echo '<h3>ERROR: ' . $query . '</h3>' . "\n";
                        }

                        while (ob_get_level() > 0)
                        {
                            ob_end_flush();
                        }

                        flush();
                    }

                    if (is_string($query) === true)
                    {
                        $query = array();
                    }
                }

                return fclose($file);
            }
        }

        return false;
    }
}

?>