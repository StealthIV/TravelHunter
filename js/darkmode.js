function toggleDarkMode() {
    const nav = document.querySelector('nav');
    const toggleIcon = document.getElementById('toggleIcon');
    
    nav.classList.toggle('dark-mode');
    
    // Switch icon based on mode
    if (nav.classList.contains('dark-mode')) {
      toggleIcon.classList.replace('fa-sun', 'fa-moon'); // Moon icon for dark mode
    } else {
      toggleIcon.classList.replace('fa-moon', 'fa-sun'); // Sun icon for light mode
    }
  }
  