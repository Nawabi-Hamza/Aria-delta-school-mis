

function loadPageDynamic(directory) {
    $.ajax({
        url: directory,
        method: 'GET',
        success: function(response) {
            $('.dynamic-content').html(response);
        },
        error: function() {
            console.log("This page does not exist");
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
    // console.log(this)
});

document.addEventListener("DOMContentLoaded",function(){
    const currentPage = window.location.hash.split("#")[1]
    loadPageDynamic(`pages/${currentPage}`)
})