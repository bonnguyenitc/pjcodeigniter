<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trang USER</title>
</head>
<body>
    <h1>TRANG USER</h1>
    <h4><?php echo $this->session->userdata("username");?></h4>
     <p><a href="<?php echo base_url()."user/logout";?>">Logout</a></p>
</body>
</html>