document.addEventListener("DOMContentLoaded", function () {
    const themeToggle = document.getElementById("themeToggle");
    const body = document.body;

    // Check if the user has a theme preference stored in local storage
    const storedTheme = localStorage.getItem("theme");

    // Set the initial theme based on the stored preference or system preference
    if (storedTheme) {
        body.classList.toggle("dark-mode", storedTheme === "dark");
    } else if (window.matchMedia && window.matchMedia("(prefers-color-scheme: dark)").matches) {
        body.classList.add("dark-mode");
    }

    themeToggle.addEventListener("click", function () {
        if (body.classList.contains("dark-mode")) {
            body.classList.remove("dark-mode");
            localStorage.setItem("theme", "light");
        } else {
            body.classList.add("dark-mode");
            localStorage.setItem("theme", "dark");
        }
    });
});