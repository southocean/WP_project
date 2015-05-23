<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <![endif]-->
    <title>Bootstrap user profile template</title>
    <!-- BOOTSTRAP STYLE SHEET -->
    <link href="http://lipis.github.io/bootstrap-social/assets/css/bootstrap.css" rel="stylesheet">
    <link href="http://lipis.github.io/bootstrap-social/assets/css/font-awesome.css" rel="stylesheet">
     <!-- CUSTOM STYLE CSS -->
    <style type="text/css">
       .btn-social {
            color: white;
            opacity: 0.8;
        }
        .btn-social:hover {
            color: white;
            opacity: 1;
            text-decoration: none;
        }
        .btn-facebook {
            background-color: #3b5998;
        }
        .btn-twitter {
            background-color: #00aced;
        }
        .btn-linkedin {
            background-color: #0e76a8;
        }
        .btn-google {
            background-color: #c32f10;
        }
    </style>
</head>
<body>

    <div class="container">
        <?php

        ?>
        <section style="padding-bottom: 50px; padding-top: 50px;">
            <div class="row">
                <div class="col-md-4">
                    <img src="<?php echo $this->Gravatar->get_gravatar($userInfo['email'],500);?>" class="img-rounded img-responsive" />
                    <br />
                    <br />
                    <label> Username</label>
                    <input type="text" class="form-control" placeholder="<?php echo $userInfo['username']; ?>">
                    <label> Email</label>
                    <input type="text" class="form-control" placeholder="<?php echo $userInfo['email']; ?>">
                    <br>
                    <!-- <a href="#" class="btn btn-success">Update Details</a> -->
                    <br /><br/>
                </div>
                <div class="col-md-8">
                    <div class="alert alert-info">
                        <h2>User Level : </h2>
                        <?php
                            foreach ($userlevel as $item) {
                                $percentage = (int)$item['UserLevel']['correctNum']*100/$item['UserLevel']['totalNum'];
                                
                                if($percentage > 75)
                                    $barType = 'progress-bar-success';
                                elseif ($percentage > 50)
                                    $barType = 'progress-bar-info';
                                elseif ($percentage > 25)
                                    $barType = 'progress-bar-warning';
                                else
                                    $barType = 'progress-bar-danger';

                                echo $item['Subject']['sbName'];
                                echo "<div class=\"progress\">
                                   <div class=\"progress-bar ".$barType."\" role=\"progressbar\" aria-valuenow=\"60\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: ".$percentage."%;\">
                                      <span class=\"sr-only\">90% Complete (Sucess)</span>
                                   </div>
                                </div>";
                            }
                            
                        ?>
                    </div>
                    <div >
                        <a href="#" class="btn btn-social btn-facebook">
                            <i class="fa fa-facebook"></i>&nbsp; Facebook</a>
                        <a href="#" class="btn btn-social btn-google">
                            <i class="fa fa-google-plus"></i>&nbsp; Google</a>
                        <a href="#" class="btn btn-social btn-twitter">
                            <i class="fa fa-twitter"></i>&nbsp; Twitter </a>
                        <a href="#" class="btn btn-social btn-linkedin">
                            <i class="fa fa-linkedin"></i>&nbsp; Linkedin </a>
                    </div>
                    </div>
                    <div class="form-group col-md-8">
                        <h3>Change YOur Password</h3>
                        <br />
                        <label>Enter Old Password</label>
                        <input type="password" class="form-control">
                        <label>Enter New Password</label>
                        <input type="password" class="form-control">
                        <label>Confirm New Password</label>
                        <input type="password" class="form-control" />
                        <br>
                        <a href="#" class="btn btn-warning">Change Password</a>
                    </div>
                </div>
            </div>
            <!-- ROW END -->


        </section>
        <!-- SECTION END -->
    </div>
    <!-- CONATINER END -->

    <!-- REQUIRED SCRIPTS FILES -->
    <!-- CORE JQUERY FILE -->
    <script src="assets/js/jquery-1.11.1.js"></script>
    <!-- REQUIRED BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.js"></script>
</body>

</html>
