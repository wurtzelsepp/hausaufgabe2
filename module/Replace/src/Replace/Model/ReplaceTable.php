<?php
namespace Replace\Model;

 use Zend\Db\TableGateway\TableGateway;

 class ReplaceTable
 {
     protected $tableGateway;

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }

     public function fetchAll()
     {
         $resultSet = $this->tableGateway->select();
         return $resultSet;
     }

     public function getReplace($id)
     {
         $id  = (int) $id;
         $rowset = $this->tableGateway->select(array('id' => $id));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $id");
         }
         return $row;
     }

     public function saveReplace(Replace $replace)
     {
         $data = array(
             'wordone' => $replace->wordone,
             'wordtwo'  => $replace->wordtwo,
         );

         $id = (int) $replace->id;
         if ($id == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getReplace($id)) {
                 $this->tableGateway->update($data, array('id' => $id));
             } else {
                 throw new \Exception('Replacement id does not exist');
             }
         }
     }

     public function deleteReplace($id)
     {
         $this->tableGateway->delete(array('id' => (int) $id));
     }
	 
	 public function getRepl($word)
     {
         $wordR='Snusnu'; //testing
         $rowset = $this->tableGateway->select(array('wordone' => $word));
         $row = $rowset->current();
		 
         if (!$row) {
            $rowset = $this->tableGateway->select(array('wordtwo' => $word));
			$row = $rowset->current();
			if (!$row) {
				
				$wordR=null;
			}else{
				$wordR=$row->wordone;
				
			}
         }else{
		
		$wordR=$row->wordtwo;
		 }
		 
         return $wordR;
     }
	 
 }