(function () {
    // Chaves de configuração
    const STORAGE_KEY = "sidebar_collapsed";

    /**
     * ==========================================
     * 1. DETECÇÃO DE RECURSOS (Feature Detection)
     * ==========================================
     */
    function supportsStartingStyle() {
        try {
            const sheet = new CSSStyleSheet();
            sheet.insertRule("@starting-style { .test { opacity: 0; } }");
            return true;
        } catch {
            return false;
        }
    }

    /**
     * ==========================================
     * 2. LÓGICA DA SIDEBAR
     * ==========================================
     */
    function getSidebar() {
        return document.getElementById("sidebar");
    }

    function updateSidebarState(isResize = false) {
        const sidebar = getSidebar();
        if (!sidebar) return;

        const savedPreference = localStorage.getItem(STORAGE_KEY);
        const isSmallScreen = window.innerWidth < 1024;
        let newState = "false";

        if (isResize) {
            if (isSmallScreen) {
                newState = "true";
            } else {
                newState = savedPreference !== null ? savedPreference : "false";
            }
        } else {
            if (savedPreference !== null) {
                newState = savedPreference;
            } else {
                newState = isSmallScreen ? "true" : "false";
            }
        }

        // Atualiza ambos em sincronia
        sidebar.dataset.collapsed = newState;
        document.documentElement.setAttribute(
            "data-sidebar-collapsed",
            newState,
        );
    }

    function initSidebar() {
        const toggleBtn = document.getElementById("sidebar-toggle");

        updateSidebarState();
        window.addEventListener("resize", () => updateSidebarState(true));

        if (!toggleBtn) return;

        toggleBtn.addEventListener("click", () => {
            const sidebar = getSidebar();
            if (!sidebar) return;

            const isCollapsed = sidebar.dataset.collapsed === "true";
            const newState = isCollapsed ? "false" : "true";

            // 1. Aplica o novo estado na Sidebar (para o app.js controlar)
            sidebar.dataset.collapsed = newState;

            // 2. ATUALIZA O HTML TAMBÉM! (Isso resolve o seu problema)
            document.documentElement.setAttribute(
                "data-sidebar-collapsed",
                newState,
            );

            // 3. Grava no localStorage
            localStorage.setItem(STORAGE_KEY, newState);
        });
    }

    /**
     * ==========================================
     * 3. ALTERNAR VISIBILIDADE DE SENHA
     * ==========================================
     */
    function initPasswordToggles() {
        document
            .querySelectorAll("[data-password-toggle]")
            .forEach((button) => {
                button.addEventListener("click", () => {
                    const container = button.closest(".relative");
                    if (!container) return;

                    const input = container.querySelector("input");
                    if (!input) return;

                    const isPassword = input.type === "password";
                    input.type = isPassword ? "text" : "password";

                    const eyeIcon = button.querySelector("[data-icon-eye]");
                    const eyeOffIcon = button.querySelector(
                        "[data-icon-eye-off]",
                    );

                    if (eyeIcon)
                        eyeIcon.style.display = isPassword ? "none" : "block";
                    if (eyeOffIcon)
                        eyeOffIcon.style.display = isPassword
                            ? "block"
                            : "none";
                });
            });
    }

    /**
     * ==========================================
     * 4. ANIMAÇÕES DA PÁGINA WELCOME & ACESSIBILIDADE
     * ==========================================
     */
    function initWelcomeAnimations() {
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

        // Suporte à Acessibilidade de Movimentos Reduzidos
        const mediaQuery = window.matchMedia(
            "(prefers-reduced-motion: reduce)",
        );
        const handleReducedMotion = (e) => {
            document.documentElement.classList.toggle(
                "reduce-motion",
                e.matches,
            );
        };

        mediaQuery.addEventListener("change", handleReducedMotion);
        handleReducedMotion(mediaQuery);
    }

    /**
     * ==========================================
     * DISPARO INICIAL (Quando o DOM estiver pronto)
     * ==========================================
     */
    document.addEventListener("DOMContentLoaded", () => {
        initSidebar();
        initPasswordToggles();
        initWelcomeAnimations();
    });
})();
