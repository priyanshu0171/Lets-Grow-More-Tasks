<?php

class Dbh
{
    /*
Database Handeler class Creates a connection and returns a variable conn.
*/
    // Private variables for storing data
    private $servername;
    private $username;
    private $password;
    private $database;

    // Creating connect method 
    protected function connect()
    {
        $this->servername = "localhost";
        $this->username = 'root';
        $this->password = '';
        $this->database = 'srms';

        // Creating connection to the data base usning OOPS
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->database);
        return $conn;
    }
}

class Admin extends Dbh
{
    public function updateAdmin($name, $id, $email, $password)
    {
        $sql = "UPDATE `admin` SET `name` = '$name', `email` = '$email', `password` = '$password' WHERE `id` = '$id'";
        $results = $this->connect()->query($sql);
        if ($results) {
            return $results;
        }
    }
    public function getAdmin()
    {
        $sql = "SELECT * FROM `admin`";
        $result = $this->connect()->query($sql);
        $number_of_rows = $result->num_rows;
        if ($number_of_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }
    }
    public function getStatus()
    {
        $sql = "SELECT * FROM `resultstatus`";
        $result = $this->connect()->query($sql);
        $number_of_rows = $result->num_rows;
        if ($number_of_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }
    }
    public function setStatus($status) {
        $sql = "UPDATE `resultstatus` SET `status` = '$status'";
        $results = $this->connect()->query($sql);
        if ($results) {
            return $results;
        }
    }
}
class Student extends Dbh
{
    public function updateResult($rollnumber, $result) {
        if ($result > 33) {
            $status = 1;
        } else {
            $status = -1;
        }
        $sql = "UPDATE `student` SET  `result` = '$status', `percentage` = '$result' WHERE `rollnumber` = '$rollnumber'";
        $query = $this->connect()->query($sql);
        if ($query) {
            return $query;
        }
    }
    public function removeStudent($id)
    {
        $sql = "DELETE FROM `student` WHERE `id` = '$id'";
        $results = $this->connect()->query($sql);
        if ($results) {
            return $results;
        }
    }
    public function removeStudentC($class)
    {
        $sql = "DELETE FROM `student` WHERE `class` = '$class'";
        $results = $this->connect()->query($sql);
        if ($results) {
            $sql1 = "DELETE FROM `marks` WHERE `class` = '$class'";
            $results1 = $this->connect()->query($sql1);
            return $results1;
        }
    }
    public function getStudent()
    {
        $sql = "SELECT * FROM `student`";
        $result = $this->connect()->query($sql);
        $number_of_rows = $result->num_rows;
        if ($number_of_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }
    }
    public function getStudentInfo($rollnumber)
    {
        $sql = "SELECT * FROM `student` WHERE `rollnumber` = '$rollnumber'";
        $result = $this->connect()->query($sql);
        $number_of_rows = $result->num_rows;
        if ($number_of_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }
    }
    public function addStudent($name, $fname, $class, $mobile, $rollnumber)
    {

        $sql = "INSERT INTO `student` (`id`, `rollnumber`, `name`, `fathername`, `attendance`, `result`, `class`, `mobile`) VALUES (NULL, '$rollnumber', '$name', '$fname', '0', '0', '$class', '$mobile');";
        $results = $this->connect()->query($sql);
        if ($results) {
            return $results;
        }
    }
    public function updateStudent($name, $fname, $class, $mobile, $id)
    {
        $sql = "UPDATE `student` SET `name`='$name',`fathername`='$fname',`class`='$class',`mobile`='$mobile' WHERE `id` = '$id'";
        $results = $this->connect()->query($sql);
        if ($results) {
            return $results;
        }
    }
    public function updateAtt($id, $attendance, $da)
    {
        $sql = "UPDATE `student` SET `attendance` = '$attendance', `daysattended` = '$da' WHERE `id` = '$id'";
        $results = $this->connect()->query($sql);
        if ($results) {
            return $results;
        }
    }
}
class ClassData extends Dbh
{
    public function getClasses()
    {
        $sql = "SELECT * FROM `classes` ORDER BY `class` asc";
        $result = $this->connect()->query($sql);
        $number_of_rows = $result->num_rows;
        if ($number_of_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }
    }
    public function addClass($class, $sub1, $sub2, $sub3, $sub4, $sub5)
    {
        $sql = "INSERT INTO `classes`(`id`, `class`, `subject1`, `subject2`, `subject3`, `subject4`, `subject5`) VALUES (NULL,'$class','$sub1','$sub2','$sub3','$sub4','$sub5')";
        $result = $this->connect()->query($sql);
        if ($result) {
            return $result;
        }
    }
    public function updateClass($class, $sub1, $sub2, $sub3, $sub4, $sub5, $id)
    {
        $sql = "UPDATE `classes` SET `class` = '$class', `subject1` = '$sub1',`subject2` = '$sub2',`subject3` = '$sub3',`subject4` = '$sub4',`subject5` = '$sub5' WHERE `id` = '$id'";
        $result = $this->connect()->query($sql);
        if ($result) {
            return $result;
        }
    }
    public function deleteClass($id)
    {
        $sql = "DELETE FROM `classes` WHERE `id` = $id";
        $result = $this->connect()->query($sql);
        if ($result) {
            return $result;
        }
    }
}

class Marks extends Dbh
{
    public function getMarks($rollnumber)
    {
        $sql = "SELECT * FROM `marks` WHERE `rollnumber` = '$rollnumber'";
        $result = $this->connect()->query($sql);
        $number_of_rows = $result->num_rows;
        if ($number_of_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }
    }
    public function addScores($rollnumber, $sub1, $sub2, $sub3, $sub4, $sub5, $class)
    {

        $sqlAdd = "SELECT `rollnumber` FROM `marks` WHERE `rollnumber` = '$rollnumber'";
        $result = $this->connect()->query($sqlAdd);
        $number_of_rows = $result->num_rows;
        if ($number_of_rows > 0) {
            $sql1 = "UPDATE `marks` SET `sub1` = '$sub1', `sub2` = '$sub2', `sub3` = '$sub3', `sub4` = '$sub4', `sub5` = '$sub5', `class` = '$class' WHERE `rollnumber` = '$rollnumber'";
            if ($result1 = $this->connect()->query($sql1)) { 
                return $result1;
            }
        } else {
            $sql2 = "INSERT INTO `marks`(`id`, `rollnumber`, `sub1`, `sub2`, `sub3`, `sub4`, `sub5`, `class`) VALUES (NULL,'$rollnumber','$sub1','$sub2','$sub3','$sub4','$sub5', '$class')";
            $result2 = $this->connect()->query($sql2);
            if ($result2) {
                return $result2;
            }
        }
    }
}
