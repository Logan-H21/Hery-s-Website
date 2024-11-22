document.getElementById("toggleTeamButton").addEventListener("click", function() {
    const gallery = document.querySelector(".gallery");
    gallery.classList.toggle("show");
    
    // Update button text based on state
    if (gallery.classList.contains("show")) {
        this.textContent = "Hide";
    } else {
        this.textContent = "Show";
    }
});