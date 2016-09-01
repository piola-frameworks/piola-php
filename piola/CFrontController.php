<?php

namespace piola
{
    final class CFrontController
    {
        const CTRL_NMSP = "miali\\controller\\";
        const CTRL_PREFIX = "Controller";
        
        private $_controller = "Main";
        private $_action = "index";
        private $_params = array();

        public function getController() { return $this->_controller; }
        protected function setController($controller) { $this->_controller = $controller; }

        public function getAction() { return $this->_action; }
        protected function setAction($action) { $this->_action = $action; }

        public function getParameters() { return $this->_params; }
        
        protected function addParameter($key, $value)
        {
            $this->_params[$key] = $value;
        }
        
        protected function removeParameter($key)
        {
            array_filter($this->_params, function($item) use ($key) {
                return $item == $key;
            });
        }
        
        /**
         * 
         * @param web\CHttpRequest $request
         */
        public function __construct(web\CHttpRequest $request)
        {
            $parsedQueryString = array();
            parse_str($request->getQueryString(), $parsedQueryString);
            
            if (array_key_exists("controller", $parsedQueryString))
            {
                $this->setController($parsedQueryString["controller"]);
            }
            
            if (array_key_exists("action", $parsedQueryString))
            {
                $this->setAction($parsedQueryString["action"]);
            }
            
            foreach ($parsedQueryString as $key => $value)
            {
                // TODO: esto es una negrada.
                switch ($key)
                {
                    case "controller":
                    case "action":
                        break;
                    default:
                        $this->addParameter($key, $value);
                        break;
                }
            }
        }
        
        public function run()
        {
            if (!class_exists(self::CTRL_NMSP . ucfirst($this->getController()) . self::CTRL_PREFIX))
            {
                // El controller no existe.
                $this->setController("Main");
            }
            
            $reflection = new \ReflectionClass(self::CTRL_NMSP . ucfirst($this->getController()) . self::CTRL_PREFIX);
            $controller = $reflection->newInstanceArgs();
            
            if (!method_exists($controller, $this->getAction()))
            {
                // La accion no existe.
                $this->setAction("page404");
            }
           
            $view = $this->executeRoute($controller, $this->getAction(), $this->getParameters());
            $view->render();
        }

        /**
         * 
         * @param \piola\mvc\IController $controller
         * @param string $action
         * @param array $params
         * @return \piola\mvc\IView
         */
        private function executeRoute(mvc\IController $controller, $action = "index", array $params = array())
        {
            $result = null;
            
            call_user_func(array($controller, "onBeforeAction"));
            $result = call_user_func_array(array($controller, $action), $params);
            call_user_func(array($controller, "onAfterAction"));
            
            return $result;
        }
    }
}

?>