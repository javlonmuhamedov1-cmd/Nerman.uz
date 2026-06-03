/**
 * Shared Animation Logic using Motion One
 * Documentation: https://motion.dev/
 */

// Import will be handled via CDN in the HTML files, 
// so strictly speaking 'animate' and 'stagger' will be available on window.Motion

document.addEventListener('DOMContentLoaded', () => {
    // Check if Motion One is loaded
    if (typeof window.Motion === 'undefined') {
        console.warn('Motion One library not loaded. Animations skipped.');
        return;
    }

    const { animate, stagger, spring, inView } = window.Motion;

    // 1. Dashboard Stats - Staggered Fade In
    if (document.querySelector('.stat-card')) {
        animate(
            '.stat-card',
            { opacity: [0, 1], y: [20, 0] },
            {
                duration: 0.5,
                delay: stagger(0.1),
                easing: spring({ stiffness: 100, damping: 15 })
            }
        );
    }

    // 2. Dashboard Cards/Sections - Slide Up
    if (document.querySelector('.card')) {
        animate(
            '.card',
            { opacity: [0, 1], y: [30, 0] },
            {
                duration: 0.6,
                delay: stagger(0.2, { start: 0.2 }),
                easing: "ease-out"
            }
        );
    }

    // 3. List Items (Chats, Files) - Staggered
    // Applied to any element with .animate-list-item or inside .animate-list-container
    const listItems = document.querySelectorAll('.chat-item, .nav-item, .animate-item');
    if (listItems.length > 0) {
        animate(
            listItems,
            { opacity: [0, 1], x: [-20, 0] },
            {
                duration: 0.4,
                delay: stagger(0.05),
                easing: "ease-out"
            }
        );
    }

    // 4. Buttons - Hover Scale Effect (if not handled by CSS)
    const buttons = document.querySelectorAll('.btn, .action-btn');
    buttons.forEach(btn => {
        btn.addEventListener('mouseenter', () => {
            animate(btn, { scale: 1.05 }, { duration: 0.2 });
        });
        btn.addEventListener('mouseleave', () => {
            animate(btn, { scale: 1 }, { duration: 0.2 });
        });
    });
});

/**
 * Helper to animate a new message entering the chat
 * @param {HTMLElement} element The new message element
 */
function animateNewMessage(element) {
    if (typeof window.Motion === 'undefined') return;
    const { animate, spring } = window.Motion;

    animate(
        element,
        { opacity: [0, 1], scale: [0.9, 1], y: [20, 0] },
        {
            duration: 0.4,
            easing: spring({ stiffness: 200, damping: 20 })
        }
    );
}

// Make sure helper is globally available
window.animateNewMessage = animateNewMessage;
