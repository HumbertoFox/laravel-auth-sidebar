document.querySelectorAll("[data-password-toggle]").forEach((button) => {
    button.addEventListener("click", () => {
        const input = button.closest(".relative").querySelector("input");
        const isPassword = input.type === "password";

        input.type = isPassword ? "text" : "password";

        button.querySelector("[data-icon-eye]").style.display = isPassword
            ? "none"
            : "block";
        button.querySelector("[data-icon-eye-off]").style.display = isPassword
            ? "block"
            : "none";
    });
});

document.addEventListener("DOMContentLoaded", () => {
    const welcomeRoot = document.querySelector("[data-page='welcome']");
    if (!welcomeRoot) return;

    const animatedEls = welcomeRoot.querySelectorAll("[data-animate]");

    if (!CSS.supports("selector(:is(*))") || !supportsStartingStyle()) {
        animatedEls.forEach((el) => {
            const from = el.dataset.animateFrom ?? "opacity-0";
            el.classList.add(...from.split(" "));
        });

        requestAnimationFrame(() => {
            requestAnimationFrame(() => {
                animatedEls.forEach((el) => {
                    const from = el.dataset.animateFrom ?? "opacity-0";
                    el.classList.remove(...from.split(" "));
                });
            });
        });
    }

    const mediaQuery = window.matchMedia("(prefers-reduced-motion: reduce)");
    const handleReducedMotion = (e) => {
        document.documentElement.classList.toggle("reduce-motion", e.matches);
    };
    mediaQuery.addEventListener("change", handleReducedMotion);
    handleReducedMotion(mediaQuery);
});

function supportsStartingStyle() {
    try {
        const sheet = new CSSStyleSheet();
        sheet.insertRule("@starting-style { .test { opacity: 0; } }");
        return true;
    } catch {
        return false;
    }
}

function initSidebarToggle() {
    const sidebar = document.getElementById("dashboard-sidebar");

    if (!sidebar) return;

    const applyState = (collapsed) => {
        sidebar.dataset.collapsed = collapsed ? "true" : "false";
        sidebar.classList.toggle("w-60", !collapsed);
        sidebar.classList.toggle("w-14", collapsed);

        document.dispatchEvent(
            new CustomEvent("sidebar:toggle", { detail: { collapsed } }),
        );
    };

    window.Sidebar = {
        collapse: () => applyState(true),
        expand: () => applyState(false),
        toggle: () => applyState(sidebar.dataset.collapsed !== "true"),
        isCollapsed: () => sidebar.dataset.collapsed === "true",
    };
}

document.addEventListener("DOMContentLoaded", () => {
    initSidebarToggle();
});

document.addEventListener("click", (e) => {
    const trigger = e.target.closest("[data-sidebar-action]");
    if (!trigger || !window.Sidebar) return;

    const action = trigger.dataset.sidebarAction;
    if (typeof window.Sidebar[action] === "function") {
        window.Sidebar[action]();
    }
});
