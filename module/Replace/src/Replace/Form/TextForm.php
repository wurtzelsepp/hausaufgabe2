<?php

 namespace Replace\Form;

 use Zend\Form\Form;

 class TextForm extends Form
 {
	
	public function __construct($name = null)
     {
         // we want to ignore the name passed
         parent::__construct('text');
	
	$this->add(array(
             'name' => 'text',
             'type' => 'Text',
             'options' => array(
                 'label' => 'InputText',
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