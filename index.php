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
        <div class="row">
            <div class='col-sm-6'>
                <div class="form-group">
                    <label for="fName">First Name</label>
                    <input class="form-control" type="text" name="fName" placeholder="First Name">
                </div>
            </div>
            <div class='col-sm-6'>
                <div class="form-group">
                    <label for="lName">First Name</label>
                    <input class="form-control" type="text" name="lName" placeholder="Last Name">
                </div>
            </div>
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

        <div class="row">
            <div class='col-sm-6'>
                <div class="form-group">
                    <label for="username">Password</label>
                    <input class="form-control" type="password" name="password" id="password" placeholder="Password">
                    <small id="passwordError"></small>
                </div>
            </div>
            <div class='col-sm-6'>
                <div class="form-group">
                    <label for="username">Repeat Password</label>
                    <input class="form-control" type="password" name="passwordAgain" id="passwordAgain" placeholder="Password">
                    <small id="passwordAgainError"></small>
                </div>
            </div>
        </div>

    </fieldset>
    <input type="submit" class="btn btn-primary" value="Sign Up!">
    </form>
<script src="js/signup.js"></script>
</div>
    </body>

</html>
    