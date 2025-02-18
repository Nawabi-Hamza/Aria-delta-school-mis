function toggleSideBar(){
    const as = document.querySelector("aside")
    const ma = document.querySelector("main")
    as.style.display = as.style.display === "none" ? "flex" : "none"
    ma.style.width = ma.style.width === "100%" ? "80%" : "100%"
}