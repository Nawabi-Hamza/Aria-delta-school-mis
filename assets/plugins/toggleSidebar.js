// toggle sidebar hide and show
function toggleSideBar(){
    const as = document.querySelector("aside")
    const ma = document.querySelector("main")
    as.style.display = as.style.display === "none" ? "flex" : "none"
    ma.style.width = ma.style.width === "100%" ? "80%" : "100%"
}

// toggle Active Class For Each sidebar link
document.addEventListener("DOMContentLoaded",function(){
    const currentPage = window.location.hash.split("#")[1]
    document.querySelectorAll("#sidebarButton").forEach( el => {
        if(el.getAttribute("data-target").split("/")[1] === currentPage){
            el.classList.add("active")
        }
    })
})

