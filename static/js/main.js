/* ============================================
   NERMAN.AI — Main JavaScript
   ============================================ */

document.addEventListener('DOMContentLoaded', () => {

    // ─── Splash Auto-redirect ───
    if (document.querySelector('.splash-page')) {
        setTimeout(() => {
            window.location.href = '/landing/';
        }, 3000);
    }

    // ─── FAQ Accordion ───
    document.querySelectorAll('.faq-question').forEach(q => {
        q.addEventListener('click', () => {
            const item = q.parentElement;
            const wasOpen = item.classList.contains('open');
            // Close all
            document.querySelectorAll('.faq-item').forEach(i => i.classList.remove('open'));
            // Toggle clicked
            if (!wasOpen) item.classList.add('open');
        });
    });

    // ─── Language Dropdown ───
    const langBtn = document.querySelector('.nav-lang');
    const langDrop = document.querySelector('.lang-dropdown');
    if (langBtn && langDrop) {
        langBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            langDrop.classList.toggle('open');
        });
        document.addEventListener('click', () => langDrop.classList.remove('open'));
        langDrop.querySelectorAll('.lang-option').forEach(opt => {
            opt.addEventListener('click', () => {
                langDrop.querySelectorAll('.lang-option').forEach(o => o.classList.remove('active'));
                opt.classList.add('active');
                langBtn.querySelector('.lang-text').textContent = opt.textContent.trim();
                langDrop.classList.remove('open');
            });
        });
    }

    // ─── Hamburger Dropdown (Mobile) ───
    const hambBtn = document.querySelector('.hamburger-btn');
    const hambDrop = document.querySelector('.dropdown-menu');
    if (hambBtn && hambDrop) {
        hambBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            hambDrop.classList.toggle('open');
        });
        document.addEventListener('click', () => {
            if (hambDrop) hambDrop.classList.remove('open');
        });
    }

    // ─── Sound Player Controls ───
    const playBtn = document.querySelector('.play-btn');
    const artwork = document.querySelector('.sound-artwork');
    let isPlaying = false;
    if (playBtn) {
        playBtn.addEventListener('click', () => {
            isPlaying = !isPlaying;
            playBtn.textContent = isPlaying ? '⏸' : '▶';
            if (artwork) {
                artwork.style.animation = isPlaying ? 'gentleRotate 4s linear infinite' : 'none';
            }
        });
    }

    // ─── Variant Pills ───
    document.querySelectorAll('.variant-pill').forEach(pill => {
        pill.addEventListener('click', () => {
            document.querySelectorAll('.variant-pill').forEach(p => p.classList.remove('active'));
            pill.classList.add('active');
            if (artwork) {
                artwork.textContent = pill.textContent.trim();
            }
        });
    });

    // ─── Copy Handle ───
    document.querySelectorAll('.copy-icon').forEach(icon => {
        icon.addEventListener('click', () => {
            const handle = icon.parentElement.querySelector('.handle-text');
            if (handle) {
                navigator.clipboard.writeText(handle.textContent).then(() => {
                    icon.textContent = '✓';
                    setTimeout(() => { icon.textContent = '📋'; }, 1500);
                });
            }
        });
    });

    // ─── Stagger list animations ───
    document.querySelectorAll('.sound-item').forEach((item, i) => {
        item.style.opacity = '0';
        item.style.transform = 'translateY(10px)';
        item.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
        setTimeout(() => {
            item.style.opacity = '1';
            item.style.transform = 'translateY(0)';
        }, i * 50);
    });

    // ─── Element card stagger ───
    document.querySelectorAll('.element-card').forEach((card, i) => {
        card.style.opacity = '0';
        card.style.transform = 'scale(0.9)';
        card.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
        setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'scale(1)';
        }, i * 40);
    });

});

// ─── Add gentle rotate keyframes dynamically ───
const styleSheet = document.createElement('style');
styleSheet.textContent = `
  @keyframes gentleRotate {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
  }
`;
document.head.appendChild(styleSheet);
