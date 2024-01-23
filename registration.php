<?php
//Databse connection file
include('db.php');
if(isset($_POST['submit']))
{

    $name=$_POST["name"];
    $email=$_POST["email"];
    $phone=$_POST["phone"];
    $school=$_POST["school"];
    $specialization=$_POST["specialization"];
    $score=$_POST["score"];
     $query = "INSERT INTO registration_form (name,email,phone) VALUES('$name','$email','$phone')";
    $query_run = mysqli_query($con, $query);  
    $last_id = mysqli_insert_id($con);
    if(!empty($query_run))
    {

      foreach($school as $index => $schools)
        {
            $s_school = $schools;
            $s_specialization = $specialization[$index];
            $s_score=$score[$index];
            // $s_otherfiled = $empid[$index];
            $query = "INSERT INTO child_form (parent_id,school,specialization,score) VALUES(' $last_id','$s_school','$s_specialization','$s_score')";
            $query_run = mysqli_query($con, $query);
        }
        if($query_run)
           {
               
               $_SESSION['success_msg'] = " Data Inserted Successfully";
               header("Location:http://localhost/Student_form/registration.php ");
               exit(0);
           }

    }
  



}
?>

<!DOCTYPE html>
<html>
<head>
<title>Student Registration Form</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.2/css/bootstrap.min.css" />
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.2/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

</head>
<body>
<form name="inputForm" method="post">
    <?php    session_start(); ?>
<?php  if(isset($_SESSION['success_msg'])){
            echo $_SESSION['success_msg'];
            unset($_SESSION['success_msg']);
        };?>
      <div class="form-group">
          <label for="name">Name</label>
          <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" placeholder="Enter Your name"required>
      </div> 
      <p id="error-message" style="color: red;"></p>   
      <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email" required>
      </div>
      <p id="error-span" style="color: red;"></p> 

      <div class="form-group">
          <label for="phone">Phone Number</label>
          <input type="text" class="form-control" id="phone" name="phone" aria-describedby="phoneHelp" placeholder="Enter Your Phone Number" max="150" required>
      </div>
      <p id="error-spam" style="color: red;"></p>

        <div class="form-group">
            <label for="educationaldetails">Educational details</label>
              <div class="table-responsive">
              <table class="table table-bordered" id="dynamic_field">
              <tr>
              <td><input type="text" name="school[]" id="school" placeholder="College/School" class="form-control "required /></td>
              <td><input type="text" name="specialization[]" id="specialization" placeholder="Specialization" class="form-control "required /></td>
              <td><input type="text" name="score[]" id="score" placeholder="Score" class="form-control "required /></td>
              <td><button type="button" name="add" id="add" class="btn btn-success">+</button></td>
              </tr>
              </table>
              </div>  
        </div>
        <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Submit" />
</form>
<script>
$(document).ready(function(){

          $("#submit").click(function(e)
              {
               
                var name = $('#name').val();
                var email = $('#email').val();
                var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                var regex = /^[a-zA-Z\s]+$/;
                var phoneNumber = $('#phone').val();
                var phoneRegex = /^\d{1,11}$/;

                if (regex.test(name))
                {
                    // Valid name, you can perform further actions here
                  $('#error-message').text('');
                } else
                 {
                    // Invalid name
                  $('#error-message').text('Please enter a valid name without special characters or numbers.');
                 }
                 if (emailRegex.test(email)) 
                 {
                    // Valid email, you can perform further actions here
                    $('#error-span').text('');
                } else 
                {
                    // Invalid email
                    $('#error-span').text('Invalid email. Please enter a valid email address.');
            
                }
                if (phoneRegex.test(phoneNumber))
                 {
                    // Valid phone number, you can perform further actions here
                    $('#error-spam').text('');
                   
                } else 
                {
                    // Invalid phone number
                    $('#error-spam').text('Invalid phone number. Please enter a valid 11-digit numeric phone number.');
                }
  
            });
             
            var i=1;
            $('#add').click(function()
            { 
            i++;
            $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="school[]" placeholder="College/School" class="form-control " /></td><td><input type="text" name="specialization[]" placeholder="Specialization" class="form-control " /></td><td><input type="text" name="score[]" placeholder="Score" class="form-control " /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
            });
            $(document).on('click', '.btn_remove', function()
            {
            var button_id = $(this).attr("id"); 
            $('#row'+button_id+'').remove();
            });
            });

            

</script>



</body>

</html>