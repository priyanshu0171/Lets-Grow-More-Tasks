<?php
include "../classes/dbh.php";
if (isset($_POST['addStudent'])) {
    $name = $_POST['name'];
    $fname = $_POST['fname'];
    $class = $_POST['class'];
    $mobile = $_POST['mob'];

    $student = new Student();
    $studentData = $student->getStudent();

    if ($studentData == '') {
        $rollnumber = "SRMS1";
    } else {
        $rollnumber = "SRMS" . (int)max($studentData)['id'] + 1;
    }
    if ($rollnumber) {
        $addStudent = $student->addStudent($name, $fname, $class, $mobile, $rollnumber);
        if ($addStudent) {
            $msg =  "Student Added Successfuly";
            header("Location: ../admin/students.php?msg=$msg");
        } else {
            echo "Error";
        }
    }
}
if (isset($_POST['updateStudent'])) {
    $name = $_POST['name'];
    $fname = $_POST['fname'];
    $class = $_POST['class'];
    $mobile = $_POST['mob'];
    $id = $_POST['sid'];
    $student = new Student();
    $query = $student->updateStudent($name, $fname, $class, $mobile, $id);
    if ($query) {
        $msg = "Data Updated Succesfully";
        $type = "success";
    } else {
        $msg = "There was an error updating data";
        $type = "error";
    }
    header("Location: ../admin/students.php?msg=$msg&type=$type");
}
if (isset($_POST['deleteStudent'])) {
    $student = new Student();
    $query = $student->removeStudent($_POST['id']);
    if ($query) {
        $msg = "Student Removed Succesfully";
        $type = "success";
    } else {
        $msg = "There was an error removing student";
        $type = "error";
    }
    header("Location: ../admin/students.php?msg=$msg&type=$type");
}
if (isset($_POST['updateAttendance'])) {
    $da = $_POST['da'];
    $att = round(($da * 100) / 365, 2);
    $student = new Student();
    $query = $student->updateAtt($_POST['id'], $att, $da);
    if ($query) {
        $msg = "Woo Hoo!! Success";
        $type = "success";
    } else {
        $msg = "There was an error removing student";
        $type = "error";
    }
    header("Location: ../admin/attendance.php?msg=$msg&type=$type");
}
if (isset($_POST['updateAdmin'])) {
    $admin = new Admin();
    $query = $admin->updateAdmin($_POST['name'], $_POST['id'], $_POST['email'], $_POST['password']);
    if ($query) {
        $msg = "Data Updated Succesfully";
        $type = "success";
    } else {
        $msg = "There was an error updating profile";
        $type = "error";
    }
    header("Location: ../admin/profile.php?msg=$msg&type=$type");
}
if (isset($_POST['addClasses'])) {
    $classes = new ClassData();
    $query = $classes->AddClass($_POST['class'], $_POST['sub1'], $_POST['sub2'], $_POST['sub3'], $_POST['sub4'], $_POST['sub5']);
    if ($query) {
        $msg = "Class Added Succesfully";
        $type = "success";
    } else {
        $msg = "There was an error adding class";
        $type = "error";
    }
    header("Location: ../admin/classes.php?msg=$msg&type=$type");
}
if (isset($_POST['updateClasses'])) {
    $classes = new ClassData();
    $query = $classes->updateClass($_POST['class'], $_POST['sub1'], $_POST['sub2'], $_POST['sub3'], $_POST['sub4'], $_POST['sub5'], $_POST['id']);
    if ($query) {
        $msg = "Class Data Updated Succesfully";
        $type = "success";
    } else {
        $msg = "There was an error adding class";
        $type = "error";
    }
    header("Location: ../admin/classes.php?msg=$msg&type=$type");
}
if (isset($_POST['deleteClasses'])) {
    $classes = new ClassData();
    $query = $classes->deleteClass($_POST['id']);

    if ($query) {
        $student = new Student();
        $query1 = $student->removeStudentC($_POST['classid']);
        if ($query1) {
            $msg = "Class Deleted Succesfully";
            $type = "success";
        } else {
            $msg = "There was an error removing student";
            $type = "error";
        }
        header("Location: ../admin/classes.php?msg=$msg&type=$type");
    } else {
        $msg = "There was an error removing student";
        $type = "error";
    }
    header("Location: ../admin/classes.php?msg=$msg&type=$type");
}

if (isset($_POST['updateScore'])) {
    $marks = new Marks();
    $student = new Student();
    $rollnumber = $_POST['rollnumber'];
    $sub1 = $_POST['sub1'];
    $sub2 = $_POST['sub2'];
    $sub3 = $_POST['sub3'];
    $sub4 = $_POST['sub4'];
    $sub5 = $_POST['sub5'];
    $class = $_POST['class'];
    $query = $marks->addScores($rollnumber, $sub1, $sub2, $sub3, $sub4, $sub5, $class);
    if ($query) {
        $resultPer = round(((($sub1 + $sub2 + $sub3 + $sub4 + $sub5) * 100) / 500), 2);
        $updateResult = $student->updateResult($rollnumber, $resultPer);
        if ($updateResult) {
            $msg = "Result Updated Succesfully";
            $type = "success";
        } else {
            $msg = "There was an error adding class";
            $type = "error";
        }
    } else {
        $msg = "There was an error adding class";
        $type = "error";
    }
    header("Location: ../admin/result.php?msg=$msg&type=$type");
}
if (isset($_POST['statusChange'])) {
    echo "hello";
    $status = new Admin();
    $status_data = $status->getStatus();
    foreach ($status_data as $statusD) {
        if ($statusD['status'] == 0) {
            echo $query = $status -> setStatus(1);
        } else {
            echo $query = $status -> setStatus(0);
        }
    }
    header("Location: ../admin/index.php");
}
