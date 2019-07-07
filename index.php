<!DOCTYPE html>
<html>
    <head>
        <title>Sign Up Page</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link  href="css/styles.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    </head>
    <body id="bootstrap-overrides">
    <div class="container">
    <h1> Sign Up </h1>
    <form id="signupForm" method="post" action="welcome.html">
    <fieldset>
        <legend>Your Information</legend>
    <div class="form-group">
        <label for="fName">First Name</label>
        <input class="form-control" type="text" name="fName" placeholder="First Name">
    </div>

    <div class="form-group">
        <label for="lName">First Name</label>
        <input class="form-control" type="text" name="lName" placeholder="Last Name">
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="gender" value="m">
            Male
        </label>
        <label>
            <input type="radio" name="gender" value="f">
            Female
        </label>
    </div>
    <div class="form-group">
        <label for="zip">Zip Code</label>
        <input id="zip" class="form-control input-sm" type="text" name="zip" placeholder="Zip Code">
        <small id="zipError"></small>
    </div>
    </fieldset>

    City: <span id="city"></span><br/>
    Latitude: <span id="latitude"></span><br/>
    Longitude: <span id="longitude"></span><br/>
    
    <fieldset>
        <legend> Detailed Location </legend>
        <div class="form-group">
            <label for="state">Select Your State</label>
            <select class="form-control" id="state" placeholder="Loading States...">
            
            </select>
        </div>
        <div class="form-group">
            <label for="county">Select Your County</label>
            <select class="form-control" id="county" placeholder="">

            </select>
        </div>
    </fieldset>

    <fieldset>
        <legend> Login Information </legend>
        <div class="form-group">
            <label for="username">Desired Username</label>
            <input class="form-control" type="text" name="username" id="username" placeholder="Username">
            <small id="usernameError"></small>
        </div>

        <div class="form-group">
            <label for="username">Password</label>
            <input class="form-control" type="password" name="password" id="password" placeholder="Password">
            <small id="passwordError"></small>
        </div>
        <div class="form-group">
            <label for="username">Repeat Password</label>
            <input class="form-control" type="password" name="passwordAgain" id="passwordAgain" placeholder="Password">
            <small id="passwordAgainError"></small>
        </div>

    </fieldset>
    <input type="submit" class="btn btn-primary" value="Sign Up!">
    </form>
<script>
    $(document).ready(() => {
    var usernameAvailable = false;
    
    $.ajax({
            method: "GET",
            url: "http://cst336.herokuapp.com/projects/api/state_abbrAPI.php",
            dataType: "json",
            data: {  } ,
            success: function(result,status) {
                $("#state").html("<option> Select One </option>");
                for(let i=0;i<result.length;i++) {
                    $("#state").append("<option value='" + result[i].usps + "'>" + result[i].state + "</option>");
                }
            } 
        });//ajax

    //Displaying City from API after typing a zip code
    $("#zip").on("change",function() {
        //alert(  $("#zip").val()  );
        
        $.ajax({
            method: "GET",
            url: "http://cst336.herokuapp.com/projects/api/cityInfoAPI.php",
            dataType: "json",
            data: {  "zip" : $("#zip").val() } ,
            success: function(result,status) {
                //alert(result);
                if(result==false) {
                    $("#zipError").html("Invalid Zip Code");
                    $("#zipError").attr("class","alert alert-danger")
                }
                else {
                    $("#zipError").html("");
                    $("#city").html(result.city);
                    $("#zipError").attr("class","bg-primary text-white")
                }
            },
            error: function(result,status) {
                $("#zipError").html("Invalid Zip Code");
            }
            
        });//ajax

        $.ajax({
            method: "GET",
            url: "http://cst336.herokuapp.com/projects/api/cityInfoAPI.php",
            dataType: "json",
            data: {  "zip" : $("#zip").val() } ,
            success: function(result,status) {
                //alert(result);
                $("#latitude").html(result.latitude);
            } 
        });//ajax

        $.ajax({
            method: "GET",
            url: "http://cst336.herokuapp.com/projects/api/cityInfoAPI.php",
            dataType: "json",
            data: {  "zip" : $("#zip").val() } ,
            success: function(result,status) {
                //alert(result);
                $("#longitude").html(result.longitude);
            } 
        });//ajax
        
    });//zip

    $("#state").on("change",function() {
        $.ajax({
            method: "GET",
            url: "http://cst336.herokuapp.com/projects/api/countyListAPI.php",
            dataType: "json",
            data: {  "state" : $("#state").val() } ,
            success: function(result,status) {
                $("#county").html("<option> Select One </option>");
                for(let i=0;i<result.length;i++) {
                    $("#county").append("<option>" + result[i].county + "</option>");
                }
            } 
        });//ajax
    });
    $("#username").change(function() {
        $.ajax({
            method: "GET",
            url: "http://cst336.herokuapp.com/projects/api/usernamesAPI.php",
            dataType: "json",
            data: {  "username" : $("#username").val() } ,
            success: function(result,status) {
                if(result.available) {
                    $("#usernameError").html("Username is available!");
                    $("#usernameError").attr("class","alert alert-success");

                    usernameAvailable = true;
                }
                else{
                    $("#usernameError").html("Username is unavailable!");
                    $("#usernameError").attr("class","alert alert-danger");
                    usernameAvailable = false;
                }
            } 
        });//ajax
    });
    $("#signupForm").on("submit",function(event) {
        //alert("submitting form");
        if(!isFormValid()) {
            event.preventDefault();
        }
        
    });

    function isFormValid() {
        isValid = true;
        if(!usernameAvailable) {
            isValid = false;
        }

        if($("#username").val().length==0) {
            isValid = false;
            $("#usernameError").html("Username is required.");
            $("#usernameError").attr("class","alert alert-danger");
        }

        if($("#password").val() != $("#passwordAgain").val()) {
            $("#passwordAgainError").html("Password Mismatch!");
            $("#passwordAgainError").attr("class","alert alert-danger");
            isValid = false;
        }
        else {
            $("#passwordAgainError").html("");
            $("#passwordAgainError").attr("class","");
        }

        if($("#password").val().length<6) {
            isValid = false;
            $("#passwordError").html("A password with at least 6 characters is required.");
            $("#passwordError").attr("class","alert alert-danger");
        }
        else {
            $("#passwordError").html("");
            $("#passwordError").attr("class","");
        }

        return isValid;
    }
    });
</script>
</div>
    </body>

</html>
    