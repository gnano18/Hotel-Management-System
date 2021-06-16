<?php 
  class Inventory {
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function show(){
      $this->db->query("SELECT * FROM inventory");
      $results = $this->db->resultSet();
      return $results;
    }

    public function addToInventory($data)
    {
      $this->db->query('INSERT INTO inventory(productName, productQuantity, description, sellingPrice) VALUES (:productName, :productQuantity, :description, :sellingPrice)');
        $this->db->bind(':productName', $data['productName']);
        $this->db->bind(':productQuantity', 0);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':sellingPrice', $data['sellingPrice']);
       
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getProductQuantity($data){
      $this->db->query("SELECT productQuantity FROM inventory WHERE productName = :productName");
      // $var = $data['productName'];
      // $var = strval($var[0]->productName);
      $this->db->bind(':productName', $data['productName']);
      $results = $this->db->resultSet();
      return $results;
    }

    public function updateQuantity($id, $quantity){
      $this->db->query('UPDATE inventory SET productQuantity = :productQuantity WHERE productID =:productID');
      $this->db->bind(':productQuantity', $quantity);
      $this->db->bind(':productID', $id);
      if ($this->db->execute()) {
        return true;
    } else {
        return false;
    }

    }

    public function getProductIDbyName($data){
      $this->db->query("SELECT productID FROM inventory WHERE productName =:productName");
      $this->db->bind(':productName', $data['productName']);
      $results = $this->db->resultSet();
      return $results;
    }

    public function updateManageSupplies($data, $id)
    {
      print_r($data);
      $this->db->query('INSERT INTO managesupplies( manageSuppliesDate, Quantity, purchasePrice, productName, action, productID, employeeID) VALUES (CURDATE(), :Quantity,  :purchasePrice, :productName, :action ,:productID, :employeeID)');
      $this->db->bind(':Quantity', $data['Quantity']);
      $this->db->bind(':purchasePrice', $data['purchasePrice']);
      // $this->db->bind(':transactionID', $data['transactionID']);
      $this->db->bind(':productName', $data['productName']);
      $this->db->bind(':action', $data['Action']);
      $this->db->bind(':productID', $id); 
      $this->db->bind(':employeeID', $_SESSION['user_id']);
      
      if ($this->db->execute()) {
          return true;
      } else {
          return false;
      }
    }

    ///LIMIT 0 , 10
    //"SELECT *FROM alphabet LIMIT " . $page_first_result . ',' . $results_per_page;
    public function showTransactionLimited(){
      $this->db->query('SELECT * FROM managesupplies ORDER BY transactionID DESC LIMIT 0 , 10');
      // $this->db->bind(':page_first_result', $page_first_result); 
      // $this->db->bind(':results_per_page', $results_per_page); 
      $results = $this->db->resultSet();
      return $results;
    }
    public function showTransaction(){
      $this->db->query('SELECT * FROM managesupplies ORDER BY transactionID');
      $results = $this->db->resultSet();
      return $results;
    }

    // public function getNumTransaction(){
    //   $this->db->query('SELECT COUNT(*) FROM managesupplies');
    //   $results = $this->db->resultSet();
    //   return $results;
    // }
    
  }