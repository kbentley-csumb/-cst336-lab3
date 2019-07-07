$(document).ready(() => {
    var usernameAvailable = false;
    
    $.ajax({
            method: "GET",
            url: "https://cst336.herokuapp.com/projects/api/state_abbrAPI.php",
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
            url: "https://cst336.herokuapp.com/projects/api/cityInfoAPI.php",
            dataType: "json",
            data: {  "zip" : $("#zip").val() } ,
            success: function(result,status) {
                //alert(result);
                if(result==false) {
                    $("#zipError").html("Zip code not found");
                    $("#zipError").attr("class","alert alert-danger")
                }
                else {
                    $("#zipError").html("");
                    $("#city").html(result.city);
                    $("#state").val(result.state);
                    
                    $("#zipError").attr("class","bg-primary text-white")
                }
            }            
        });//ajax

        $.ajax({
            method: "GET",
            url: "https://cst336.herokuapp.com/projects/api/cityInfoAPI.php",
            dataType: "json",
            data: {  "zip" : $("#zip").val() } ,
            success: function(result,status) {
                //alert(result);
                $("#latitude").html(result.latitude);
            } 
        });//ajax

        $.ajax({
            method: "GET",
            url: "https://cst336.herokuapp.com/projects/api/cityInfoAPI.php",
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
            url: "https://cst336.herokuapp.com/projects/api/countyListAPI.php",
            dataType: "json",
            data: {  "state" : $("#state").val() } ,
            success: function(result,status) {
                $("#county").html("<option selected='selected'>Select One</option>");
                for(let i=0;i<result.length;i++) {
                    $("#county").append("<option>" + result[i].county + "</option>");
                }

            } 
        });//ajax
    });
    $("#username").change(function() {
        $.ajax({
            method: "GET",
            url: "https://cst336.herokuapp.com/projects/api/usernamesAPI.php",
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
            $("#passwordAgainError").html("Retype Password");
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