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
 
// Get member data 
$memberData = $userData = array(); 
if(!empty($_GET['id'])){ 
    // Include database configuration file 
    require_once 'dbConfig.php'; 
     
    // Fetch data from SQL server by row ID 
    $sql = "SELECT * FROM Members WHERE MemberID = ".$_GET['id']; 
    $query = $conn->prepare($sql); 
    $query->execute(); 
    $memberData = $query->fetch(PDO::FETCH_ASSOC); 
} 
$userData = !empty($sessData['userData'])?$sessData['userData']:$memberData; 
unset($_SESSION['sessData']['userData']); 
 
$actionLabel = !empty($_GET['id'])?'Edit':'Add'; 
 
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
    <div class="col-md-12">
        <h2><?php echo $actionLabel; ?> Member</h2>
    </div>
    <div class="col-md-6">
         <form method="post" action="userAction.php">
            <div class="form-group">
                <label>First Name</label>
                <input type="text" class="form-control" name="FirstName" placeholder="Enter your first name" value="<?php echo !empty($userData['FirstName'])?$userData['FirstName']:''; ?>" required="">
            </div>
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" class="form-control" name="LastName" placeholder="Enter your last name" value="<?php echo !empty($userData['LastName'])?$userData['LastName']:''; ?>" required="">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="Email" placeholder="Enter your email" value="<?php echo !empty($userData['Email'])?$userData['Email']:''; ?>" required="">
            </div>
            <div class="form-group">
                <label>Country</label>
                <input type="text" class="form-control" name="Country" placeholder="Enter country name" value="<?php echo !empty($userData['Country'])?$userData['Country']:''; ?>" required="">
            </div>
            
            <a href="index.php" class="btn btn-secondary">Back</a>
            <input type="hidden" name="MemberID" value="<?php echo !empty($userData['MemberID'])?$userData['MemberID']:''; ?>">
            <input type="submit" name="userSubmit" class="btn btn-success" value="Submit">
        </form>
    </div>
</div>