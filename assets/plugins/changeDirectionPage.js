// Function to update direction based on lang attribute
function updateDirection() {
    const lang = document.documentElement.getAttribute("lang"); // Get the current lang attribute
    
    if (["ar", "fa", "ps"].includes(lang)) {
        document.documentElement.setAttribute("dir", "rtl");
    } else {
        document.documentElement.setAttribute("dir", "ltr");
    }
}

// Create a MutationObserver to watch for changes in the lang attribute
const observer = new MutationObserver(() => {
    updateDirection(); // Call function when lang changes
});

// Start observing changes in the lang attribute of the <html> tag
observer.observe(document.documentElement, {
    attributes: true,
    attributeFilter: ["lang"] // Only watch for lang attribute changes
});

// Initial direction setup in case the page starts with a different language
updateDirection();
// notification popup
const notifyContainer = document.querySelector(".notify");
const notification = document.querySelector(".notification");
const notificationPopup = document.querySelector(".notifictaion-popup");
notification.addEventListener("mouseenter", function() {
    // alert("You have a new notification");
    notificationPopup.style.display = "block";
});
notifyContainer.addEventListener("mouseleave", function() {
    notificationPopup.style.display = "none" ;
});