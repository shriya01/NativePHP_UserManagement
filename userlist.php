<?php 
include('header.php');
include('CoreModel.php');

if (isset($_SESSION['email'])) {
    $obj1 = new CoreModel;
    $result = $obj1 -> selectDataFromTwoTable('firstname,lastname,user_image', 'users', 'users_profile_detail', 'left', 'users.user_id=users_profile_detail.user_id');
    //print_r($result);?>   <div class="container">
    <div class="row">
        <?php
        $i=0;
    if ($i < count($result)) {
        foreach ($result as $value) {
            ?>
                <div class="col-xs-18 col-sm-6 col-md-3">
                    <div class="thumbnail">
                        <img style="width: 205px; height: 204px;" src="images/<?php echo isset($result[$i]['user_image']) ? $result[$i]['user_image'] : 'no-image.png'; ?>"  alt="">
                        <div class="caption">
                            <h4><?php echo ucwords($result[$i]['firstname'])." ".ucwords($result[$i]['lastname']); ?></h4>
                            <p><a href="#" class="btn btn-info btn-xs" role="button">Like</a> <a href="#" class="btn btn-primary btn-xs" role="button">Share</a> <a href="#" class="btn btn-danger btn-xs" role="button">Subscribe</a></p>
                        </div>
                    </div>
                </div>
                <?php   $i++;
        } ?>
        </div>
        <?php
    }
} else {
    ?>
    <div class="container">
        <h2>You need permission to access this page.</h2><a href="login.php">Login Here</a>
    </div>
    <?php
}
include('footer.php');?>
