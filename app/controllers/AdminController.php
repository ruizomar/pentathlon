<?php
 
class AdminController extends BaseController {
    
    public function __construct()
    {
        $this->beforeFilter('auth');
        $this->beforeFilter('admin');
    }
    public function getIndex()
    {
        $backups = array();
        $directorio = opendir("admin/backups"); //ruta actual
        while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
        {
            if (!is_dir($archivo))//verificamos si es o no un directorio
            {
                $backups[] = $archivo;
            }
        }
        return View::make('administracion.administracion')->with('backups',$backups);
    }
    public function getDownload($file){
        return Response::download('admin/backups/'.$file);
    }
    public function getDelete($file){
        File::delete('admin/backups/'.$file);
        return Redirect::to('administrador');
    }
}

?>