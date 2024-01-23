<!DOCTYPE html>

<html>
        <head>
            <title>Bootstrap Multi Select Dynamic Dependent Select box using PHP Ajax </title>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css"/>
        </head> 

  <body>
    <br/>
    <div class="container">
      <h2>Multi Select Dynamic Dependent Select box using PHP Ajax </h2>    
      <br /><br />
      <div style="width: 500px; margin:0 auto">
       

        <form action="" id="form" >
        <input type="hidden" id="user_id" name= "user_id"  value="<?php  echo $userId ?>">

          <div class="form-group">
            <label>Countries</label><br/>    
            <select  id="country_id" name="countries[]"  multiple class="form-control">
              <option value="Amsterdam">Amsterdam</option>
              <option value="Washington">Washington</option>
              <option value="Sydney">Sydney</option>
              <option value="Beijing">Beijing</option>
              <option value="Cairo">Cairo</option>
            </select>
          </div>
          <div class="form-group">
            <input type="submit"  value="Submit"/>
          </div>
        </form>
      </div>
    </div>
 </body>
</html>
<script> 
$('#country_id').multiselect({
  nonSelectedText:'Select Countries',
  buttonWidth:'400px',
  onChange:function(option, checked){   
    var selected = this.$select.val(); 
  }
 });
  $(document).ready(function(){
  $("#form").submit(function(event){
    event.preventDefault();
    alert("Submitted");    
    const selectedValues = $('input:checkbox:checked').map( function () { 
        return $(this).val();
    })
      .get()
      .join(', ');
      $.ajax({
     url:"save_multiselect.php",
     method:"POST",
     data:{countries:selectedValues},
     success:function(data)
       {  
          if(data.length > 0){
            data_json = JSON.parse(data);        
            if(data_json.res == true){          
              alert(data_json.message);
              $('#country_id option:first').prop('selected',true).trigger("change");
              $('input:checkbox:checked').prop('checked', false);        
            }        
          } 
     }
    })
  });
});


</script>