document.addEventListener("DOMContentLoaded", function () {
    const darkModeIcon = document.getElementById("darkModeIcon");
    const lightModeIcon = document.getElementById("lightModeIcon");
    const themeToggle = document.getElementById("themeToggle");

    themeToggle.addEventListener("click", function () {
        if (darkModeIcon.style.display === "none") {
            darkModeIcon.style.display = "inline-block";
            lightModeIcon.style.display = "none";
        } else {
            darkModeIcon.style.display = "none";
            lightModeIcon.style.display = "inline-block";
        }
    });
});