
// tabs.js
document.addEventListener("DOMContentLoaded", () => {
    const tabLinks = document.querySelectorAll(".tab-link");
    const tabContents = document.querySelectorAll(".tab-content");
  
    tabLinks.forEach(link => {
      link.addEventListener("click", e => {
        e.preventDefault(); // prevent jump to #id
  
        // Clear all active states
        tabLinks.forEach(l => l.classList.remove("active"));
        tabContents.forEach(c => c.classList.remove("active"));
  
        // Activate clicked tab + section
        link.classList.add("active");
        const target = link.dataset.tab;
        document.getElementById(target).classList.add("active");
      });
    });
  });
  