<?php
error_reporting(0);
include '../classes/dbh.php';
$student = new Student();
$studentData = $student->getStudent();
$msg = $_GET['msg'];
$type = $_GET['type'];
if (isset($_COOKIE['admin']) || $_COOOKIE['admin'] !='') {
?>
<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
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
							<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-pie-chart">
								<path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path>
								<path d="M22 12A10 10 0 0 0 12 2v10z"></path>
							</svg>
						</a>
					</li>
					<li class="items active" title="Students" data-bs-toggle="tooltip" data-bs-placement="right">
						<a href="./students.php">
							<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users">
								<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
								<circle cx="9" cy="7" r="4"></circle>
								<path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
								<path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
							</svg>
						</a>
					</li>
					<li class="items" title="Results" data-bs-toggle="tooltip" data-bs-placement="right">
						<a href="./result.php">
							<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trello">
								<rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
								<rect x="7" y="7" width="3" height="9"></rect>
								<rect x="14" y="7" width="3" height="5"></rect>
							</svg>
						</a>
					</li>
					<li class="items" title="Attendance" data-bs-toggle="tooltip" data-bs-placement="right">
						<a href="./attendance.php">
							<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar">
								<rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
								<line x1="16" y1="2" x2="16" y2="6"></line>
								<line x1="8" y1="2" x2="8" y2="6"></line>
								<line x1="3" y1="10" x2="21" y2="10"></line>
							</svg>
						</a>
					</li>
					<li class="items" title="Classes" data-bs-toggle="tooltip" data-bs-placement="right">
						<a href="./classes.php">
							<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book">
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
									<button class="btn btn-white dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
										<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#364f6b" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
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
								<img src="../assets/images/90386cf7a87194974964887f3e8090df.jpg" class="rounded-circle my-auto" height="40" width="40">
							</div>
						</div>
					</div>
				</nav>

				<div class="container mt-5">
					<?php
					if ($type == 'success') {
						echo '
							<div style="border-left: 5px solid green;" class="alert col-5 bg-white alert-dismissible fade show"
							role="alert">
								<div class="d-flex">
									<strong>
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
											fill="none" stroke="green" stroke-width="2" stroke-linecap="round"
											stroke-linejoin="round" class="feather feather-check-circle">
											<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
											<polyline points="22 4 12 14.01 9 11.01"></polyline>
										</svg>
									</strong>
									<div class="mx-auto">
										<p class="mb-0" style="font-weight: 500;">' . $msg . '</p>
									</div>
								</div>
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>';
					} else if ($type == 'error') {
						echo '
							<div style="border-left: 5px solid red;" class="alert col-5 bg-white alert-dismissible fade show"
							role="alert">
								<div class="d-flex">
									<strong>
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="red" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
									</strong>
									<div class="mx-auto">
										<p class="mb-0" style="font-weight: 500;">' . $msg . '</p>
									</div>
								</div>
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>';
					} else {
						echo '';
					}
					?>
					<!-- Button trigger modal -->
					<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus">
							<path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
							<circle cx="8.5" cy="7" r="4"></circle>
							<line x1="20" y1="8" x2="20" y2="14"></line>
							<line x1="23" y1="11" x2="17" y2="11"></line>
						</svg>
					</button>

					<!-- Modal -->
					<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-lg modal-dialog-centered">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<form action="../scripts/server.php" id="validate_form" method="POST">
										<label for="name" class="form-label">Name</label>
										<input autocomplete="off" type="text" class="mb-1 form-control form-control-sm" name="name" id="name" required data-parsley-trigger="keyup" data-parsley-required="true" data-parsley-pattern="^[a-zA-Z\s]+$">
										<label class="form-label mt-3" for="fathersname">Father Name</label>
										<input autocomplete="off" type="text" class="mb-1 form-control form-control-sm" name="fname" id="fname" required data-parsley-trigger="keyup" data-parsley-required="true" data-parsley-pattern="^[a-zA-Z\s]+$">
										<label for="class" class="form-label mt-3">Class</label>
										<select class="form-select form-select-sm" name="class" id="class" required>
											<option value="0" selected>Choose...</option>
											<?php
											$classes = new ClassData();
											$classData = $classes->getClasses();

											foreach($classData as $classRow) {
												echo '<option value="'.$classRow['class'].'">'.$classRow['class'].'</option> ';
											}
											?>
										</select>
										<label class="form-label mt-3" for="phone">Mobile</label>
										<input autocomplete="off" required type="number" class="mb-1 form-control form-control-sm" name="mob" id="mob" data-parsley-trigger="keyup" maxlength="10">
										<button type="submit" name="addStudent" class="mt-4 btn btn-primary">Add
											Data</button>
									</form>
								</div>
							</div>
						</div>
					</div>
					<?php
					if (sizeof((array)$studentData) == 0) {
						echo '
						<div style="border-left: 5px solid red;" class="alert mt-5 col-5 bg-white alert-dismissible fade show"
							role="alert">
								<div class="d-flex">
									<strong>
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="red" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
									</strong>
									<div class="mx-auto">
										<p class="mb-0" style="font-weight: 500;">No students Enrolled Yet</p>
									</div>
								</div>
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						';
					}
					foreach ($studentData as $data) {
						echo '
	
						<div class="card shadow-blue mt-3 students">
							<div class="row">
								<div class="col">
									<img src="../assets/images/default-user-image.png" width="100" height="100">
								</div>
								<div class="col my-auto text-center">
									<p style="font-weight: 500;" class="faded-primary">Name</p>
									<p style="font-weight: 500;" class="text-primary mb-0">' . $data['name'] . '</p>
								</div>
								<div class="col my-auto text-center">
									<p style="font-weight: 500;" class="faded-primary">Roll Number</p>
									<p style="font-weight: 500;" class="text-primary text-uppercase mb-0">' . $data['rollnumber'] . '</p>
								</div>
								<div class="col my-auto text-center">
									<p style="font-weight: 500;" class="faded-primary">Attendance</p>
									<span style="font-weight: 500;"
										class="text-uppercase badge 
										';
						if (round($data['attendance'], 1) > 70) {
							echo "bg-success border-success text-white";
						} else if (round($data['attendance'], 1) > 50 && round($data['attendance'], 1) < 69) {
							echo "bg-warning text-dark border-warning ";
						} else {
							echo "bg-danger text-white border-danger ";
						}
						echo '
										">' . round($data['attendance'], 1) . '%</span>
								</div>
								<div class="col my-auto text-center">
									<p style="font-weight: 500;" class="faded-primary">Class</p>
									<p style="font-weight: 500;" class="text-primary mb-0">' . $data['class'] . '</p>
								</div>

								<div class="col my-auto text-center">
									<p style="font-weight: 500;" class="faded-primary">Result</p>
									<span style="font-weight: 500;"
										class="text-uppercase badge '; 
										if ($data['result'] == 0) {
											echo "bg-warning text-dark";
										} else if ($data['result'] == -1) {
											echo "bg-danger text-light";
										} else if ($data['result'] == 1) {
											echo 'bg-success text-light';
										}
										echo '">'; 
										if ($data['result'] == 0) {
											echo "Not Updated";
										} else if ($data['result'] == -1) {
											echo "failed";
										} else if ($data['result'] == 1) {
											echo 'passed';
										}
										echo '</span>
								</div>
							</div>
							<div class="accordion accordion-flush" id="accordionFlushExample' . $data['id'] . '">
								<div class="accordion-item">
									<h2 class="accordion-header" id="flush-headingOne' . $data['id'] . '">
										<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
											data-bs-target="#flush-collapseOne' . $data['id'] . '" aria-expanded="false"
											aria-controls="flush-collapseOne' . $data['id'] . '">
											Personal Info
										</button>
									</h2>
									<div id="flush-collapseOne' . $data['id'] . '" class="accordion-collapse collapse"
										aria-labelledby="flush-headingOne' . $data['id'] . '" data-bs-parent="#accordionFlushExample' . $data['id'] . '">
										<div class="accordion-body">
											<div class="row">
												<div class="col-8">
													<p class="mb-0">Name: <span class="fw-bold text-primary">' . $data['name'] . '</span> </p>
													<p class="my-2">Roll Number: <span
															class="text-uppercase fw-bold text-primary">' . $data['rollnumber'] . '</span></p>
												</div>
												<div class="col-4">
													<p class="mb-0"> Fathers Name: <span class="fw-bold text-primary">' . $data['fathername'] . '</span> </p>
													<p class="my-2">Mobile: <span
															class="fw-bold text-primary">' . $data['mobile'] . '</span></p>
												</div>
											</div>
										</div>
									</div>
								</div>
								
								<div class="accordion-item">
									<h2 class="accordion-header" id="flush-headingThree' . $data['id'] . '">
										<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
											data-bs-target="#flush-collapseThree' . $data['id'] . '" aria-expanded="false"
											aria-controls="flush-collapseThree' . $data['id'] . '">
											Update Data
										</button>
									</h2>
									<div id="flush-collapseThree' . $data['id'] . '" class="accordion-collapse collapse"
										aria-labelledby="flush-headingThree' . $data['id'] . '" data-bs-parent="#accordionFlushExample' . $data['id'] . '">
										<div class="accordion-body">
											<div class="col-md-4">
												<div class="row mx-auto">
													<div class="col-6 px-0 d-flex">
														<a href="./update.student.php?id=' . $data['id'] . '" class="btn svg1" data-bs-toggle="tooltip"
															data-bs-placement="bottom" title="Edit">
															<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
																viewBox="0 0 24 24" fill="none" stroke="currentColor"
																stroke-width="2" stroke-linecap="round"
																stroke-linejoin="round" class="feather feather-edit">
																<path
																	d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
																</path>
																<path
																	d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
																</path>
															</svg>
														</a>
														<form action="../scripts/server.php" method="POST">
															<input type="hidden" value="' . $data['id'] . '" name="id">
															<button name="deleteStudent" type="submit" onclick="return confirm(\'this action cannot be undone. Do you want to delete this student?\')" class="btn svg2" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete">
																<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
																	viewBox="0 0 24 24" fill="none" stroke="currentColor"
																	stroke-width="2" stroke-linecap="round"
																	stroke-linejoin="round" class="feather feather-trash">
																	<polyline points="3 6 5 6 21 6"></polyline>
																	<path
																		d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
																	</path>
																</svg>
															</button>
														</form>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>';
					}
					?>
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
		$(document).ready(function() {
			$('[data-bs-toggle="tooltip"]').tooltip();
		});
	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<script>
		$(document).ready(function() {
			$('#validate_form').parsley()
		});
	</script>

</body>

</html>
<?php
} else {
  header("Location: ../");
}
?>