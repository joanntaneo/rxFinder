function onAddBranch(){
    var url = getBaseUrl() + '/BranchController/addBranch' ;
     $.ajax({           
            type:'POST',
            url:url ,           
            dataType: 'json',
            data:{  branchname: document.getElementById("branchname").value,
                        status:document.getElementById("status").checked,
                        contactno:document.getElementById("contactno").value,
                        url:document.getElementById("url").value,
                        country:document.getElementById("country").value,
                        region:document.getElementById("region").value,
                        province:document.getElementById("province").value,
                        city:document.getElementById("city").value
                    },
            success:function(response){
                alert("Branch successfully added.");
                jsonToBranchConfigTable(response);
            },
             error: function (request, status, error) {
                alert("Error encountered when adding branch.");
                console.log(error);
            }
        }).done(function(res) {
            console.log(res);
        });
}

function onFindBranch(update){
    var url = getBaseUrl() + '/TransactionController/findBranch' ;
     $.ajax({           
            type:'POST',
            url:url ,           
            dataType: 'json',
            data:{  country:document.getElementById("country").value,
                        region:document.getElementById("region").value,
                        province:document.getElementById("province").value,
                        city:document.getElementById("city").value
                    },
            success:function(response){
                console.log("success: "+ response);
                if(update){
                    jsonToBranchConfigTable(response);
                }else{
                    showMap(false);
                    jsonToBranchTable(response);
                }
            },
             error: function (request, status, error) {
                console.log(error);
            }
        }).done(function(res) {
            console.log(res);
        });
}


function jsonToBranchConfigTable(response){
    if (response.length == 0){
        displayMessage("No Branch Found.", "searchTable");
    }else{
        var myTable =  "<table class='table table-hover' name='branchConfig'><thead>";
        myTable +=  "<tr>";
        myTable +=  "<th>Branch Name</th>";
        myTable +=  "<th>Location</th>";
        myTable +=  "<th>Active?</th>  ";                                             
        myTable +=  "</tr></thead>";
        myTable += "<tbody>";
        $.each(response, function(index, value) {
           myTable += "<tr style='display: none' onclick='onGetBranch(";
           myTable += value.branchid;
           myTable += ")'><td>";
          myTable += value.name;
          myTable += "</td>";
          myTable +="<td>";
          if ( value.city != null){
            myTable += value.city + "," ; 
          }
          if ( value.province != null){   
             myTable += value.province;
        }
          myTable += "</td><td>";
          myTable += value.status;
          myTable += "</td></tr>";
         });
        myTable += "</tbody>";
        myTable += "</table>";
        var div = document.getElementById("searchTable");
        div.innerHTML = myTable; 
        page(5);
    }
}

function jsonToBranchTable(response){
    if (response.length == 0){
        displayMessage("No Branch Found.", "searchTable");
    }else{
        var address = "";
        var branchadd  = "";
        var myTable =  "<table class='table table-hover'><thead>";
        myTable +=  "<tr>";
        myTable +=  "<th>Branch Name</th>";
        myTable +=  "<th>Location</th>";
        myTable +=  "<th>Contact Number</th>  ";                             
        myTable +=  "</tr></thead>";
        myTable += "<tbody>";
        $.each(response, function(index, value) {
         address = "";
         if ( value.city != null){
            address += value.city ; 
         }
         if ( value.province != null){   
             address +=  ", " + value.province ;
         }
         branchadd =   value.name + ", " + address;
          myTable += "<tr style='display:none' onclick=\"onDrawMap(\'";
          myTable += branchadd + "\','" + value.name;
          myTable += "\')\"><td>";
          myTable += value.name;
          myTable += "</td>";
          myTable +="<td>" +  address;
          myTable += "</td><td>";
          if ( value.contactno != null){   
            myTable += value.contactno;
        }
          myTable += "</td></tr>";
         });
        myTable += "</tbody>";
        myTable += "</table>";
        var div = document.getElementById("searchTable");
        div.innerHTML = myTable; 
        page(5);
    }
}


function onGetBranch(id){
    console.log(id);
    var url = getBaseUrl() + '/BranchController/onGetBranch' ;
     $.ajax({           
            type:'POST',
            url:url ,           
            dataType: 'json',
            data:{  id: id },
            success:function(response){
                displaySelectedData(response);                
                onGeocode();
                console.log(response);
            },
             error: function (request, status, error) {
                console.log(error);
            }
        }).done(function(res) {
            console.log(res);
        });
}

function onGetBranch(id){
    console.log(id);
    var url = getBaseUrl() + '/BranchController/onGetBranch' ;
     $.ajax({           
            type:'POST',
            url:url ,           
            dataType: 'json',
            data:{  id: id },
            success:function(response){
                displaySelectedData(response);                
                onGeocode();
                console.log(response);
            },
             error: function (request, status, error) {
                console.log(error);
            }
        }).done(function(res) {
            console.log(res);
        });
}

function displaySelectedData(response){
     $.each(response, function(index, value) {
         onRegionChange(value.region);   
         onProvinceChange(value.province);
        $("#branchname").val(value.name);
        $("#url").val(value.wsurl);
        $("#branchno").val(value.branchid);
        $('#contactno').val(value.contactno);
        document.getElementById("status").checked = (value.status === "Y") ? true: false;        
        document.getElementById("country").value = value.country;        
        document.getElementById("region").value = value.region;
        document.getElementById("province").value = value.province;                
        document.getElementById("city").value = value.city;
     });
}

function onDeleteBranch(){
    var branchno = document.getElementById("branchno").value;
    if (branchno.length > 0){
        var url = getBaseUrl() + '/BranchController/deleteBranch' ;
        $.ajax({           
               type:'POST',
               url:url ,           
                dataType: 'json',
               data:{  id: branchno },
               success:function(response){  
                   $("#branchname").val("");
                    $("#url").val("");
                    $("#branchno").val("");
                     $('#contactno').val("");
                    document.getElementById("status").checked = false;
                    document.getElementById("country").value = 'PH';
                    document.getElementById("region").value = 0;
                    document.getElementById("province").value = 0;
                    document.getElementById("city").value = 0;
                   jsonToBranchConfigTable(response);
               },
                error: function (request, status, error) {
                   console.log(error);
               }
           }).done(function(res) {
               console.log(res);
           });
    }
}

function onUpdateBranch(){
     var branchno = document.getElementById("branchno").value;
    if (branchno.length > 0){
        var url = getBaseUrl() + '/BranchController/updateBranch' ;
        $.ajax({           
               type:'POST',
               url:url ,           
               dataType: 'json',
               data:{   id: branchno,
                            branchname: document.getElementById("branchname").value,
                            status:document.getElementById("status").checked,
                            contactno:document.getElementById("contactno").value,
                            url:document.getElementById("url").value,
                            country:document.getElementById("country").value,
                            region:document.getElementById("region").value,
                            province:document.getElementById("province").value,
                            city:document.getElementById("city").value
                },
                success:function(response){
                    alert("Branch successfully updated.");
                    jsonToBranchConfigTable(response);
                },
                error: function (request, status, error) {
                   alert("Error in updating branch.");
                   console.log(error);
               }
           }).done(function(res) {
               console.log(res);
           });
    }
}