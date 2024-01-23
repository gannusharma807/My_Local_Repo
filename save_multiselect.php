
<?php
$connect = new PDO('mysql:host=localhost;dbname=multiselect', 'root', '');
$return_arr = [];
if(isset($_POST['countries'])){     
    if(!empty($_POST['countries'])){     
        $countries=$_POST['countries'];
        $sql="INSERT INTO  multiselect_dropdown (countries) VALUES ('$countries')";
        $statement = $connect->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(); 
        unset($_POST);     
        $return_arr = array(
            "message" => "Data inserted.",
            "res" => true);
             echo json_encode($return_arr); 
           


    }
}
?>