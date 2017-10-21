<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo public_helper('css/style.css');?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="<?php echo public_helper('js/app.js');?>"></script>
    <title>Đăng kí</title>
</head>
<body>
    <div class="container">
        <div class="login">
            <h1>Đăng kí tài khoản mới</h1>
        <?php echo @$success; ?>
        <form action="<?php echo base_url().'dangki'; ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Nhập tên đăng nhập">
                <?php echo form_error('username'); ?>
                <span id="errname"></span>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" id="password" placeholder="Nhập mật khẩu" name="password">
                <?php echo form_error('password'); ?>
                <span id="errpass"></span>
            </div>
            <div class="form-group">
                <label>Password Confirm</label>
                <input type="password" class="form-control" id="repassword" placeholder="Nhập lại mật khẩu" name="repassword">
                <?php echo @$loipass; ?>
                <?php echo form_error('repassword'); ?>
            </div>
            <div class="form-group">
                <label>Role</label>
                <select name="level">
                                        <option value="0" >Admin</option>
                                         <option value="1" >User</option>
                                    </select>
                <?php echo form_error('level'); ?>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Nhập email">
                <?php echo form_error('email'); ?>
                <span id="erremail"></span>
            </div>
            <button type="submit" class="btn btn-primary" id="ok" name="ok">Submit</button>
            <a href="<?php echo base_url()."quan-tri";?>" class="btn btn-danger">Trở về</a>
        </form>
        </div>
    </div>

</body>
</html>