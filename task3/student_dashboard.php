<?php
error_reporting(0);
include 'classes/dbh.php';
$msg = $_GET['msg'];
if (isset($_COOKIE['admin'])) {
    header("Location: admin/");
}
function calcGrades($marks)
{
    if ($marks >= 91 && $marks <= 100) {
        $grade =  "A1";
    } else if ($marks >= 81 && $marks <= 90) {
        $grade = "A2";
    } else if ($marks >= 71 && $marks <= 80) {
        $grade = "B2";
    } else if ($marks >= 61 && $marks <= 70) {
        $grade = "B2";
    } else if ($marks >= 51 && $marks <= 60) {
        $grade = "C1";
    } else if ($marks >= 41 && $marks <= 50) {
        $grade = "C2";
    } else if ($marks >= 33 && $marks <= 40) {
        $grade = "D";
    } else if ($marks <= 32) {
        $grade = "E";
    }

    return $grade;
}
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
    <link rel="stylesheet" href="./assets/styles/index.css">
</head>

<body>
    <div class="container-fluid px-0">
        <div class="header bg-white shadow-blue">
            <div class="container-fluid px-5">
                <div class="row">
                    <div class="col-6">
                        <div class="logo-dark">
                            <span class="s">S</span>
                            <span class="r">R</span>
                            <span class="m">M</span>
                            <span class="s_1">S</span>
                        </div>
                    </div>
                    <div class="col-6 d-flex my-auto">
                        <p class="text-end mb-0  ms-auto me-2" style="margin-left: auto;"><strong>Result: </strong></p>
                        <?php
                        $status = new Admin();
                        $status_data = $status->getStatus();
                        foreach ($status_data as $statusD) {
                            if ($statusD['status'] == 0) {
                                echo '<div class="badge bg-pink my-auto">Not Declared</div>';
                            } else if ($statusD['status'] == 1) {
                                echo '<div class="badge bg-secondary my-auto">Declared</div>';
                            }
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-5">

            <div class="report-card card shadow-blue" id="rc">
                <div class="logo-dark mx-auto my-4">
                    <span class="s">S</span>
                    <span class="r">R</span>
                    <span class="m">M</span>
                    <span class="s_1">S</span>
                </div>
                <h3 class="text-center mb-5 text-primary" print>Report Card</h3>
                <?php
                $student = new Student();
                $marks = new Marks();
                $classes = new ClassData();

                if (isset($_POST['viewResult'])) {
                    $studentData = $student->getStudentInfo($_POST['rollnumber']);
                    foreach ($studentData as $data) {
                        echo '
                            <div class="row">
                                <div class="col-6">
                                    <div class="p-3">
                                        <h5 style="font-weight: 500;">Name: ' . $data['name'] . '</h5>
                                        
                                        <h6>Rollnumber: ' . $data['rollnumber'] . '</h6>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-end p-3">
                                        <h5 style="font-weight: 500;">Fathers Name: ' . $data['fathername'] . '</h5>
                                        <h6>Class: ' . $data['class'] . '</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-primary">                                   
                               <h4 class="text-center text-white text-uppercase my-4">Final Scores</h4>                                   
                                <div class="bg-white">
                                    <div class="d-flex text-center py-4">
                                        <div class="col border-end">
                                            <h5 class="text-primary">Subject</h5><br>
                                            ';
                        $classData = $classes->getClasses();

                        foreach ($classData as $classD) {
                            if ($classD['class'] == $data['class']) {
                                echo '<p style="font-weight: 500;">' . $classD['subject1'] . '</p>';
                                echo '<p style="font-weight: 500;">' . $classD['subject2'] . '</p>';
                                echo '<p style="font-weight: 500;">' . $classD['subject3'] . '</p>';
                                echo '<p style="font-weight: 500;">' . $classD['subject4'] . '</p>';
                                echo '<p style="font-weight: 500;">' . $classD['subject5'] . '</p>';
                            }
                        }
                        echo '
                                        </div>
                                        <div class="col border-end">
                                            <h5 class="text-primary">Marks Obtained</h5><br>
                                            ';
                        $marksData = $marks->getMarks($data['rollnumber']);
                        foreach ($marksData as $marksD) {
                            if ($marksD['rollnumber'] == $data['rollnumber']) {
                                echo '<p style="font-weight: 500;">' . $marksD['sub1'] . '</p>';
                                echo '<p style="font-weight: 500;">' . $marksD['sub2'] . '</p>';
                                echo '<p style="font-weight: 500;">' . $marksD['sub3'] . '</p>';
                                echo '<p style="font-weight: 500;">' . $marksD['sub4'] . '</p>';
                                echo '<p style="font-weight: 500;">' . $marksD['sub5'] . '</p>';
                            }
                        }
                        echo '
                                        </div>
                                        <div class="col border-end">
                                            <h5 class="text-primary">Out Of</h5><br>
                                            ';
                        $marksData = $marks->getMarks($data['rollnumber']);
                        foreach ($marksData as $marksD) {
                            if ($marksD['rollnumber'] == $data['rollnumber']) {
                                echo '<p style="font-weight: 500;">100</p>';
                                echo '<p style="font-weight: 500;">100</p>';
                                echo '<p style="font-weight: 500;">100</p>';
                                echo '<p style="font-weight: 500;">100</p>';
                                echo '<p style="font-weight: 500;">100</p>';
                            }
                        }
                        echo '
                                        </div>
                                        <div class="col">
                                            <h5 class="text-primary">Grades</h5><br>
                                            ';
                        $marksData = $marks->getMarks($data['rollnumber']);
                        foreach ($marksData as $marksD) {
                            if ($marksD['rollnumber'] == $data['rollnumber']) {
                                echo '<p style="font-weight: 500;">' . calcGrades($marksD['sub1']) . '</p>';
                                echo '<p style="font-weight: 500;">' . calcGrades($marksD['sub2']) . '</p>';
                                echo '<p style="font-weight: 500;">' . calcGrades($marksD['sub3']) . '</p>';
                                echo '<p style="font-weight: 500;">' . calcGrades($marksD['sub4']) . '</p>';
                                echo '<p style="font-weight: 500;">' . calcGrades($marksD['sub5']) . '</p>';
                            }
                        }
                        echo '
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row px-3">
                                <div class="col-6">
                                    <p class="mb-0"><span style="font-weight: 500;">Percentage: </span>' . $data['percentage'] . '%</p>
                                    <p><span style="font-weight: 500;">Grade: </span>' . calcGrades($data['percentage']) . '</p>

                                </div>
                                <div class="col-6 text-end">
                                    Result: <span style="font-weight: 500;"
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
                            ';
                    }
                }
                ?>
                <footer class="text-center text-muted py-4">Student Result Management System | <?php echo date('Y'); ?></footer>
            </div>
            <button class="btn btn-primary" onclick="CreatePDFfromHTML()">Save</button>
        </div>
    </div>


    <!-- Optional JavaScript; choose one of the two! -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
    <style>
        .parsley-errors-list {
            padding: 0;
        }

        .parsley-required,
        .parsley-type {
            list-style: none;
            color: red !important;
        }
    </style>
    <script>
        function CreatePDFfromHTML() {
            var HTML_Width = $("#rc").width();
            var HTML_Height = $("#rc").height();
            var top_left_margin = 15;
            var PDF_Width = HTML_Width + (top_left_margin * 2);
            var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
            var canvas_image_width = HTML_Width;
            var canvas_image_height = HTML_Height;

            var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

            html2canvas($("#rc")[0]).then(function(canvas) {
                var imgData = canvas.toDataURL("image/jpeg", 1.0);
                var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
                pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
                for (var i = 1; i <= totalPDFPages; i++) {
                    pdf.addPage(PDF_Width, PDF_Height);
                    pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height * i) + (top_left_margin * 4), canvas_image_width, canvas_image_height);
                }
                pdf.save("Your_PDF_Name.pdf");
                $("#rc").hide();
            });
        }
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    -->
</body>

</html>