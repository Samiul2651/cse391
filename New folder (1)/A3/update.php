<?php
    //session_start();
    include 'db.php';
    //$_POST['submit'] = false;
    //function start(){
    if(isset($_POST)){
    $data = file_get_contents("php://input");
    $user = json_decode($data, true);
    $sid = $user['sid'];
    $section = $user['section'];
    $sectionNo = $user['sectionNo'];
    $seat = $user['seat'];
    ?><script>console.log(<?php echo $sid ?>)</script><?php
     $sql2 = "SELECT * FROM sections WHERE section_no = " . $sectionNo;
                $result2 = $conn->query($sql2);
                $seats1 = 0;
                while($row = $result2->fetch_assoc()) {
                    $seats1 = $row['seats'];
                    $seats1 += 1;
                }
                $sql2 = "UPDATE sections SET seats= ".$seats1." WHERE section_no = ".$sectionNo;
                $result2 = $conn->query($sql2);
                $sql2 = "UPDATE users SET section= ".$section." WHERE sid = ".$sid;
                $result2 = $conn->query($sql2);
                $seat -= 1;
                $sql2 = "UPDATE sections SET seats= ".$seat." WHERE section_no = ".$section;
                $result2 = $conn->query($sql2);
                header("Refresh:0");
    }
//();
?>  