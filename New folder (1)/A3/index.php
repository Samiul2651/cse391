<!DOCTYPE html>
<html>
<head>
<title>ABC</title>
<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f0f5f9;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
  }
  .container {
    max-width: 800px;
    padding: 20px;
    background-color: #e3f2fd;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }
  .item {
    margin-bottom: 20px;
  }
  .name-item {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
  }
  .name-item input[type="text"],
  select {
    flex: 1;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
  }
  .name-item input[type="text"]:focus,
  select:focus {
    outline: none;
    border-color: #007bff;
  }
  .submit-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  input[type="submit"],
  input[type="reset"] {
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 3px;
    cursor: pointer;
    transition: background-color 0.3s;
  }
  input[type="submit"]:hover,
  input[type="reset"]:hover {
    background-color: #0056b3;
  }
  .instructions {
    font-size: 16px;
    margin-bottom: 15px;
    line-height: 1.5;
  }
</style>
</head>
<body>

<?php
include 'db.php';
?>

<div class="container">
  <div class="instructions">
    Register in the following slots<br>
    Please remember to input your correct SID<br>
    Register to only one Section<br>
    Please check seat number before registration
  </div>
  <form action="index.php" method="POST">
    <div class="item">
      <p>Give your information below</p>
      <div class="name-item">
        <input type="text" name="name" placeholder="Name" required />
        <input type="text" name="first" placeholder="First Name" required/>
        <input type="text" name="sid" placeholder="SID" required/>
        <input type="text" name="email" placeholder="Email" required/>
      </div>
    </div>
    <div class="item">
      <select name="section">
      <?php
        $sql = "SELECT * FROM sections";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['section_no'] . '">'.$row['day']."  ".$row['time']." ".$row['seats']. " seats remaining" .'</option>';
          }
        }
      ?>
      </select>
    </div>
    <div class="submit-container">
      <input type="hidden" id="hiddencontainer" name="hiddencontainer"/>
      <input type="submit" name="submit" value="Submit" />
      <input type="reset" />
    </div>
  </form>
</div>


<?php
    
if (isset($_POST['submit']) && $_POST['submit']==true)
{
    
    if(isset($_POST['name'])){
        $name = $_POST['name'];
        
    }
    if(isset($_POST['first'])){
        $first = $_POST['first'];
        
    }
    if(isset($_POST['sid'])){
        $sid = $_POST['sid'];
        
    }
    if(isset($_POST['email'])){
        $email = $_POST['email'];
        
    }
    if(isset($_POST['section'])){
        $section = $_POST['section'];
        
    }
    if (!is_numeric($sid)) {
      ?><script type="text/javascript">
      alert("SID must be a valid number.");
      </script><?php
      header("Refresh:0");
    } else {
    if($_POST['name'] != ""){
        $sql = "SELECT * FROM sections WHERE section_no = " . $section;
        $result = $conn->query($sql);
        $seats = false;
        $seat = 0;
        
        while($row = $result->fetch_assoc()) {
            if($row['seats'] >= 1) {
                $seats = true;
                $seat = $row['seats'];
            }
        }
        $sql1 = "SELECT * FROM users WHERE sid = " . $sid;
        $result1 = $conn->query($sql1);
        $sectionTaken = false;
        $sectionNo = null;
        while($row = $result1->fetch_assoc()) {
            if($row['section'] != null) {
                $sectionTaken = true;
                $sectionNo = $row['section'];
            }
        }

        if($seats){

          
            
        
            
            if($section != $sectionNo){
                
                if($sectionTaken){
                echo "a";
                $change = false;
                
                ?>
                <script>
                let change = false;
                function myFunction() {
                    let text = "Press a button!\nEither OK or Cancel.";
                    v = confirm(text);
                    console.log(v);
                    if (v == true) {
                        change = true;
                    } else {
                        change = false;
                    }
                    var myhidden = document.getElementById("hiddencontainer");
                    myhidden.value=change;
                }
                myFunction();
                console.log(change);
                if(change){
                    let data = { "sectionNo": "<?php echo$sectionNo ?>", "section" :"<?php echo$section ?>", "sid" : "<?php echo$sid ?>", "seat" : "<?php echo$seat ?>" };
                    console.log(data);
                    
                    fetch("update.php",{"method" : "POST", 
                        "headers": {
                        "Content-Type": "application/json; charset=utf-8"
                        }
                    ,
                    "body": JSON.stringify(data)
                    })
                    .then(function(response){
                        return response.text();
                    })
                    .then(function(data){
                        console.log(data);
                        window.location.reload();
                    })
                    .catch(err => console.error(err));
                    
                    alert("success");
                    console.log(0);
                }
                else{
                    
                }
                </script>
                
                <?php
            }
            else{
                ?>
                <script>console.log(1)</script>
                <?php
                $sql2 = "INSERT INTO users (email, sid, name, first_name, section) VALUES ('".$email."','".$sid."','".$name."','".$first."','".$section."')";
                $result2 = $conn->query($sql2);
                $seat -= 1;
                $sql2 = "UPDATE sections SET seats= ".$seat." WHERE section_no = ".$section;
                $result2 = $conn->query($sql2);
            }
            
            
            }
            
            
        }
        else{
            ?><script type="text/javascript">
            alert("No seats remaining. Choose another Section.")
            </script>
            <?php
        }
        //header("Refresh:0");
      }
        
    }
    
    
    
   
}
else{
    
}
?>

</body>

<footer>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</footer>
</html>

