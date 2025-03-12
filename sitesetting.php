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
if ($con->query("update site SET title='$_POST[title]',name='$_POST[name]'")) {
  $notice ="<div class='alert alert-success'>تم الحفظ بنجاح</div>";
}
else{
  $notice ="<div class='alert alert-danger'>خطا:".$con->error."</div>";
}
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
        <a href="index.php"><li ><i class="fa fa-circle-o fa-fw"></i> لرئيسية</li></a>
        <a href="inventeries.php"><li><i class="fa fa-circle-o fa-fw"></i> الادوية</li></a>
       <a href="addnew.php"><li ><i class="fa fa-circle-o fa-fw"></i> اضافة دواء جديد</li></a>
        <a href="reports.php"><li><i class="fa fa-circle-o fa-fw"></i> الفواتير</li></a>
      </ul><
    </div>
  </div>
  <div style="background:#1E282C;color: white;padding: 13px 17px;border-left: 3px solid #3C8DBC;"><span><i class="fa fa-globe fa-fw"></i> اعدادات اخرى</span></div>
  <div class="item">
      <ul class="nostyle zero">
        <a href="sitesetting.php"><li style="color: white"><i class="fa fa-circle-o fa-fw"></i> اعدادات النظام</li></a>
       <a href="profile.php"><li><i class="fa fa-circle-o fa-fw"></i>  الملف الشخصي</li></a>
        <a href="accountSetting.php"><li><i class="fa fa-circle-o fa-fw"></i> بيانات الحساب</li></a>
        <a href="logout.php"><li><i class="fa fa-circle-o fa-fw"></i> تسجيل الخروج</li></a>
      </ul>
    </div>
</div>
<div class="marginLeft" >
    <div style="color:white;background:#3C8DBC" >

    <div class="pull-right flex rightAccount" style="padding-right: 11px;padding: 7px;">


      <div></div>

      <div style="padding: 20px"></div>
    </div>
    <div class="clear"></div>
  </div>
 
  <div class="content2">
<ol class="breadcrumb ">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> لوحة التحكم</a></li>
        <li class="active">اعدادات النظام</li>
    </ol>
    <?php echo $notice ?>
    <div style="width: 55%;margin: auto;padding: 22px;" class="well well-sm center">

      <h4>اعدادات النظام</h4><hr>
      <form method="POST">
         <div class="form-group">
            <label for="some" class="col-form-label">عنوان النظام</label>
            <input type="text" name="title" class="form-control" value="<?php echo siteTitle() ?>" id="some" required>
          </div>
          <div class="form-group">
            <label for="some" class="col-form-label"> اسم النظام</label>
            <input type="text" name="name" value="<?php echo siteName() ?>" class="form-control" id="some"  required>
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

