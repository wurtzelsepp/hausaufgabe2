<?php

 namespace Replace\Form;

 use Zend\Form\Form;

 class ReplaceForm extends Form
 {
     public function __construct($name = null)
     {
         // we want to ignore the name passed
         parent::__construct('replace');

         $this->add(array(
             'name' => 'id',
             'type' => 'Hidden',
         ));
         $this->add(array(
             'name' => 'wordone',
             'type' => 'Text',
             'options' => array(
                 'label' => 'WordOne',
             ),
         ));
         $this->add(array(
             'name' => 'wordtwo',
             'type' => 'Text',
             'options' => array(
                 'label' => 'WordTwo',
             ),
         ));
         $this->add(array(
             'name' => 'submit',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'Hinzufügen',
                 'id' => 'submitbutton',
             ),
         ));
     }
 }
