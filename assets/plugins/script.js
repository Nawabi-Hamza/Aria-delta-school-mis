// Loading page before load all pages
window.addEventListener("load", function () {
    // Hide the loading screen
    console.log(document.getElementById("loadingScreen").classList);
    document.getElementById("loadingScreen").classList.add("d-none");
});