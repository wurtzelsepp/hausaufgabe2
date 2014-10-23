<?php
 namespace Replace;

 
 use Replace\Model\Replace;
 use Replace\Model\ReplaceTable;
 use Zend\Db\ResultSet\ResultSet;
 use Zend\Db\TableGateway\TableGateway;

 
 
 class Module
 {
     public function getAutoloaderConfig()
     {
         return array(
             'Zend\Loader\ClassMapAutoloader' => array(
                 __DIR__ . '/autoload_classmap.php',
             ),
             'Zend\Loader\StandardAutoloader' => array(
                 'namespaces' => array(
                     __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                 ),
             ),
         );
     }

     
	 public function getServiceConfig()
     {
         return array(
             'factories' => array(
                 'Replace\Model\ReplaceTable' =>  function($sm) {
                     $tableGateway = $sm->get('ReplaceTableGateway');
                     $table = new ReplaceTable($tableGateway);
                     return $table;
                 },
                 'ReplaceTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Replace());
                     return new TableGateway('repl', $dbAdapter, null, $resultSetPrototype);
                 },
             ),
         );
     }
	 
	 public function getConfig()
     {
         return include __DIR__ . '/config/module.config.php';
     }
	 
 }