<div class="col-sm-12" id="id01" class="modal">
    <form role="form" class="modal-content animate" method="POST" action="processLogin.php">
    <div class="col-sm-8">
        <div class="form-group row">
            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-6">
                <input type="email" class="form-control" name="email" value="<?php if(isset($_SESSION['email'])){
                    echo $_SESSION['email'];
                } ?>" placeholder="Email">
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-sm-2 col-fom-label">Password</label>
            <div class="col-sm-6">
            <input type="password" name="password" placeholder="Password"  class="form-control" require>
            </div>
        </div>

        <div class="form-group row">
            <div class="offset-sm-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Login</button> <button type="reset" class="btn btn-primary">Reset</button>
            </div>
        </div>
        <div class="col-sm-8">
            <a href="forgot.php">Forgot Password</a>
        </div>

        <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      <span class="psw">Forgot <a href="#">password?</a></span>
    </div>
    </div>