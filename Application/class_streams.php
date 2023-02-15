
<?php
// config file
require_once "connection.php";
 
// Define variables
$stream = "";
$stream_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $input_stream = trim($_POST["stream"]);
    if(empty($input_stream)){
        $stream_err = "Please enter stream.";     
    } else{
        $stream = $input_stream;
    }
    
    
    // Check input errors before inserting in database
    if(empty($stream_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO class_streams (stream) VALUES (?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
           
            mysqli_stmt_bind_param($stmt, "s", $param_stream);
            
            // Set parameters
            $param_stream = $stream;
            
            if(mysqli_stmt_execute($stmt)){
                header("location: index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
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
    <title>ADD STREAM</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Create Stream</h2>
                    <p>Please fill this form and submit to create stream.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        </div>
                        <div class="form-group">
                            <label>Stream</label>
                            <textarea name="stream" class="form-control <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>"><?php echo $stream; ?></textarea>
                            <span class="invalid-feedback"><?php echo $stream;?></span>
                        </div><br><br>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>