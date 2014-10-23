<?php

 namespace Replace\Model;

  use Zend\InputFilter\InputFilter;
 use Zend\InputFilter\InputFilterAwareInterface;
 use Zend\InputFilter\InputFilterInterface;
 
 
 class Replace implements InputFilterAwareInterface
 {
     public $id;
     public $wordone;
     public $wordtwo;
	 protected $inputFilter;   


     public function exchangeArray($data)
     {
         $this->id     = (!empty($data['id'])) ? $data['id'] : null;
         $this->wordone = (!empty($data['wordone'])) ? $data['wordone'] : null;
         $this->wordtwo  = (!empty($data['wordtwo'])) ? $data['wordtwo'] : null;
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
                 'name'     => 'id',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'Int'),
                 ),
             ));

             $inputFilter->add(array(
                 'name'     => 'wordone',
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
                             'max'      => 100,
                         ),
						  'name'    => 'alnum',
                     ),
                 ),
             ));

             $inputFilter->add(array(
                 'name'     => 'wordtwo',
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
                             'max'      => 100,
                         ),
						 'name'    => 'alnum',
						 
                     ),
                 ),
             ));

             $this->inputFilter = $inputFilter;
         }

         return $this->inputFilter;
     }
	 
	 
	 
	 
 }