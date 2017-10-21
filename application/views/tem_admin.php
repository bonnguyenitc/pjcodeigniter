<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quản lý</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo public_helper('css/style.css');?>">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="<?php echo base_url().'quan-tri';?>">ADMIN</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="<?php echo base_url().'quan-tri';?>">Home <span class="sr-only">(current)</span></a>
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li> -->
            <!-- <li class="nav-item">
              <a class="nav-link disabled" href="#">Disabled</a>
            </li> -->
          </ul>
          <form class="form-inline my-2 my-lg-0" action="<?php echo base_url().'user/timkiem';?>" method="post">
            <input class="form-control mr-sm-2" type="text" required placeholder="Search" aria-label="Search" name="search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
      </nav>
    <div class="content">  
        <div class="container">
            
        <div class="row">
            <div class="col-md-10">
                <h2>Danh sách user</h2>
                <hr>
                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Họ Tên</th>
                        <th>Địa chỉ</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>        
                    <?php if(@$str) echo @$str ;?>
                    <?php if(@$back){?>
                        <a href="<?php  @$back;?>">Trở lại</a>

                        <?php } ?>          
                        <?php if(@$ds){ ?>
                      <?php foreach ($ds as $value) {
                        if ($value['id'] != $this->session->userdata("id") && $this->session->userdata("level") != $value['level'] && $this->session->userdata("level") == "0") {?>
                            <tr>
                                <th scope="row"><?php echo $value['id']; ?></th>
                                <td><?php echo $value['name']; ?></td>
                                <td><?php echo $value['address']; ?></td>
                                <td><?php echo $value['phone'] ;?></td>
                                <td><?php echo $value['email'] ;?></td>
                                
                                <td><a href="<?php echo base_url()."chinhsua/".$value['id'];?>" class="btn btn-success">Edit</a>
                                <?php if($this->session->userdata('level')== 0){?>
                                  <a href="<?php echo base_url()."user/delete/".$value['id'];?>" class="btn btn-danger">Delete</a>
                                  <?php } ?>
                                </td>

                            </tr>
                                
                        <?php } ?>
                            
                        <?php if($value['id'] == $this->session->userdata('id') && $this->session->userdata('level') == "1" ){ ?>
                            <tr>
                                <th scope="row"><?php echo $value['id']; ?></th>
                                <td><?php echo $value['name']; ?></td>
                                <td><?php echo $value['address']; ?></td>
                                <td><?php echo $value['phone'] ;?></td>
                                <td><?php echo $value['email'] ;?></td>
                                
                                <td><a href="<?php echo base_url()."chinhsua/".$value['id'];?>" class="btn btn-success">Edit</a>
                                <?php if($this->session->userdata('level')== 0){?>
                                  <a href="<?php echo base_url()."user/delete/".$value['id'];?>" class="btn btn-danger">Delete</a>
                                  <?php } ?>
                                </td>

                            </tr>
                      
                        <?php
                        }
                        
                      } ?>
                      <?php } ?>
                    </tbody>

                  </table>   
                    <div class="pager">               
                <?php echo @$page; ?>
               
        </div>
            </div>
            <div class="col-md-2">
                <h4><?php echo 'Xin chào, '.$this->session->userdata("username");?></h4>
                <?php if($this->session->userdata('level')== 0){?>
                <p><a href="<?php echo base_url()."dangki";?>" class="btn btn-primary">Thêm tài khoản mới</a></p>
                <?php } ?>
                <p><a href="<?php echo base_url()."user/logout";?>" class="btn btn-danger">Logout</a></p>
            </div>
        </div>

        
    </div>
    </div>
</body>
</html>