function setLanguage(lang) {
    fetch(`noticia-${lang}.json`)
      .then(res => res.json())
      .then(data => {
        document.querySelectorAll('[data-i18n]').forEach(el => {
          const key  = el.getAttribute('data-i18n');
          const text = data[key];
          if (!text) return;
          const attr = el.getAttribute('data-i18n-attr');
          if (attr) el.setAttribute(attr, text);
          else      el.textContent = text;
        });
        localStorage.setItem('lang', lang);
        updateButton(lang);
      })
      .catch(err => console.error("Error cargando traducciones:", err));
  }
  
  function updateButton(lang) {
    const btn = document.getElementById('lang-btn');
    if (lang === 'es') {
      btn.textContent = '🌐 Inglés';
      btn.onclick     = () => setLanguage('en');
    } else {
      btn.textContent = '🌐 Español';
      btn.onclick     = () => setLanguage('es');
    }
  }
  
  window.addEventListener('DOMContentLoaded', () => {
    const saved = localStorage.getItem('lang') || 'es';
    setLanguage(saved);
  });
  