<?php

    class InitClass{

        private $controllerPath = "../Controllers";
        private $controllers_array = [];        

        public function __get($property) {            
            return $this->$property;            
        }
        
        public function __set($property, $value) {           
            $this->$property = $value;    
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
            $currentController = $this->controllers_array[$class.'.php'];
            require_once(__DIR__.'/../Controllers/'. $currentController);

            $controller = basename($class,'.php');
            
            if(class_exists($controller)){
                
                $reflect = new ReflectionClass($class);
                $instance = $reflect->newInstance();
                echo $instance->index();
            }

            return null;
        }

    }
?>