
<?php
class BaseController 
{
    const VIEW_FOLDER_NAME = 'Views';
    const MODEL_FOLDER_NAME = 'Models';
    protected function view($viewPath, array $data = [])
    {
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        // die;

        // $viewPath = self::VIEW_FOLDER_NAME . '/' 
        // . str_replace('.','/',$viewPath) . '.php';



        foreach ($data as $key => $value) {
            $$key = $value;
        }
       
        return require (self::VIEW_FOLDER_NAME . '/' 
         . str_replace('.','/',$viewPath) . '.php');
    }

    protected function loadModel($modelPath)
    {
        return require (self::MODEL_FOLDER_NAME .'/'. $modelPath . '.php');
    }
    
}
