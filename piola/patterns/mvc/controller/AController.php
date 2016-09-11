<?php

namespace piola\patterns\mvc\controller;

abstract class AController implements IController
{
    protected $_onBeforeAction;
    protected $_onAfterAction;

    public function getOnBeforeAction() { return $this->_onBeforeAction; }
    protected function setOnBeforeAction($beforeAction) { $this->_onBeforeAction = $beforeAction; }

    public function getOnAfterAction() { return $this->_onAfterAction; }
    protected function setOnAfterAction($afterAction) { $this->_onAfterAction = $afterAction; }

    public function __construct()
    {
        $this->setOnBeforeAction(null);
        $this->setOnAfterAction(null);
    }

    public function onBeforeAction(\Closure $function = null)
    {
        if ($function !== null)
        {
            $this->_onBeforeAction = $function;
        }
    }

    public function onAfterAction(\Closure $function = null)
    {
        if ($function !== null)
        {
            $this->_onAfterAction = $function;
        }
    }

    public function page404()
    {
        return new mvc\CView("index");
    }
}
