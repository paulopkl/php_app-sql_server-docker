<?php 
 
// Start session 
if(!session_id()){ 
    session_start(); 
} 
 
// Retrieve session data 
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:''; 
 
// Get status message from session 
if(!empty($sessData['status']['msg'])){ 
    $statusMsg = $sessData['status']['msg']; 
    $statusMsgType = $sessData['status']['type']; 
    unset($_SESSION['sessData']['status']); 
} 
 
// Include database configuration file 
require_once 'dbConfig.php'; 
 
// Fetch the data from SQL server 
$sql = "SELECT * FROM Members ORDER BY MemberID DESC"; 
$query = $conn->prepare($sql); 
$query->execute(); 
$members = $query->fetchAll(PDO::FETCH_ASSOC); 
 
?>

<!-- Display status message -->
<?php if(!empty($statusMsg) && ($statusMsgType == 'success')){ ?>
<div class="col-xs-12">
    <div class="alert alert-success"><?php echo $statusMsg; ?></div>
</div>
<?php }elseif(!empty($statusMsg) && ($statusMsgType == 'error')){ ?>
<div class="col-xs-12">
    <div class="alert alert-danger"><?php echo $statusMsg; ?></div>
</div>
<?php } ?>

<div class="row">
    <div class="col-md-12 head">
        <h5>Members</h5>
        <!-- Add link -->
        <div class="float-right">
            <a href="addEdit.php" class="btn btn-success"><i class="plus"></i> New Member</a>
        </div>
    </div>
    
    <!-- List the members -->
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Country</th>
                <th>Created</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($members)){ $count = 0; foreach($members as $row){ $count++; ?>
            <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['FirstName']; ?></td>
                <td><?php echo $row['LastName']; ?></td>
                <td><?php echo $row['Email']; ?></td>
                <td><?php echo $row['Country']; ?></td>
                <td><?php echo $row['Created']; ?></td>
                <td>
                    <a href="addEdit.php?id=<?php echo $row['MemberID']; ?>" class="btn btn-warning">edit</a>
                    <a href="userAction.php?action_type=delete&id=<?php echo $row['MemberID']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete?');">delete</a>
                </td>
            </tr>
            <?php } }else{ ?>
            <tr><td colspan="7">No member(s) found...</td></tr>
            <?php } ?>
        </tbody>
    </table>
</div>