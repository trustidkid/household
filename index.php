<?php
    include('lib/header.php');
    require_once('functions/user.php');

    if(!is_user_loggedIn())
      session_destroy();
 ?>

<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <img src="image/hospital.jpeg" alt="Chania" width="100%" >
      <div class="carousel-caption">
        <h3>Ward</h3>
        <p>Patient at their comfort</p>
      </div>
    </div>

    <div class="item">
      <img src="image/hospital_1.png" alt="Chicago" width="100%">
      <div class="carousel-caption">
        <h3>Ward</h3>
        <p>Condusive for patient!</p>
      </div>
    </div>

    <div class="item">
      <img src="image/hospital_2.jpg" alt="New York" width="100%">
      <div class="carousel-caption">
        <h3>Head Office</h3>
        <p>A building with excellence!</p>
      </div>
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
 <div class='container'>
  <div class='row'>
    <div class='col-sm-12'>
        <h2><span style='color: blue'>Start.ng Hospital Application</span></h2>
      
        <p>
          <h4> The application helps hospital reduces issue related to attending to patient.
    </p></h4><p>
          <h4><span style='color: orange'>You can try it out...</span></h4>
          <a href="login.php" class='btn btn-success btn-lg'>Let go...</a>
        </p>
    </div>

    
    <div class='col-sm-4'>
      <h2>About Us</h2>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis a repudiandae esse voluptate, animi, incidunt placeat vel quam nostrum labore, adipisci autem modi tempora molestias voluptatibus magnam. Doloremque, dolores repellendus!</p>
    </div>
    <div class='col-sm-4'>
      <h2>Column 2</h2>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis a repudiandae esse voluptate, animi, incidunt placeat vel quam nostrum labore, adipisci autem modi tempora molestias voluptatibus magnam. Doloremque, dolores repellendus!</p>
    </div>
    <div class='col-sm-4'>
      <h2>Column 3</h2>
      <div  class='card'>Heading
        <div class='card'><div>
      </div>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis a repudiandae esse voluptate, animi, incidunt placeat vel quam nostrum labore, adipisci autem modi tempora molestias voluptatibus magnam. Doloremque, dolores repellendus!</p>
    </div>

    </div>
    
  </div>


