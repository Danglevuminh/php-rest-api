<?php

  
//Headers
    header ('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../models/Post.php';
    include_once '../../config/Database.php';

    //Instantiate an object from the Database class from Database.php and utilize the class's connect method

    $database = new Database();
    $db = $database->connect();

    //Initialize blog post object
    $post = new Post ($db);

    //blog post query
    $result = $post->read();


    //Get the row count from the PDO object
     $num = $result->rowCount();

     //Check if there are any posts. If there are posts, initialize an array and store the post's properties inside an array
     if ($num > 0){
        //Initialize a Post array
        $posts_arr = array();
        //put a 'data' array into the posts_arr array
        $posts_arr['data'] = array();

        //loop through the data
        while ($row = $result->fetch(PDO::FETCH_ASSOC)){ //this is going to fetch the PDO as an associative array
            //imports variables into the local symbol table from an array
            extract ($row);

            //create a post item for each post properties
            $post_item = array(
                'id' => $id,
                'title'=>$title,
                'body'=>html_entity_decode($body),
                'author' => $author,
                'category_id'=>$category_id,
                'category_name' =>$category_name
            );

            //Push the $post_item array into the data array inside the posts_arr array
            array_push($posts_arr['data'], $post_item);

        }

        //Turn to JSON and output
        echo json_encode ($posts_arr);
     } else{
        //If there are no posts
        echo json_encode(
            array('message' => 'No Posts Found')
        );
     }
