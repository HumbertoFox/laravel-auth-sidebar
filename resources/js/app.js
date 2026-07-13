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
        const isMobile = window.innerWidth < 768;

        let newState = "false";

        if (isResize) {
            if (isSmallScreen) {
                newState = "true";
            } else {
                newState = savedPreference !== null ? savedPreference : "false";
            }
        } else {
            if (savedPreference !== null) {
                newState = isMobile ? "true" : savedPreference;
            } else {
                newState = isSmallScreen ? "true" : "false";
            }
        }

        sidebar.dataset.collapsed = newState;
        document.documentElement.setAttribute(
            "data-sidebar-collapsed",
            newState,
        );

        const backdrop = document.getElementById("sidebar-backdrop");
        if (backdrop) {
            const isMobile = window.innerWidth < 768;
            if (!isMobile || newState === "true") {
                backdrop.classList.add("hidden");
            } else if (isMobile && newState === "false") {
                backdrop.classList.remove("hidden");
            }
        }
    }

    function initSidebar() {
        const toggleBtn = document.getElementById("sidebar-toggle");
        const backdrop = document.getElementById("sidebar-backdrop");

        updateSidebarState();

        window.addEventListener("resize", () => updateSidebarState(true));

        function closeSidebarOnMobile() {
            const sidebar = getSidebar();
            const isMobile = window.innerWidth < 768;

            if (sidebar && isMobile) {
                sidebar.dataset.collapsed = "true";
                document.documentElement.setAttribute(
                    "data-sidebar-collapsed",
                    "true",
                );
                if (backdrop) backdrop.classList.add("hidden");
            }
        }

        if (toggleBtn) {
            toggleBtn.addEventListener("click", () => {
                const sidebar = getSidebar();
                if (!sidebar) return;

                const isCollapsed = sidebar.dataset.collapsed === "true";
                const newState = isCollapsed ? "false" : "true";
                const isMobile = window.innerWidth < 768;

                sidebar.dataset.collapsed = newState;
                document.documentElement.setAttribute(
                    "data-sidebar-collapsed",
                    newState,
                );
                localStorage.setItem(STORAGE_KEY, newState);

                if (backdrop && isMobile) {
                    if (newState === "false") {
                        backdrop.classList.remove("hidden");
                    } else {
                        backdrop.classList.add("hidden");
                    }
                }
            });
        }

        if (backdrop) {
            backdrop.addEventListener("click", closeSidebarOnMobile);
        }

        const sidebarContainer = getSidebar();
        if (sidebarContainer) {
            const interactiveElements = sidebarContainer.querySelectorAll(
                ".sidebar-item, button, a",
            );

            interactiveElements.forEach((element) => {
                if (
                    element.id === "sidebar-toggle" ||
                    element.tagName === "FORM"
                )
                    return;

                element.addEventListener("click", () => {
                    if (element.tagName === "SUMMARY") return;
                    closeSidebarOnMobile();
                });
            });
        }
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
     * 4. UPLOAD DE AVATAR COM PREVIEW
     * ==========================================
     *
     * @param {Object} options
     * @param {string} options.inputId       - id do <input type="file">
     * @param {string} options.previewId     - id do <img> de preview
     * @param {string} options.placeholderId - id do placeholder "No image"
     * @param {string} options.errorId       - id do <p> de erro client-side
     * @param {string} options.labelId       - id do <label> do input
     * @param {string} options.submitId      - id do <button type="submit">
     * @param {number} options.maxMb         - tamanho máximo em MB (padrão: 0.5)
     */
    function initAvatarUpload({
        inputId = "avatar",
        previewId = "avatar-preview",
        placeholderId = "avatar-placeholder",
        errorId = "avatar-error",
        labelId = "avatar-label",
        submitId = "submit-btn",
        maxMb = 0.5,
    } = {}) {
        const input = document.getElementById(inputId);
        const preview = document.getElementById(previewId);
        const placeholder = document.getElementById(placeholderId);
        const errorEl = document.getElementById(errorId);
        const label = document.getElementById(labelId);
        const submitBtn = document.getElementById(submitId);

        if (!input) return;

        const MAX_SIZE = maxMb * 1024 * 1024;
        const ALLOWED = ["image/jpeg", "image/png", "image/webp"];

        function reset() {
            errorEl.textContent = "";
            errorEl.classList.add("hidden");
            submitBtn.disabled = false;
            label.title = "Select profile picture";
        }

        function clearPreview() {
            preview.src = "";
            preview.classList.add("hidden");
            placeholder.classList.remove("hidden");
        }

        function showError(msg) {
            errorEl.textContent = msg;
            errorEl.classList.remove("hidden");
            submitBtn.disabled = true;
            label.title = "Click on Select image and then Cancel to clear.";
            clearPreview();
            input.value = "";
        }

        input.addEventListener("change", () => {
            const file = input.files?.[0];

            reset();

            if (!file) {
                clearPreview();
                return;
            }

            if (!ALLOWED.includes(file.type)) {
                showError("Only JPEG, PNG and WebP images are allowed.");
                return;
            }

            if (file.size > MAX_SIZE) {
                showError(`Image must be smaller than ${maxMb}MB.`);
                return;
            }

            const reader = new FileReader();
            reader.onload = (e) => {
                preview.src = e.target.result;
                preview.classList.remove("hidden");
                placeholder.classList.add("hidden");
            };
            reader.readAsDataURL(file);
        });
    }

    /**
     * ==========================================
     * 5. ANIMAÇÕES DA PÁGINA WELCOME & ACESSIBILIDADE
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
     * 6. FECHAR <details> AO CLICAR FORA OU PRESSIONAR ESC
     * ==========================================
     */
    function initOutsideClickClose() {
        document.addEventListener("click", (event) => {
            document.querySelectorAll("details[open]").forEach((details) => {
                const isClickInside = details.contains(event.target);
                if (!isClickInside) {
                    details.removeAttribute("open");
                }
            });
        });

        document.addEventListener("keydown", (event) => {
            if (event.key !== "Escape") return;

            document.querySelectorAll("details[open]").forEach((details) => {
                details.removeAttribute("open");

                const summary = details.querySelector("summary");
                if (summary) summary.focus();
            });
        });
    }

    /**
     * ==========================================
     * DISPARO INICIAL (Quando o DOM estiver pronto)
     * ==========================================
     */
    document.addEventListener("DOMContentLoaded", () => {
        initSidebar();
        initPasswordToggles();
        initAvatarUpload();
        initWelcomeAnimations();
        initOutsideClickClose();
    });
})();
