import "./bootstrap";

import Alpine from "alpinejs";
import "flowbite";

window.Alpine = Alpine;

Alpine.start();

// On page load or when changing themes, best to add inline in `head` to avoid FOUC
if (
    localStorage.getItem("color-theme") === "dark" ||
    (!("color-theme" in localStorage) &&
        window.matchMedia("(prefers-color-scheme: dark)").matches)
) {
    document.documentElement.classList.add("dark");
} else {
    document.documentElement.classList.remove("dark");
}

var themeToggleDarkIcon = document.getElementById("theme-toggle-dark-icon");
var themeToggleLightIcon = document.getElementById("theme-toggle-light-icon");

// Change the icons inside the button based on previous settings
if (
    localStorage.getItem("color-theme") === "dark" ||
    (!("color-theme" in localStorage) &&
        window.matchMedia("(prefers-color-scheme: dark)").matches)
) {
    themeToggleLightIcon.classList.remove("hidden");
} else {
    themeToggleDarkIcon.classList.remove("hidden");
}

var themeToggleBtn = document.getElementById("theme-toggle");

themeToggleBtn.addEventListener("click", function () {
    // toggle icons inside button
    themeToggleDarkIcon.classList.toggle("hidden");
    themeToggleLightIcon.classList.toggle("hidden");

    // if set via local storage previously
    if (localStorage.getItem("color-theme")) {
        if (localStorage.getItem("color-theme") === "light") {
            document.documentElement.classList.add("dark");
            localStorage.setItem("color-theme", "dark");
        } else {
            document.documentElement.classList.remove("dark");
            localStorage.setItem("color-theme", "light");
        }

        // if NOT set via local storage previously
    } else {
        if (document.documentElement.classList.contains("dark")) {
            document.documentElement.classList.remove("dark");
            localStorage.setItem("color-theme", "light");
        } else {
            document.documentElement.classList.add("dark");
            localStorage.setItem("color-theme", "dark");
        }
    }
});

Livewire.on("bottom-scroll", (time) => {
    if (time != 0) {
        $("#divu").animate({ scrollTop: $("#divu").prop("scrollHeight") }, 1);
    } else {
        $("#divu").animate({ scrollTop: $("#divu").prop("scrollHeight") }, 0);
    }
});

Livewire.on("show-chat", () => {
    console.log($(document).width());
    if ($(document).width() < 1024) {
        // page width sm(tailwind)
        console.log("mostrar div chat");
        $("#chat-list").addClass("hidden");
        $("#chat").removeClass("sm:hidden");
        $("#chat").addClass("flex");
        $("#chat").removeClass("hidden");
        $("#arrow-back").addClass("flex");
        return true;
    }
    return false;
});

$(document).on("click", "#arrow-back", function () {
    $("#chat-list").removeClass("hidden");
    $("#chat").addClass("sm:hidden");
    $("#chat").removeClass("flex");
    $("#chat").addClass("hidden");
});
