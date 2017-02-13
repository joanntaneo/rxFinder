function onUserActionChange(){
    var selection = document.getElementById("action").value;
    var div = document.getElementById("searchTable");
    if (selection === "search"){
         $("#username").prop('disabled', false);
         $("#pass").prop('disabled', true);
         $("#email").prop('disabled', true);
         $("#fname").prop('disabled', true);
         $("#lname").prop('disabled', true);
         clearFields();     
         div.innerHTML = ""; 
    }else if (selection === "update"){
        $("#username").prop('disabled', true);
        $("#pass").prop('disabled', true);
         $("#email").prop('disabled', true);
         $("#fname").prop('disabled', false);
         $("#lname").prop('disabled', false);
    }else{
        $("#username").prop('disabled', false);
        $("#pass").prop('disabled', false);
        $("#email").prop('disabled', false);
        $("#fname").prop('disabled', false);
        $("#lname").prop('disabled', false);
        clearFields();
        div.innerHTML = ""; 
    }
}

function onApplyClick(){
    var selection = document.getElementById("action").value;
    if (selection === "search"){
        msg = onFindUser();
    }else if (selection === "update"){
        msg = onUpdateUser();        
    }else{
        msg = onAddUser();
    }    
}

function onUpdateUser(){
    var msg = "";
    var access = "C";
    if ( document.getElementById("SA").checked){
        access = "A";
    }
    var url = getBaseUrl() + '/AccountController/onAdminUserUpdate' ;
    $.ajax({           
           type:'POST',
           url:url ,            
           dataType: 'json',
           data:{  username: document.getElementById("username").value,
                      firstname: document.getElementById("fname").value,
                      lastname: document.getElementById("lname").value,
                      accessright:access},
           success:function(response){
               msg = response.message;
               console.log(response);
               var message =  "<p align='center' class='error'>";
                message += msg;
                message += "</p>";
                var div = document.getElementById("message");
                div.innerHTML = message; 
           },
           error: function (request, status, error) {
               console.log(error);
           }
       }).done(function(res) {
          // console.log(res);
       });
    return msg;
}

function onAddUser(){
    var msg = "";
    var access = "C";
    if ( document.getElementById("SA").checked){
        access = "A";
    }
    var url = getBaseUrl() + '/AccountController/onRegistration' ;
    $.ajax({           
           type:'POST',
           url:url ,            
           dataType: 'json',
           data:{ addedby: "A",
                      currpage: "AdminUserUI",
                      nextpage:"AdminUserUI",
                      username: document.getElementById("username").value,
                      password: document.getElementById("pass").value,
                      emailAdd: document.getElementById("email").value,
                      firstname: document.getElementById("fname").value,
                      lastname: document.getElementById("lname").value,
                      accessright:access},
           success:function(response){
               msg = response.message;
               console.log(response);
               var message =  "<p align='center' class='error'>";
                message += msg;
                message += "</p>";
                var div = document.getElementById("message");
                div.innerHTML = message; 
           },
           error: function (request, status, error) {
               console.log(error);
           }
       }).done(function(res) {
          // console.log(res);
       });
    
}

function onFindUser(){
     var username = document.getElementById("username").value;
     var msg = "";
    if (!username){
       msg = "Please enter username to search.";
    }else{    
        var url = getBaseUrl() + '/AccountController/onSearchCustomers' ;
        $.ajax({           
               type:'GET',
               url:url ,            
               dataType: 'json',
               data:{username: document.getElementById("username").value},
               success:function(response){
                   onSearchCustomerResult(response);
               },
               error: function (request, status, error) {
                   console.log(error);
               }
           }).done(function(res) {
              // console.log(res);
           });
       }
        var message =  "<p align='center' class='error'>";
        message += msg;
        message += "</p>";
        var div = document.getElementById("message");
        div.innerHTML = message; 
}

function onGetUser(user){
    var url = getBaseUrl() + '/AccountController/onFindCustomer' ;
    $.ajax({           
           type:'GET',
           url:url ,            
           dataType: 'json',
           data:{username: user},
           success:function(response){
               console.log(response);
               populateCustomerFields(response);
           },
           error: function (request, status, error) {
               console.log(error);
           }
       }).done(function(res) {
          // console.log(res);
       });
       var msg = "";
        var message =  "<p align='center' class='error'>";
        message += msg;
        message += "</p>";
        var div = document.getElementById("message");
        div.innerHTML = message; 
}

function clearFields(){
        $("#username").val("");
        $("#email").val("");
        $('#fname').val("");
        $('#lname').val("");
        $('#pass').val("");
        document.getElementById("SA").checked = false;      
}

function populateCustomerFields(response){
        $("#username").val(response.username);
        $("#pass").val(response.password);
        $("#email").val(response.emailadd);
        $('#fname').val(response.firstname);
        $('#lname').val(response.lastname);
        document.getElementById("SA").checked = (response.accessright === "A") ? true: false;      
        document.getElementById("action").value = "update";
        onUserActionChange();
}

function onSearchCustomerResult(response){
    if (response.length == 0){
        displayMessage("No User Found.", "searchTable");
    }else{
        var myTable =  "<table class='table table-hover' name='userConfig'><thead>";
        myTable +=  "<tr>";
        myTable +=  "<th>Username</th>";
        myTable +=  "<th>Date Created</th>  ";  
        myTable +=  "<th>Last Login Date</th>";                                                   
        myTable +=  "</tr></thead>";
        myTable += "<tbody>";
        $.each(response, function(index, value) {
           myTable += "<tr style='display: none' onclick='onGetUser(\"";
           myTable += value.username;
           myTable += "\")'><td>";
          myTable += value.username;
          myTable += "</td>";
          myTable +="<td>";
            myTable += value.createdon;
          myTable += "</td><td>";
          myTable += value.lastlogin;
          myTable += "</td></tr>";
         });
        myTable += "</tbody>";
        myTable += "</table>";
        var div = document.getElementById("searchTable");
        div.innerHTML = myTable; 
        page(5);
    }
}