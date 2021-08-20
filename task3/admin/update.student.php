<?php
use UI\Controls\Form;
error_reporting(0);
include '../classes/dbh.php';
$student = new Student();
$studentData = $student->getStudent();
$studentid = $_GET['id'];
?>
<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
	<title>Student Result Management System</title>
	<link rel="stylesheet" href="../assets/styles/index.css">
	<style>
		.parsley-errors-list {
			padding: 0 !important;
		}

		.parsley-required,
		.parsley-type,
		.parsley-pattern,
		.parsley-maxlength {
			list-style: none !important;
			color: red !important;
		}
	</style>
</head>

<body>
	<div class="container-fluid">
		<div class="row p-0">
			<div class="col-md-1 sidebar p-0" style="overflow-y: hidden;">
				<div class="logo-light mt-3 mx-auto">
					<span class="s">S</span>
					<span class="r">R</span>
					<span class="m">M</span>
					<span class="s_1">S</span>
				</div>
				<ul class="sidebar-links text-center">
					<li class="items" title="Dashboard" data-bs-toggle="tooltip" data-bs-placement="right">
						<a href="./index.php">
							<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"
								fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
								stroke-linejoin="round" class="feather feather-pie-chart">
								<path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path>
								<path d="M22 12A10 10 0 0 0 12 2v10z"></path>
							</svg>
						</a>
					</li>
					<li class="items active" title="Students" data-bs-toggle="tooltip" data-bs-placement="right">
						<a href="./students.php">
							<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"
								fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
								stroke-linejoin="round" class="feather feather-users">
								<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
								<circle cx="9" cy="7" r="4"></circle>
								<path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
								<path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
							</svg>
						</a>
					</li>
					<li class="items" title="Results" data-bs-toggle="tooltip" data-bs-placement="right">
						<a href="./result.php">
							<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"
								fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
								stroke-linejoin="round" class="feather feather-trello">
								<rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
								<rect x="7" y="7" width="3" height="9"></rect>
								<rect x="14" y="7" width="3" height="5"></rect>
							</svg>
						</a>
					</li>
					<li class="items" title="Attendance" data-bs-toggle="tooltip" data-bs-placement="right">
						<a href="./attendance.php">
							<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"
								fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
								stroke-linejoin="round" class="feather feather-calendar">
								<rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
								<line x1="16" y1="2" x2="16" y2="6"></line>
								<line x1="8" y1="2" x2="8" y2="6"></line>
								<line x1="3" y1="10" x2="21" y2="10"></line>
							</svg>
						</a>
					</li>
					<li class="items" title="Classes" data-bs-toggle="tooltip" data-bs-placement="right">
						<a href="./classes.php">
							<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"
								fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
								stroke-linejoin="round" class="feather feather-book">
								<path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
								<path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
							</svg>
						</a>
					</li>

				</ul>
			</div>
			<div class="col-md-11 px-0 main-content" style="height: 100vh;overflow-y: scroll !important;">
				<nav class="navbar shadow-blue navbar shadow-blue-expand-lg bg-white">
					<div class="container-fluid px-5 mx-2" style="width: 100%;">
						<div class="row" style="width: 100%;">
							<div class="col-6">
								<div class="heading-text">Student <span>Management</span></div>
							</div>
							<div class="col-6 d-flex text-end my-auto">
								<div class="dropdown ms-auto">
									<button class="btn btn-white dropdown-toggle" type="button" id="dropdownMenuButton1"
										data-bs-toggle="dropdown" aria-expanded="false">
										<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
											viewBox="0 0 24 24" fill="none" stroke="#364f6b" stroke-width="1.5"
											stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
											<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
											<circle cx="12" cy="7" r="4"></circle>
										</svg>
									</button>

									<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
										<li><a class="dropdown-item" href="profile.php">Profile</a></li>
										<li>
											<form action="../scripts/authenticate.php" method="POST">
												<button class="dropdown-item" type="submit" name="logout">Logout</button>
											</form>
										</li>
									</ul>
								</div>
								<img src="../assets/images/90386cf7a87194974964887f3e8090df.jpg"
									class="rounded-circle my-auto" height="40" width="40">
							</div>
						</div>
					</div>
				</nav>

				<div class="container mt-5">
                    <div class="card p-4 shadow-blue">
                    <?php
					foreach ( $studentData as $data ) {
                        if ( $studentid == $data['id'] ) {
                            echo '
                            <form action="../scripts/server.php" id="validate_form" method="POST">
                                <label for="name" class="form-label">Name</label>
                                <input autocomplete="off" value="'.$data['name'].'" type="text" class="mb-1 form-control form-control-sm"
                                    name="name" id="name" required data-parsley-trigger="keyup"
                                    data-parsley-required="true" data-parsley-pattern="^[a-zA-Z\s]+$">
                                <label class="form-label mt-3" for="fathersname">Father Name</label>
                                <input autocomplete="off" value="'.$data['fathername'].'" type="text" class="mb-1 form-control form-control-sm"
                                    name="fname" id="fname" required data-parsley-trigger="keyup"
                                    data-parsley-required="true" data-parsley-pattern="^[a-zA-Z\s]+$">
                                <label for="class" class="form-label mt-3">Class</label>
                                <select class="form-select form-select-sm" name="class" id="class" required>
                                    ';
                                    $classData = new ClassData();
                                    $dataClass = $classData -> getClasses();
                                    foreach($dataClass as $classes) {
                                        echo '<option ';
                                        if ($classes['class'] == $data['class']) {
                                            echo "selected ";
                                        }
                                        echo 'value="'.$classes['class'].'">'.$classes['class'].'</option>';
                                    }
                                    echo '
                                </select>
                                <label class="form-label mt-3" for="phone">Mobile</label>
                                <input value="'.$data['mobile'].'" autocomplete="off" required  type="number"
                                    class="mb-1 form-control form-control-sm" name="mob" id="mob"
                                    data-parsley-trigger="keyup" maxlength="10">
                                <input type="hidden" value="'.$data['id'].'" name="sid">
                                <button type="submit" name="updateStudent" class="mt-4 btn btn-primary">Update
                                    Data</button>
                            </form>
                            ';
                        }
						
					}
					?>
                    </div>
				</div>
			</div>
		</div>
		
	</div>


	<!-- Optional JavaScript; choose one of the two! -->

	<!-- Option 1: Bootstrap Bundle with Popper -->
	<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script> -->

	<!-- Option 2: Separate Popper and Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>
	<script>
		$(document).ready(function () {
			$('[data-bs-toggle="tooltip"]').tooltip();
		});
	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"
		integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ=="
		crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<script>
		$(document).ready(function () {
			$('#validate_form').parsley()
		});
	</script>

</body>

</html>