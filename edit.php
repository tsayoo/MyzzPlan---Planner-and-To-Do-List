<?php
include 'db.php';
// select data edit
$q_select = "SELECT * FROM task WHERE task_id = '".$_GET['id']."'";
$run_q_select = mysqli_query($conn, $q_select);
$d = mysqli_fetch_object($run_q_select);
// updatee
if(isset($_POST['edit'])) {
    $q_update = "UPDATE task SET task_lable = '".$_POST['task']."' WHERE task_id = '".$_GET['id']."'";
    $run_q_update = mysqli_query($conn, $q_update);
    header('refresh:0; url=myzzplan.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My To Do List</title>
    <link rel="stylesheet" href="StyleMy.css">
    <!-- boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>
    <div class="container">
        <div class="header">
            <div class="title">
            <i class='bx bx-notepad'></i>
            <span>MyzzPlan - Planner and To do List</span>
            </div>
            <div class="descrip">
                <?= date("l, d M Y")?>
            </div>
        </div>
        <div class="content">
            <div class="card">
                <form action="" method="post">
                    <input name="task" type="text" class="inpuut" placeholder="Edit Task" value="<?= $d->task_lable?>">
                    <div class="text-right">
                        <button type="submit" name="edit">Edit</button>
                    </div>
                </form>
</div>  
        </div>
    </div>
</body>
</html>