 function onGeocode(){
    var province = $("#province option:selected" ).text();
    var city =$("#city option:selected" ).text() ;
    if (document.getElementById("province").value == 0){
        alert("Please select nearest province.");
    }else{
        $("#map-canvas").show();
        locateBranchMap();
    }    
}

function showMap(isShow){
    if (isShow){
        $("#map-canvas").show();
    }else{
        $("#map-canvas").hide();
    }
}

function locateBranchMap() {  
    var branchname =$("#branchname" ).val();     
    var city =$("#city option:selected" ).text() ;
    var province = $("#province option:selected" ).text();
    var country = "Philippines";
    if (document.getElementById("city").value != 0){
        city = city + ", ";
    }
     if (document.getElementById("province").value != 0){
        province = province + ", ";
    }
     var address =  "";
    if (branchname){
        address = branchname + ", " + city + province + country;
    }
    onDrawMap(address, branchname);
}  

function onDrawMap(address, branchname){
    showMap(true);
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({'address':address}, function (results, status){
        if (status == google.maps.GeocoderStatus.OK){
             var mapOptions = {  
            zoom: 15,   
            };  
            var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions); 
            map.setCenter(results[0].geometry.location);
            map.setMapTypeId(google.maps.MapTypeId.ROADMAP  );
            if (branchname){
                var marker = new google.maps.Marker({
                    position: results[0].geometry.location,
                    map: map,
                    title: branchname
                  });
              }
            console.log(results);
            console.log(results[0].geometry.location.lat);
            console.log(results[0].geometry.location.lng);
        }else{
            showMap(false);
            alert ("Location not found");
        }
    });
}


