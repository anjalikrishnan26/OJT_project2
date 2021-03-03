<!DOCTYPE html>
<html>
<head>
<title>update profile</title>
<meta charset=utf-8>
            <meta name="viewport" content="width=device-width,initial-scale=1">

             <!---Fontawesome--->
            <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
            <!---Bootstrap5----->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

 <style>
 
  .top1{
background-color:#5c00e6;

}
body{
background-image: url("../img/im2a.png");
background-size: cover;
background-attachment: fixed;
}


</style>
</head>
<body>

<nav class="navbar top1 navbar-expand-lg ">
    <div class="container">
      <a href="#" class="text-decoration-none text-white">TRAVEL KITE</a>  
      <div class="">
          <ul class="navbar-nav">
              <li class="nav-item"><a href="<?php echo base_url()?>main/passenger" class="nav-link text-white">Home</a></li> 
              <li class="nav-item"><a href="<?php echo base_url()?>main/passprofile" class="nav-link text-white">View Profile</a></li>
              <li class="nav-item"><a href="<?php echo base_url()?>main/flight" class="nav-link text-white">Flight Details</a></li>

              <li class="nav-item "><a href="#" class="nav-link text-white">Notification</a></li>

                <li class="nav-item "><a href="#" class="nav-link text-white">Log Out</a></li>
          </ul>
      </div>
    </div> 
 </nav>

<!--nav end-->
<section>

<div class="container ">
<div class="row">
<div class="container col-5 ms-5">
<h3 class="text-center text-primary mt-5">View Details</h3>
<form  method="post" action="<?php echo base_url()?>main/updatedetails1" class=" ">
<?php
            
    if(isset($user_data))
    { 
        foreach($user_data->result() as $row1)
        {
            ?>

<fieldset>


<label class=>First Name:</label>
<input type="text" name="fname" value="<?php echo $row1->fname;?>" required maxlength="25" pattern="[a-zA-Z]+" class="form-control">

<label class="">Last Name:</label>
<input type="text" name="lname"  value="<?php echo $row1->lname;?>" required maxlength="25" pattern="[a-zA-Z]+" class="form-control">


<label class="form-label">Age:</label>
<input type="text" name="age" value="<?php echo $row1->age;?>" required class="form-control"><br>

<label >Gender:</label>
                    <select name="gender">
                        <option>
                            <?php echo $row1->gender;?>
                        </option>
                        <option>male</option>
                        <option>female</option>
                    </select><br>



<label class="form-label">Address:</label>
<textarea name="address"  required  class="form-control" placeholder="Address"><?php echo $row1->address;?></textarea>

<label class="form-label">District:</label>
<input list="district" name="district" value="<?php echo $row1->district;?>" required class="form-control" placeholder="District">
<datalist id="district">
<option value="kollam">
<option value="Trivandrum">
<option value="kottayam">
<option value="Alapuzha">
<option value="Idukki">
</datalist>

<label class="">Phone number:</label>
<input type="text" name="phno" value="<?php echo $row1->phno;?>"  required  pattern="[7-9]{1}[0-9]{9}" class="form-control">


<label class="">Email:</label>
<input type="Email" name="email" value="<?php echo $row1->email;?>" required class="form-control">


<div class="container text-center">

<input type="submit" name="update" value="update" class="btn btn-primary w-50 mt-3  mb-3">
</div>

<?php
        }
    }
    ?>

</fieldset>


</form>
</div>

<div class="col-7">
</div>

</div class="">
</div>
</section >

</body>
</html>
