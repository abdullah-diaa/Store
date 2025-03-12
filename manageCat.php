<?php
session_start();

if(!isset($_SESSION['userId']))
{
  header('location:login.php');
}
 ?>
<?php require "assets/function.php" ?>
<?php require 'assets/db.php';?>
<!DOCTYPE html>
<html>
<head>
  <title><?php echo siteTitle(); ?></title>
  <?php require "assets/autoloader.php" ?>
  <style type="text/css">
  <?php include 'css/customStyle.css'; ?>

  </style>
  <?php 
  $notice="";
  if (isset($_POST['safeIn'])) 
  {
    $filename = $_FILES['inPic']['name'];
    move_uploaded_file($_FILES["inPic"]["tmp_name"], "photo/".$_FILES["inPic"]["name"]);
    if ($con->query("insert into categories (name,pic) value ('$_POST[inName]','$filename')")) {
      $notice ="<div class='alert alert-success'>تم الاضافة بنجاح</div>";
    }
    else
      $notice ="<div class='alert alert-danger'>خطأ:".$con->error."</div>";
  }

   ?>
</head>
<body style="background: #ECF0F5;padding:0;margin:0">
<div class="dashboard" style="position: fixed;width: 18%;height: 100%;background:#222D32">

  <div style="background: #1A2226;font-size: 10pt;padding: 11px;color: #79978F">القائمة</div>
  <div>
    <div style="background:#1E282C;color: white;padding: 13px 17px;border-left: 3px solid #3C8DBC;"><span><i class="fa fa-dashboard fa-fw"></i> لوحة التحكم</span></div>
    <div class="item">
      <ul class="nostyle zero">
        <a href="index.php"><li style="color: white"><i class="fa fa-circle-o fa-fw"></i> الرئيسية</li></a>
        <a href="inventeries.php"><li><i class="fa fa-circle-o fa-fw"></i> الادوية</li></a>
       <a href="addnew.php"><li><i class="fa fa-circle-o fa-fw"></i> اضافة دواء جديد</li></a>      
        <a href="reports.php"><li><i class="fa fa-circle-o fa-fw"></i> الفواتير</li></a>
      </ul>
    </div>
  </div>
  <div style="background:#1E282C;color: white;padding: 13px 17px;border-left: 3px solid #3C8DBC;"><span><i class="fa fa-globe fa-fw"></i> اعدادات اخرى</span></div>
  <div class="item">
      <ul class="nostyle zero">
        <a href="accountSetting.php"><li><i class="fa fa-circle-o fa-fw"></i> بيانات الحساب</li></a>
        <a href="logout.php"><li><i class="fa fa-circle-o fa-fw"></i> تسجيل الخروج</li></a>
      </ul>
    </div>
</div>
<div class="marginLeft" >
  <div style="color:white;background:#3C8DBC" >
    <div class="pull-right" style="padding-right: 11px;padding: 7px;">
      <div></div>
      <div style="padding: 16px"></div>
    </div>
    <div class="clear"></div>
  </div>
  <div class="content2">
  	<ol class="breadcrumb ">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> الرئيسية</a></li>
        <li class="active">ادارة التصنيفات</li>
    </ol>
    <?php echo $notice; ?>
    <div>
      <span style="font-size: 16pt;color: #333333">التصنيفات </span>
      <button class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#addIn"><i class="fa fa-plus fa-fw"> </i>اضافة تصنيف جديد</button> 
     

    </div>

  <?php 
  	$i=0;
    $array = $con->query("select * from categories");
    ?>
    <br>
    <table class="table table-hover table-striped " style="width: 55%;margin: auto;">
    	<tr>
    		<th>التسلسل</th>
    		<th>الاسم</th>
    		<th>كمية الادوية</th>
    		<th>تحرير</th>
    	</tr>
    <?php
    while ($row = $array->fetch_assoc()) 
    {
    	$i++;
      $array2 = $con->query("select count(*) as qty from inventeries where catId = '$row[id]'");
      $row2 = $array2->fetch_assoc();
  ?>
    <tr>
    	<td><?php echo $i ?></td>
    	<td><?php echo $row['name']; ?></td>
    	<td><?php echo $row2['qty']; ?></td>
    	<td><a href="delete.php?category=<?php echo $row['id'] ?>"><button class="btn btn-xs btn-danger">حذف</button></a></td>
    </tr>
    
  <?php
    }
    echo "</table>";
   ?>
  </div>
</div>

<div id="addIn" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">اضافة تصنيف جديد</h4>
      </div>
      <div class="modal-body"> <form method="POST" enctype="multipart/form-data">
        <div style="width: 77%;margin: auto;">
         
          <div class="form-group">
            <label for="some" class="col-form-label">الاسم</label>
            <input type="text" name="inName" class="form-control" id="some" required>
          </div>
          <div class="form-group">
            <label for="2" class="col-form-label">الصورة</label>
            <input type="file" name="inPic" class="form-control" id="2" required>
          </div>
          
       
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
        <button type="submit" class="btn btn-primary" name="safeIn">اضافة </button>
      </div>
    </form>
    </div>

  </div>
</div>

</body>
</html>

<script type="text/javascript">
  $(document).ready(function(){$(".rightAccount").click(function(){$(".account").fadeToggle();});});
</script>

