
// Function to detect if the user is on a mobile device
function isMobileDevice() {
    return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
}

// Function to display the warning message
function showMobileWarning() {
    const mobileWarning = document.getElementById("mobile-warning");
    if (isMobileDevice()) {
        mobileWarning.style.display = "block";
    }
}

// Call the showMobileWarning function when the page loads
window.addEventListener("load", showMobileWarning);

