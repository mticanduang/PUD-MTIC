document.addEventListener('DOMContentLoaded', function() {
  const tabs = document.querySelectorAll('[data-tab]');
  const form = document.querySelector('form');
  const passwordInput = form.querySelector('input[type="password"]');
  const passwordToggle = form.querySelector('button[type="button"]');

  tabs.forEach(tab => {
    tab.addEventListener('click', function() {
      const isActive = this.classList.contains('border-primary');
      if (isActive) return;

      tabs.forEach(t => {
        t.classList.remove('border-primary', 'text-primary');
        t.classList.add('border-transparent', 'text-slate-400');
      });

      this.classList.remove('border-transparent', 'text-slate-400');
      this.classList.add('border-primary', 'text-primary');
    });
  });

  if (passwordToggle) {
    passwordToggle.addEventListener('click', function() {
      const type = passwordInput.type === 'password' ? 'text' : 'password';
      passwordInput.type = type;
      
      const icon = this.querySelector('span.material-symbols-outlined');
      icon.textContent = type === 'password' ? 'visibility' : 'visibility_off';
    });
  }
});
