<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sửa</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="<?php echo public_helper('js/app.js');?>"></script>
      

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#">Disabled</a>
            </li>
          </ul>
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
      </nav>
    <div class="content">  
        <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h2>Danh sách khách hàng</h2>
                <hr>
                <?php foreach ($user as $value) {?>
                <!-- <?php echo validation_errors(); ?> -->
                <form action="<?php echo base_url()."chinhsua/".$value['id'];?>" method="post">
                <?php echo @$status; ?>
                <table class="table">                  
                    <tbody>                   
                            <tr>
                            	<td scope="row">ID</td>
                                <td scope="row"><input type="text" name="id" value="<?php echo $value['id']; ?>" disabled> </td>
                            </tr>
                            <tr>
                            	<td scope="row">Username</td>
                                <td scope="row"><input type="text" name="username" value="<?php echo $value['username']; ?>" disabled >                                                         </td>
                            </tr>
                            <tr>
                            	<td scope="row">Họ tên</td>
                                <td scope="row"><input type="text" name="name" id="name" value="<?php echo $value['name']; ?>" ><?php echo form_error('name'); ?>
                                <span id='errname'></span></td>

                            </tr>
                            <tr>
                            	<td scope="row">Địa chỉ</td>
                                <td scope="row"><input type="text" name="address" id="address" value="<?php echo $value['address']; ?>" ><?php echo form_error('address'); ?>
                                    <span id='erradd'></span></td>
                            </tr>
                            <tr>
                            	<td scope="row">Số điện thoại</td>
                                <td scope="row"><input type="number" name="phone" id="phone" value="<?php echo $value['phone']; ?>" ><?php echo form_error('phone'); ?>
                                    <span id='errphone'></span></td>
                            </tr>
                            <tr>
                            	<td scope="row">Email</td>
                                <td scope="row"><input type="text" name="email" id="email" value="<?php echo $value['email']; ?>" ><?php echo form_error('email'); ?>
                                    <span id='erremail'></span>
                                </td>
                            </tr>  
                           
                                
                                        <tr>
                                             <td scope="row">Password</td>
                                            <td scope="row"><input type="password" name="password" value="" ><?php echo form_error('password'); ?></td>
                            </tr>
                                    
                           
                            
                            <tr>
                            	<td scope="row">Level</td>
                                <td scope="row">
                                    <select name="level" <?php if($this->session->userdata('level')=='1') {echo 'disabled';}?>>
                                        <option value="0" <?php if($value['level'] == '0') 
                                        echo "selected" ?>>Admin</option>
                                         <option value="1" <?php if($value['level'] == '1') 
                                        echo "selected" ?>>User</option>
                                    </select>          
                                </td>                          
                            </tr>
                            <tr>
                      		<td><input type="submit" name="ok" value="Sửa" class="btn btn-primary">
                      			<a href="<?php echo base_url()."quan-tri";?>" class="btn btn-success">Trở về</a>
                      	</tr>
                    </tbody>

                  </table>    
                  </form>                                                         
                      <?php                                               
                      } ?>
                      	         
            </div>
            <div class="col-md-2">
                <h4><?php echo $this->session->userdata("username");?></h4>
                <p><a href="<?php echo base_url()."user/logout";?>" class="btn btn-danger">Logout</a></p>
            </div>
        </div>      
    </div>
    </div>
</body>
</html>