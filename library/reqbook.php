<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])=="")
    {   
    header("Location: index.php"); 
    }
    else{
if(isset($_POST['submit']))
{
   
$at1=$_POST['MobileNumber'];
$Stid=$_POST['class'];
$Aid=$_POST['subject'];



$sql="INSERT INTO reqbd(bookid,Stdname,Mobileno) VALUES(:Stid,:Aid,:at1)";

$query = $dbh->prepare($sql);
$query->bindParam(':Stid',$Stid,PDO::PARAM_STR);
$query->bindParam(':Aid',$Aid,PDO::PARAM_STR);
$query->bindParam(':at1',$at1,PDO::PARAM_STR);
$query->execute();

}
echo "<script type='text/javascript'> invalid data</script>";
?>
  
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System |  Issued Books</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- DATATABLE STYLE  -->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<style>
    .custom-select {
  position: relative;
  font-family: Arial;
}

.custom-select select {
  display: none; /*hide original SELECT element: */
}

.select-selected {
  background-color: DodgerBlue;
}

    </style>
<body>
      <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Manage Issued Books</h4>
    
    

            


                <form class="form-horizontal" method="post">
                                                    <div class="form-group">
                                                        <label for="default" class="col-sm-2 control-label">Select Books</label>
                                                        <div class="col-sm-10">
 <select name="class" class="form-control" id="default" required="required">
<option value="">Select Book</option>
<?php $sql = "SELECT * from tblbooks";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{   ?>
<option value="<?php echo htmlentities($result->ISBNNumber); ?>"><?php echo htmlentities($result->BookName); ?>&nbsp; Section-<?php echo htmlentities($result->Section); ?></option>
<?php }} ?>

 </select>
                                                        </div>
                                                    </div>
<div class="form-group">
                                                        <label for="default" class="col-sm-2 control-label">Select Your Name</label>
                                                        
                                                        <div class="col-sm-10">
 <select name="subject" class="form-control" id="default" required="required">
<option value="" style="color: Green">Select Name</option>

<?php
$email=$_SESSION['login'];
 $sql = "SELECT * from tblstudents where EmailId='$email'";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{   ?>
<option value="<?php echo htmlentities($result->FullName); ?>"><?php echo strtoupper($result->FullName); ?></option>
<?php }} ?>
 </select>
 
 
 <input type="number"  name="MobileNumber" value="<?php echo htmlentities($result->MobileNumber); ?>" placeholder="<?php echo htmlentities($result->MobileNumber); ?>">

                                                        </div>
                                                    </div>
                                                    
                                                 
                                                    <div class="form-group">
                                                        <div class="col-sm-offset-2 col-sm-10">
                                                            
                                                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                                        </div>
</div>
                                                    </div>
                                                </form>
    </div>
    </div>
    </div>

     <!-- CONTENT-WRAPPER SECTION END-->
  <?php include('includes/footer.php');?>
      <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- DATATABLE SCRIPTS  -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>

</body>
</html>
<?php } ?>
