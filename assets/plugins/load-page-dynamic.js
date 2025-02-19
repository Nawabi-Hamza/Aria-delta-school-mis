

function loadPageDynamic(directory) {
    $.ajax({
        url: directory,
        method: 'GET',
        success: function(response) {
            $('.dynamic-content').html(response);
            // Extract title from the response (if you set it in the component)
            let newTitle = $(response).filter("title").text();
            if (!newTitle) { newTitle = "School | MIS"; }
            document.title = newTitle;
        },
        error: function() {
            console.log("This page does not exist");
            document.title = "Error | School";
            loadPageDynamic("pages/index.php")
        }
    });
}

$(document).on('click','#sidebarButton', function(e) {
    e.preventDefault(); 
    var targetPage = $(this).data('target');  
    $('#defaultContent').hide();
    window.location.assign('#'+targetPage.split("/")[1])
    // Load page as a component
    loadPageDynamic(targetPage)
    // Add class for active link
    document.querySelectorAll("#sidebarButton").forEach( el => el.classList.remove("active") )
    this.classList.add("active")
});

document.addEventListener("DOMContentLoaded",function(){
    const currentPage = window.location.hash.split("#")[1]
    loadPageDynamic(`pages/${currentPage}`)
})

