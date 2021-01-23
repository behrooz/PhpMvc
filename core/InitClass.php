<?php

    class InitClass{

        private $controllerPath = "../Controllers";
        private $controllers_array = [];     
        private $path = [];   

        public function __get($property) {            
            return $this->$property;            
        }
        
        public function __set($property, $value) {           
            $this->$property = $value;    
        }

        public function parseRequest($path_info){            
            $classPath = new stdClass();
            if(count($path_info) > 0 )
            {
                for($i = 0; $i < count($path_info);$i++){
                    
                    if($i == 0){
                        $classPath->controller =  $path_info[$i];
                    }

                    if($i == 1){
                        $classPath->method =  $path_info[$i];
                    }

                    if($i > 1){
                        $classPath->param =  $path_info[$i];
                    }
                }        
            }

            print_r($classPath);
        }

        public function getControllerList()
        {           
            
            $array = [];            
            foreach(glob(__DIR__.'/'.$this->controllerPath.'/*.php') as $item){
                $temp = explode('/',$item);
                $array[$temp[count($temp)-1]] = $temp[count($temp)-1];
            }
            $this->__set("controllers_array",$array);        
        }

        public function getControllerInstance($class)
        {            

            if(array_key_exists($class.'.php',$this->controllers_array))
            {
                $currentController = $this->controllers_array[$class.'.php'];
                require_once(__DIR__.'/../Controllers/'. $currentController);
    
                $controller = basename($class,'.php');
                
                if(class_exists($controller)){
                    
                    $reflect = new ReflectionClass($class);
                    $instance = $reflect->newInstance();
                    echo $instance->index();
                }
            }else{
                throw new Exception("Controller does not exist");
            }
            

            return null;
        }

    }
?>