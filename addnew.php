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
    if ($con->query("insert into categories (name,pic) value ('$_POST[name]','$filename')")) {
      $notice ="<div class='alert alert-success'>تم اضافة الدواء بنجاح</div>";
    }
    else
      $notice ="<div class='alert alert-danger'>خطا :".$con->error."</div>";
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
        <a href="index.php"><li ><i class="fa fa-circle-o fa-fw"></i> الرئيسية</li></a>
        <a href="inventeries.php"><li><i class="fa fa-circle-o fa-fw"></i> الادوية</li></a>
       <a href="addnew.php"><li style="color: white"><i class="fa fa-circle-o fa-fw"></i> اضافة دواء جديد</li></a>
        <!-- <a href="newsell"><li><i class="fa fa-circle-o fa-fw"></i> New Sell</li></a> -->
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

      <div style="padding: 20px"></div>
    </div>
    <div class="clear"></div>
  </div>

<?php 
if (isset($_POST['saveProduct'])) {
if ($con->query("insert into inventeries (catId,supplier,name,unit,price,description,company) values ('$_POST[catId]','$_POST[supplier]','$_POST[name]','$_POST[unit]','$_POST[price]','$_POST[discription]','$_POST[company]')")) {
  $notice ="<div class='alert alert-success'>تم اضافة الدواء بنجاح</div>";
}
else{
  $notice ="<div class='alert alert-danger'>خطا:".$con->error."</div>";
}
}

 ?>
  <div class="content2">
<ol class="breadcrumb ">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> الرئيسية</a></li>
        <li class="active">اضافة دواء جديد</li>
    </ol>
    <?php echo $notice ?>
    <div style="width: 55%;margin: auto;padding: 22px;" class="well well-sm center">

      <h4>اضافة دواء جديد</h4><hr>
      <form method="POST">
         <div class="form-group">
            <label for="some" class="col-form-label">اسم الدواء</label>
            <input type="text" name="name" class="form-control" id="some" required>
          </div>
          <div class="form-group">
            <label for="some" class="col-form-label">القوة</label>
            <input type="text" name="unit" placeholder="50mg" class="form-control" id="some" required>
          </div>
          <div class="form-group">
            <label for="some" class="col-form-label">سعر المنتج الواحد</label>
            <input type="number" name="price"  class="form-control" id="some" required>
          </div>
          <div class="form-group">
            <label for="some" class="col-form-label">اسم المستورد</label>
            <input type="text" name="supplier"  class="form-control" id="some" required>
          </div>
          <div class="form-group">
            <label for="some" class="col-form-label">الشركة المصنعه للدواء</label>
            <input type="text" name="company"  class="form-control" id="some" required>
          </div>
          <div class="form-group">
            <label for="some" class="col-form-label">اختار تصنيف الدواء
            </label>
            <select class="form-control" required name="catId">
              <option selected disabled value="">الرجاء قم باختيار تصنيف الدواء</option>
            <?php getAllCat(); ?>
              
            </select>
          </div>
           <div class="form-group">
            <label for="some" class="col-form-label">وصف العلاج</label>
          <textarea class="form-control" name="discription" required placeholder="قم بكتابة وصف حول الدواء"></textarea> 
          </div>
          <div class="center">
            <button type="submit" name="saveProduct" class="btn btn-primary">حفظ</button>
            <button type="reset" class="btn btn-success">الغاء</button>
          </div>
        </form>
    </div>
</div>

</body>
</html>

<script type="text/javascript">
  $(document).ready(function(){$(".rightAccount").click(function(){$(".account").fadeToggle();});});
</script>

