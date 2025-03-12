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
if (isset($_POST['saveSetting'])) {
if ($con->query("update users SET email='$_POST[email]',password='$_POST[password]' where id='$_SESSION[userId]'")) {

  $notice ="<div class='alert alert-success'>تم الحفظ</div>";
  header("location:accountSetting.php?notice=تم الحفظ");
}
else{
  $notice ="<div class='alert alert-danger'>Error is:".$con->error."</div>";
}

}
if (isset($_GET['notice'])) {
  $notice = "<div class='alert alert-success'>تم الحفظ</div>";
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
        <a href="inventeries.php"><li ><i class="fa fa-circle-o fa-fw"></i> جميع الادوية</li></a>
       <a href="addnew.php"><li><i class="fa fa-circle-o fa-fw"></i> اضافة دواء جديد</li></a>
        <a href="reports.php"><li style="color: white"><i class="fa fa-circle-o fa-fw"></i> الفواتير</li></a>
      
      </ul>
    </div>
  </div>
  <div style="background:#1E282C;color: white;padding: 13px 17px;border-left: 3px solid #3C8DBC;"><span><i class="fa fa-globe fa-fw"></i> اعدادات اخرى</span></div>

  <div class="item">

      <ul class="nostyle zero">
        <a href="accountSetting.php"><li><i class="fa fa-circle-o fa-fw"></i> اعدادات الحساب</li></a>
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
        <li class="active">اعدادات الحساب</li>
    </ol>
    <?php echo $notice ?>
    <div style="width: 55%;margin: auto;padding: 22px;" class="well well-sm center">

      <h4>بيانات تسجيل الدخول</h4><hr>
      <form method="POST">
         <div class="form-group">
            <label for="some" class="col-form-label">البريد الالكتروني</label>
            <input type="email" name="email" class="form-control" value="<?php echo $user['email'] ?>" id="some" required>
          </div>
          <div class="form-group">
            <label for="some" class="col-form-label">كلمة المرور</label>
            <input type="password" name="password" value="<?php echo $user['password'] ?>" class="form-control" id="some"  required>
          </div>
          <div class="center">
            <button class="btn btn-primary btn-sm btn-block" name="saveSetting">حفظ</button>
          </div>   
        </form>
    </div>
</div>

</body>
</html>

<script type="text/javascript">
  $(document).ready(function(){$(".rightAccount").click(function(){$(".account").fadeToggle();});});
</script>

