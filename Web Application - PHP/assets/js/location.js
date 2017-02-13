/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function getBaseUrl() {
    var l = window.location;
    var base_url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1]  + "/" +  l.pathname.split('/')[2];
    return base_url;
}

function onRegionChange(region){
    var id = region.value;
    if (id == null){
        id = region;
    }
    var url = getBaseUrl() + '/LocationController/onRegionChange' ;
     $.ajax({           
            type:'GET',
            url:url ,            
            async: false, 
            dataType: 'text',
            data:{region: id},
            success:function(response){
                $('#province').html(response);
                onProvinceChange('');
            },
            error: function (request, status, error) {
                console.log(error);
            }
        }).done(function(res) {
           // console.log(res);
        });
}


function onProvinceChange(province){
    var provinceid = province.value;
    if (provinceid == null){
        provinceid = province;
    }
    var regionid = document.getElementById('region').value;
    var url = getBaseUrl() + '/LocationController/onProvinceChange' ;
    
     $.ajax({           
            type:'GET',
            url:url ,               
            async: false,
            dataType: 'text',
            data:{region: regionid, province:provinceid},
            success:function(response){
                $('#city').html(response);
            },
            error: function (request, status, error) {
                console.log(error);
            }
        }).done(function(res) {
           // console.log(res);
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