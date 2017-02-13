function previous(){
    new_page = parseInt($('#current_page').val()) - 1;
    //if there is an item before the current active link run the function
    if($('.active_page').prev('.page_link').length==true){
            go_to_page(new_page);
    }
}

function next(){
    new_page = parseInt($('#current_page').val()) + 1;
    //if there is an item after the current active link run the function
    if($('.active_page').next('.page_link').length==true){
            go_to_page(new_page);
    }
}

function go_to_page(page_num){
    //get the number of items shown per page
    var show_per_page = parseInt($('#show_per_page').val());
    //get the element number where to start the slice from
    var start_from = page_num * show_per_page;
    //get the element number where to end the slice
    var end_on = start_from + show_per_page;

               $("#searchTable tbody tr").css('display', 'none');

    //hide all row elements of searchTable div, get specific items and show them
                 $("#searchTable tbody tr").slice(start_from, end_on).css('display', 'table-row');

    /*get the page link that has longdesc attribute of the current page and add active_page class to it
    and remove that class from previously active page link*/
    $('.page_link[longdesc=' + page_num +']').addClass('active_page').siblings('.active_page').removeClass('active_page');

    //update the current page input field
    $('#current_page').val(page_num);
}

function page(perpage){
        var rows = document.getElementById("searchTable").getElementsByTagName("tbody");
        //how much items per page to show
        var show_per_page = 0;
        //getting the amount of elements inside content div
        var number_of_items = 0;
        var number_of_pages = 0;
        if (rows != null){
              show_per_page = perpage;
              number_of_items = document.getElementById("searchTable").getElementsByTagName("tbody")[0].getElementsByTagName("tr").length;
              //calculate the number of pages we are going to have
              number_of_pages = Math.ceil(number_of_items/show_per_page);
        }
        //set the value of our hidden input fields
        $('#current_page').val(0);
        $('#show_per_page').val(show_per_page);
        $('#page_navigation').html("");
        if (number_of_items > 0){
             if (number_of_pages > 1){
                  var navigation_html = '<a class="previous_link" href="javascript:previous();">Prev</a>';
                  var current_link = 0;
                  while(number_of_pages > current_link){
                          navigation_html += '<a class="page_link" href="javascript:go_to_page(' + 
                                                          current_link +')" longdesc="' + current_link +'">  '+ (current_link+1)
                                                          +'</a>';
                          current_link++;
                  }
                  navigation_html += '<a class="next_link" href="javascript:next();">  Next</a>';
                  $('#page_navigation').html(navigation_html);
                  //add active_page class to the first page link
                  $('#page_navigation .page_link:first').addClass('active_page'); 
              }
              $("#searchTable tbody tr").slice(0, show_per_page).css('display', 'table-row');
        }
}