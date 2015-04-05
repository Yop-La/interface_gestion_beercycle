<!DOCTYPE html>
	<html>
  <head>
    <meta charset="utf-8">
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/css/tuto.css" rel="stylesheet">
		<link href="assets/css/bootstrap-theme.min.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <?php include("header.html"); ?>
			<nav class="row navbar navbar-default">
				<ul class="nav navbar-nav">
					<li> <a href="#">Homepage</a> </li>
				</ul>
			</nav>
			<div class="row">
				<section class="col-lg-offset-4 col-lg-4">	
					<div class="row form_authentification">
						<form class="well ">
							<legend>Authentification</legend>
							<label for="user">User name</label>
							<input id="user" type="text" class="form-control">
							<label for="password">Password </label>
							<input id="password" type="password" class="form-control">
						</form>
					</div>
				</section>
			</div>
			<footer class="row navbar navbar-default">
				<div class="posi-footer">
					<ul class="nav col-lg-offset-4 col-lg-2">
						<li class="gras"><a href='#'><em>Beercycle</em></a></li>
						<li><a href='#'>Who are we ?</a></li>
						<li><a href='#'>Contact us</a></li>
					</ul>
					<ul class="nav col-lg-2">
						<li class="gras"><a href='#'><em>Our stores</em></a></li>
						<li><a href='#'>Zefoneworld</a></li>
						<li><a href='#'>Brazaville</a></li>
						<li><a href='#'>kinshasa</a></li>
					<ul>
				</div>
			</footer>
    </div>
		<script src="bootstrap/js/jquery.js"></script> 
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>



