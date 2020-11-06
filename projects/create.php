<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$name = $enrollment_No = $percentage = "";
$name_err = $enrollment_No_err = $percentage_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }
    
    // Validate address
    $input_enrollment_No = trim($_POST["enrollment_No"]);
    if(empty($input_enrollment_No)){
        $enrollment_No_err = "Please enter an enrollment_No.";     
    } else{
        $enrollment_No = $input_enrollment_No;
    }
    
    // Validate salary
    $input_percentage = trim($_POST["percentage"]);
    if(empty($input_percentage)){
        $percentage_err = "Please enter the percentage.";     
    } elseif(!ctype_digit($input_percentage)){
        $percentage_err = "Please enter a positive integer value.";
    } else{
        $percentage = $input_percentage;
    }
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($enrollment_No_err) && empty($percentage_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO students (name, enrollment_No, percentage) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_enrollment_No, $param_percentage);
            
            // Set parameters
            $param_name = $name;
            $param_enrollment_No = $enrollment_No;
            $param_percentage = $percentage;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Create Record</h2>
                    </div>
                    <p>Please fill this form and submit to add student record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                            <label>enrollment_No</label>
                            <textarea name="address" class="form-control"><?php echo $enrollment_No; ?></textarea>
                            <span class="help-block"><?php echo $enrollment_No_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($percentage_err)) ? 'has-error' : ''; ?>">
                            <label>Salary</label>
                            <input type="text" name="percentage" class="form-control" value="<?php echo $percentage; ?>">
                            <span class="help-block"><?php echo $percentage_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>