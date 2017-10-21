<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo public_helper('css/style.css');?>">
    <title>Đăng nhập</title>
</head>
<body>
    <div class="container">
    <div class="login"> 
        <h1>ĐĂNG NHẬP</h1>
    <h3><?php echo @$errlogin;?></h3>
        <form action="<?php echo base_url().'dangnhap'; ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Password">
                <?php echo form_error('username'); ?>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                <?php echo form_error('password'); ?>
            </div>
            <!-- <div class="form-check">
                <label class="form-check-label">
                <input type="checkbox" class="form-check-input">
                Check me out
                </label>
            </div> -->
            <button type="submit" class="btn btn-primary" id="ok" name="ok">Submit</button>
        </form>
    </div>    
    </div>

</body>
</html>