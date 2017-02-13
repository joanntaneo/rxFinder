function onFindProduct(){
    var url = getBaseUrl() + '/TransactionController/findProduct' ;
    showMap(false);
     $.ajax({           
            type:'POST',
            url:url ,           
            dataType: 'json',
            data:{  country:document.getElementById("country").value,
                        region:document.getElementById("region").value,
                        province:document.getElementById("province").value,
                        city:document.getElementById("city").value,
                        generic:document.getElementById("generic").value,
                        brand:document.getElementById("brand").value,
                        unit:document.getElementById("unit").value,
                        volume:document.getElementById("volume").value
                    },
            success:function(response){
                console.log(response);
                jsonToProductTable(response);
               
            },
             error: function (request, status, error) {
                console.log(error);
            }
        }).done(function(res) {
            console.log(res);
        });
}

function displayMessage(msg, div){
     var message = "";
    message =  "<p align='center' class='error'>";
    message += msg;
    message += "</p>";
     var div = document.getElementById(div);
     div.innerHTML = message; 
}

function jsonToProductTable(response){
    if (response.length === 0){
        displayMessage("No product found in the selected location.", "searchTable");
    }else{
        var myTable =  "<table class='table table-hover'><thead>";
        myTable +=  "<tr>";
        myTable +=  "<th>Brand</th>";
        myTable +=  "<th>Volume-Unit</th>  ";             
        myTable +=  "<th>Available Stocks</th>  ";     
        myTable +=  "<th>Branch Name</th>" ;                                     
        myTable +=  "</tr></thead>";
    
        myTable += "<tbody>";
        $.each(response, function(index, value) {
          myTable += "<tr style='display:none' onclick=\"onDrawMap(\'";
          myTable += value.address + "\','" + value.branchname;
          myTable += "\')\"><td>";
          myTable += value.productBrand;
          myTable += "</td>";
          myTable +="<td>";
          myTable += value.productVolume + " " 
                          + value.productUnit;
          myTable += "</td><td>";
          myTable += value.piecesAvailable + " " 
                          + value.unitperpc;
          myTable += "</td><td>";
           myTable += value.branchname;
          myTable += "</td></tr>";
         });
         myTable += "</tbody>";    
        myTable += "</table>";
        var div = document.getElementById("searchTable");
        div.innerHTML = myTable; 
        page(3);
    }
}
