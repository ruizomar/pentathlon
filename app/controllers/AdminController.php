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
        echo "fuck yea";
    }
    public function backup_tables($host,$user,$pass,$name,$tables = '*')
    {
    
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
            $result = mysql_query('SELECT * FROM '.$table);
            $num_fields = mysql_num_fields($result);
            $return.= 'DROP TABLE '.$table.';';
            $row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
            $return.= "\n\n".$row2[1].";\n\n";
            
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
            $return.="\n\n\n";
        }
        
        //save file
        $handle = fopen('backups/db-backup-'.date('Y-m-d').'.sql','w+');
        fwrite($handle,$return);
        fclose($handle);
    }
    public function getDownload($file){
        return Response::download('backups/'.$file);
    }
}

?>