<?php
include('./includes/connection.php');

if (isset($_POST['login'])) {
	session_start();

    $username_email = $_POST['email'];
    $password = $_POST['password'];

    $username_email = mysqli_real_escape_string($conn, $username_email);
    $password = mysqli_real_escape_string($conn, $password);

    $query = "SELECT * FROM users WHERE email='$username_email' AND password='$password'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['id'] = $user['user_id'];
        $_SESSION['name'] = $user['name'];

        $extra = "user-dashboard.php";
        header("Location: $extra");
        exit();
    } else {
        echo "<script>alert('Invalid username or password');</script>";
        $extra = "index.php";
        echo "<script>window.location.href='" . $extra . "'</script>";
        exit();
    }
}

mysqli_close($conn);
?>
<head>
    <style>
        .modal-dialog {
            overflow-y: auto;
            max-height: 100vh;
        }
    </style>
</head>

		<div class="position-relative p-0">
			<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
				<a href="./" class="navbar-brand p-0">
					<h1 class="text-primary m-0"><i class="fa fa-balance-scale me-3"></i>Legal Advisor</h1>
				</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
					<span class="fa fa-bars"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarCollapse">
					<div class="navbar-nav ms-auto py-0 pe-4">
						<a href="./" class="nav-item nav-link active">Home</a>
						<a href="about-us.php" class="nav-item nav-link">About</a>
						<a href="contact-us.php" class="nav-item nav-link">Contact</a>
					</div>
					<a href="./lawyer/index.php"  class="btn btn-primary py-2 px-4">Register as a Lawyer</a>
					<a href="#"  class="lawyer btn btn-primary py-2 px-4 m-1">Book A Lawyer</a>
				</div>
			</nav>

			<div class="py-5 bg-dark hero-header mb-5">
				<div class="container my-5 py-5">
					<div class="row align-items-center g-5">
						<div class="col-lg-6 text-center text-lg-start">
							<h1 class="display-5 text-white animated slideInLeft">Your pathway<br>to legal expertis</h1>
						</div>

						<div class="col-lg-6 text-center text-lg-end overflow-hidden">

							<img class="img-fluid" src="./assets/img/justice.png" alt="" height="150px" width="150px">
						</div>
					</div>
				</div>
				<div class="d-flex justify-content-center">
				<form id="searchForm" action="search-lawyers.php" method="POST" class="w-50">
					<div class="input-group">
						<input type="text" class="form-control" id="lawyerSearchInput" placeholder="Search lawyers by name or location" name="query" required>
						<button type="submit" class="btn btn-primary">Search</button>
					</div>
				</form>
			</div>
		</div>

<div class="d-flex justify-content-center w-75" id="invalid-search" style="color:red"></div>
</div>
</div>

<!-- login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="login-form" method="post">
                    <div class="mb-3">
                        <label for="login-email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="login-email" name="email" placeholder="Enter email" required>
                    </div>
                    <div class="mb-3">
                        <label for="login-password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="login-password" name="password" placeholder="Password" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="login">Login</button>
                </form>
				<p class="mt-3">Not have Account? <a href="" id="login-link">Register</a></p>
            </div>
        </div>
    </div>
</div>

<!-- Registration Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="registerModalLabel">Register</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
				<div id="message"></div>
                <form id="register-form" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
						<div id="invalid-name" style="color:red;"></div><br>
					</div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
						<div id="invalid-email" style="color:red;"></div><br>
					</div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
						<div id="invalid-password" style="color:red;"></div><br>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="address" class="form-control" id="address" name="address" placeholder="address" required>
						<div id="invalid-address" style="color:red;"></div><br>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" required>
						<div id="invalid-phone" style="color:red;"></div><br>
                    </div>
                    <div class="mb-3">
						<label class="form-label">Gender</label>
						<div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="gender" id="gender-male" value="male" required>
								<label class="form-check-label" for="gender-male">Male</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="gender" id="gender-female" value="female" required>
								<label class="form-check-label" for="gender-female">Female</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="gender" id="gender-other" value="other" required>
								<label class="form-check-label" for="gender-other">Other</label>
							</div>
							<div id="invalid-gender" style="color:red;"></div><br>
						</div>
					</div>
                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
				<p class="mt-3">Already have an account? <a href="" id="login-link">Login</a></p>
            </div>
        </div>
    </div>
</div>
