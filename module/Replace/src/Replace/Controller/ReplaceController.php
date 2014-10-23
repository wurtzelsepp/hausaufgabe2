<?php
 namespace Replace\Controller;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;
 use Replace\Model\Replace;
use Replace\Form\ReplaceForm;
use Replace\Form\TextForm;
  use Replace\Model\Text;

 class ReplaceController extends AbstractActionController
 {
	public $replaceTable;
	
     public function indexAction()
     {
		return new ViewModel(array(
             'replaces' => $this->getReplaceTable()->fetchAll(),
         ));
		
     }

     public function addAction()
     {
		 $form = new ReplaceForm();
         $form->get('submit')->setValue('Add');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $replace = new Replace();
             $form->setInputFilter($replace->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $replace->exchangeArray($form->getData());
                 $this->getReplaceTable()->saveReplace($replace);

                 
                 return $this->redirect()->toRoute('replace');
             }
         }
         return array('form' => $form);
		
     }

     public function editAction()
     {
		
		 $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
             return $this->redirect()->toRoute('replace', array(
                 'action' => 'add'
             ));
         }

        //get the clicked
         try {
             $replace = $this->getReplaceTable()->getReplace($id);
         }
         catch (\Exception $ex) {
             return $this->redirect()->toRoute('replace', array(
                 'action' => 'index'
             ));
         }

         $form  = new ReplaceForm();
         $form->bind($replace);
         $form->get('submit')->setAttribute('value', 'Edit');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $form->setInputFilter($replace->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $this->getReplaceTable()->saveReplace($replace);

                 
                 return $this->redirect()->toRoute('replace');
             }
         }

         return array(
             'id' => $id,
             'form' => $form,
         );
		
     }

     public function deleteAction()
     {
		
		 $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
             return $this->redirect()->toRoute('replace');
         }

         $request = $this->getRequest();
         if ($request->isPost()) {
             $del = $request->getPost('del', 'No');

             if ($del == 'Yes') {
                 $id = (int) $request->getPost('id');
                 $this->getReplaceTable()->deleteReplace($id);
             }

             
             return $this->redirect()->toRoute('replace');
         }

         return array(
             'id'    => $id,
             'replace' => $this->getReplaceTable()->getReplace($id)
         );
		
     }
	 
	  public function getReplaceTable()
     {
         if (!$this->replaceTable) {
             $sm = $this->getServiceLocator();
             $this->replaceTable = $sm->get('Replace\Model\ReplaceTable');
         }
         return $this->replaceTable;
     }
	 
	 public function textAction(){
		
		$form = new TextForm();
		$form->get('submit')->setValue('senden');
		
		
		$request = $this->getRequest();
         if ($request->isPost()) {
             $text = new Text();
             //$form->setInputFilter($replace->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 
             $text->exchangeArray($form->getData());
			 
			 
			 
			 //$text->setTextRepl($this->getReplaceTable()->getRepl($text->text));
			 $text->setTextRepl($this->replAll($text->text));
			 
             //    $this->getReplaceTable()->saveReplace($replace);
			return array('form' => $form, 'text'=>$text);
                 
            //     return $this->redirect()->toRoute('replace');
             }
         }
         return array('form' => $form);
		
		
		
	 }
	 
	 public function replAll($text)
	 {
		$tokens=$this->tokenizer($text);
		foreach ($tokens as &$value){
			
			$neval=$this->searchRepl($value);
			if($neval!=null){
				$value=$neval;
			}
			
			
		}
		return implode(" ", $tokens);
		
		
	 }
	 
	 
	 public function searchRepl($word){
		
		return $this->getReplaceTable()->getRepl($word);
		
	 }
	 
	 public function tokenizer($text) {
		$text = trim(strtolower($text));
		$result = preg_split('/((^\p{P}+)|(\p{P}*\s+\p{P}*)|(\p{P}+$))/', $text, -1, PREG_SPLIT_NO_EMPTY);
		for ($i = 0; $i < count($result); $i++) {
			$result[$i] = trim($result[$i]);
		}
		return $result; // contains the single words
	 }
}
	 
	 
 