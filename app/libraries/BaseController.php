<?php

//This is the Base Controller 
//This loads the models and views

class BaseController {

    //Load Model
    public function model($model){
    //Require model file
    if (file_exists('../app/models/'. ucwords($model) .'Model.php')) { 

        require_once '../app/models/'.ucwords($model).'Model.php';

        $model = ucwords($model).'Model';
        return new $model;
    }else{
        die('<b>Error:</b>'.$model.'Model file Not Found.');
    }   

    }

    public function view($view, $data = []){

        if (file_exists('../app/views/pages/'. $view . 'View.php')) {
            require_once '../app/views/pages/'. $view . 'View.php';
        }
        else {
            die('<br>view does not exist');
        }
    }
    
}



?>