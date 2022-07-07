<?php
    //This class is used to select data from the database - permits the creation of new data in the database
    class Post{
        //Database variables
        private $conn;
        private $table = 'posts';

        //Post properties
        public $id;
        public $category_id;
        public $category_name;
        public $title;
        public $body;
        public $author;
        public $created_at;

        


        //Database constructor
        public function __construct ($db){
            $this->conn = $db;
        }

        //Get Posts
        //This read method is used to select data from two tables then prepare and execute the query
        public function read(){
            //Create a query to get data from sql table
            $query = 'SELECT
            c.name as category_name, --set the column name from the category table to alias category_name
            p.id,
            p.category_id,
            p.title,
            p.body,
            p.author,
            p.created_at
        FROM --the below selects all data from left database and joins the category_id from posts table to id from categories table 
        '.$this->table .'p
        LEFT JOIN 
            categories c ON p.category_id = c.id
        ORDER BY 
            p.created_at DESC';

        //Prepare statement
        $stmt = $this->conn->prepare ($query);
        
        //Execute statement 
        $stmt ->execute();

         return $stmt;
      
        }
    }