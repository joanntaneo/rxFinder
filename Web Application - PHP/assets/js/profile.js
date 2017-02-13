function onActionChange(){
    var selection = document.getElementById("actionprof").value;
    if (selection === "uprof"){
        $("#profilepicture").hide();
        $("#changePassword").hide();
        $("#profbutton").css('display', 'block');
    }else{
        $("#profbutton").css('display', 'none');
        if (selection === "cprof" ){
            $("#profilepicture").show();
            $("#changePassword").hide();
        }else if(selection ===  "cpwd"){
            $("#changePassword").css('display', 'block');
            $("#profilepicture").hide();
        }
    }
}

function onUpdateProfile(){
      var selection = document.getElementById("actionprof").value;
      if (selection === "uprof"){
          updateProfileData();
      }else if (selection === "cprof" ){
          onUploadImage();
      }
}

function updateProfileData(){
     var url = getBaseUrl() + '/AccountController/onUpdateProfile' ;
     $.ajax({           
            type:'POST',
            url:url ,           
            dataType: 'json',
            data:{  username: document.getElementById("username").value,
                        firstname:document.getElementById("firstname").value,
                        lastname:document.getElementById("lastname").value,
                        country:document.getElementById("country").value,
                        region:document.getElementById("region").value,
                        province:document.getElementById("province").value,
                        city:document.getElementById("city").value
                    },
            success:function(response){
                 var message = "";
                 message =  "<p align='center' class='error'>";
                 message += "Profile successfully updated.";
                 message += "</p>";
                 var div = document.getElementById("message");
                 div.innerHTML = message; 
            },
             error: function (request, status, error) {
                 var message = "";
                 message =  "<p align='center' class='error'>";
                 message += "Profile not updated.";
                 message += "</p>";
                 var div = document.getElementById("message");
                 div.innerHTML = message; 
                 console.log(error);
            }
        }).done(function(res) {
            console.log(res);
        });
}
