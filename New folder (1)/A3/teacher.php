<!DOCTYPE html>
<html>
<head>
<title>Section Information</title>
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
    margin: 0 10px;
  }
  table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
  }
  th, td {
    border: 1px solid #ccc;
    padding: 8px;
    text-align: left;
  }
  th {
    background-color: #f2f2f2;
  }
  .section-container {
    max-width: 400px;
    padding: 20px;
    background-color: #e3f2fd;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    margin: 0 10px;
  }
  .logout-button {
        position: absolute;
        top: 10px;
        right: 10px;
        padding: 10px 15px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 3px;
        cursor: pointer;
        font-size: 14px;
        text-decoration: none;
    }
    .logout-button:hover {
        background-color: #0056b3;
    }
</style>
</head>
<body>

<?php
session_start();

if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated']) {
    header("Location: login.php");
    exit();
}

include 'db.php';
$sectionsSql = "SELECT * FROM sections";
$sectionsResult = $conn->query($sectionsSql);

$selectedSection = isset($_POST['section']) ? $_POST['section'] : 1;


$studentsSql = "SELECT * FROM users WHERE section = $selectedSection";
$studentsResult = $conn->query($studentsSql);
$students = [];
while ($student = $studentsResult->fetch_assoc()) {
    $students[] = $student;
}
?>

<div class="container">
  <h2>Student Information</h2>
  <form method="post">
    <label for="section">Select Section:</label>
    <select name="section" id="section">
      <?php
      while ($section = $sectionsResult->fetch_assoc()) {
          $sectionNo = $section['section_no'];
          $selected = ($selectedSection == $sectionNo) ? 'selected' : '';
          echo "<option value='$sectionNo' $selected>Section $sectionNo</option>";
      }
      ?>
    </select>
    <input type="submit" value="Show">
  </form>

  <h3>Section <?php echo $selectedSection ?></h3>
  <table>
    <tr>
      <th>SID</th>
      <th>Name</th>
      <th>First Name</th>
      <th>Email</th>
    </tr>
    <?php
    foreach ($students as $student) {
        echo "<tr>";
        echo "<td>{$student['sid']}</td>";
        echo "<td>{$student['name']}</td>";
        echo "<td>{$student['first_name']}</td>";
        echo "<td>{$student['email']}</td>";
        echo "</tr>";
    }
    ?>
  </table>
</div>

<div class="section-container">
  <h2>Section Information</h2>
  <table>
    <tr>
      <th>Section No</th>
      <th>Seats</th>
      <th>Day</th>
      <th>Time</th>
    </tr>
    <?php
    $sectionsResult = $conn->query($sectionsSql);
    while ($section = $sectionsResult->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$section['section_no']}</td>";
        echo "<td>{$section['seats']}</td>";
        echo "<td>{$section['day']}</td>";
        echo "<td>{$section['time']}</td>";
        echo "</tr>";
    }
    ?>
  </table>
  <a href="?logout=true" class="logout-button">Logout</a>
</div>


<?php
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}
?>
</body>
</html>
