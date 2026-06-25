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
        const isSmallScreen = window.innerWidth < 1024; // Mantido o seu padrão de 1024px
        const isMobile = window.innerWidth < 768;

        let newState = "false";

        if (isResize) {
            if (isSmallScreen) {
                // Se a tela foi redimensionada e ficou menor que 1024px, colapsa/esconde
                newState = "true";
            } else {
                // Se voltou para tela grande, respeita a preferência do usuário
                newState = savedPreference !== null ? savedPreference : "false";
            }
        } else {
            if (savedPreference !== null) {
                // Se houver preferência e for mobile, força fechar para não cobrir a tela no load
                newState = isMobile ? "true" : savedPreference;
            } else {
                // Sem preferência: menor que 1024px começa fechada (true)
                newState = isSmallScreen ? "true" : "false";
            }
        }

        // Atualiza os atributos em sincronia
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

        // Inicializa o estado correto da sidebar e do backdrop ao carregar a página
        updateSidebarState();

        // Monitora o redimensionamento da tela
        window.addEventListener("resize", () => updateSidebarState(true));

        // Função interna auxiliar para fechar a sidebar no mobile de forma rápida
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

        // 1. Gerencia o clique no botão principal de abrir/fechar (Toggle)
        if (toggleBtn) {
            toggleBtn.addEventListener("click", () => {
                const sidebar = getSidebar();
                if (!sidebar) return;

                const isCollapsed = sidebar.dataset.collapsed === "true";
                const newState = isCollapsed ? "false" : "true";
                const isMobile = window.innerWidth < 768;

                // Aplica a mudança de estado síncrona
                sidebar.dataset.collapsed = newState;
                document.documentElement.setAttribute(
                    "data-sidebar-collapsed",
                    newState,
                );
                localStorage.setItem(STORAGE_KEY, newState);

                // Controla o backdrop no mobile baseando-se no novo estado aplicado
                if (backdrop && isMobile) {
                    if (newState === "false") {
                        backdrop.classList.remove("hidden");
                    } else {
                        backdrop.classList.add("hidden");
                    }
                }
            });
        }

        // 2. FECHAR AO CLICAR FORA: Fecha a sidebar caso o usuário toque na região escura
        if (backdrop) {
            backdrop.addEventListener("click", closeSidebarOnMobile);
        }

        // 3. FECHAR AO CLICAR EM LINKS: Fecha automaticamente a barra após escolher uma opção no mobile
        const sidebarContainer = getSidebar();
        if (sidebarContainer) {
            const interactiveElements = sidebarContainer.querySelectorAll(
                ".sidebar-item, button, a",
            );

            interactiveElements.forEach((element) => {
                // Ignora o próprio botão de toggle e formulários puros
                if (
                    element.id === "sidebar-toggle" ||
                    element.tagName === "FORM"
                )
                    return;

                element.addEventListener("click", () => {
                    // Ignora se for o <summary> do menu do usuário (para permitir que o submenu abra)
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
