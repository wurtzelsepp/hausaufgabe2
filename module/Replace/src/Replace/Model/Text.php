<?php

 namespace Replace\Model;

 use Replace\Controller\ReplaceController;
 use Zend\InputFilter\InputFilter;
 use Zend\InputFilter\InputFilterAwareInterface;
 use Zend\InputFilter\InputFilterInterface;
 
 
 class Text implements InputFilterAwareInterface
 {
    
     public $text;
     public $textRepl;
	


     public function exchangeArray($data)
     {
         
         $this->text  = (!empty($data['text'])) ? $data['text'] : null;
		 
		 $this->textRepl= 'Holla';
		 
     }
	 public function setTextRepl($textR){
		$this->textRepl=$textR;
	 }
	 
	 
	 
	 public function getArrayCopy()
     {
         return get_object_vars($this);
     }
	 
	 public function setInputFilter(InputFilterInterface $inputFilter)
     {
         throw new \Exception("Not used");
     }

     public function getInputFilter()
     {
         if (!$this->inputFilter) {
             $inputFilter = new InputFilter();


             $inputFilter->add(array(
                 'name'     => 'text',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 1,
                             'max'      => 1000,
                         ),
						 
						 
                     ),
                 ),
             ));

             $this->inputFilter = $inputFilter;
         }

         return $this->inputFilter;
     }
	 
	 
	 
 }