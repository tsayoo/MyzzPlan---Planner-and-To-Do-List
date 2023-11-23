<?php
include 'db.php';
// Create
if(isset($_POST['add'])) {
    $q_insert = "INSERT INTO task (task_lable, task_status) VALUE (
        '".$_POST['task']."',
        'open'
    )";
    $run_q_insert = mysqli_query($conn, $q_insert);
    if($run_q_insert) {
        header('refresh:0; url=myzzplan.php');
    }
}
// nampilin data
$q_select = "SELECT * FROM task ORDER BY task_id DESC";
$run_q_select = mysqli_query($conn, $q_select);
// delete
if(isset($_GET['delete'])) {
    $q_delete = "DELETE FROM task WHERE task_id = '".$_GET['delete']."'";
    $run_q_delete = mysqli_query($conn, $q_delete);
    header('refrseh:0; url=index.php');
}
// update status
if(isset($_GET['done'])) {
    $status = 'close';
    if($_GET['status'] == 'open') {
        $status = 'close';
    } else {
        $status = 'open';
    }
    $q_update = "UPDATE task SET task_status = '".$status."' WHERE task_id = '".$_GET['done']."'";
    $run_q_update = mysqli_query($conn, $q_update);
    header('refrseh:0; url=index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyzzPlan - Planner and To do List</title>
    <link rel="stylesheet" href="StyleMy.css">
    <link rel="shortcut icon" href="images/logo-removebg-preview.png" type="image/x-icon">
    <!-- boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>
    <div class="container">
      <p>Make your day more organized by writing your plan and your task</p>
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
                    <input name="task" type="text" class="inpuut" placeholder="Add your Plan or Task">
                    <div class="text-right">
                        <button type="submit" name="add">Add</button>
                    </div>
                </form>
            </div>
            <!-- utk naro tugasnya -->
            <?php
            if(mysqli_num_rows($run_q_select) > 0) {
                while($r = mysqli_fetch_array($run_q_select)) {
                ?>
            <div class="card">
                <div class="Task-item <?= $r['task_status']  == 'close' ? 'done':''?>">
                    <div>
                    <input type="checkbox" title="Done?" 
                    onclick="window.location.href = '?done=<?= $r['task_id']?>&status=<?= $r['task_status']?>'" 
                    <?= $r['task_status'] == 'close' ? 'checked' : ''?>>
                    <span><?= $r['task_lable']?></span>
                    </div>
                    <div>
                        <a href="edit.php?id=<?= $r['task_id']?>" class="edit-task" title="editz"><i class='bx bxs-edit'></i></a>
                        <a href="?delete=<?= $r['task_id']?>" class="delete-task" title="remove"
                         onclick="return confirm('Are you sure?')"><i class='bx bxs-trash'></i></a>
                    </div>
                </div>
            </div>
        <?php } } else {  ?>
            <div>blm ada data</div>
        <?php } ?>
        </div>
        <!-- <div class="text-right">
                <button type="submit" name="add">save</button>
            </div> -->
        <a href="Index.php"><button type="submit">Save</button></a>
    </div>
</body>
</html>