document.addEventListener("DOMContentLoaded", function() {
  
    const navToggle = document.querySelector('.nav-toggle');
    const navMiddle = document.querySelector('.nav-middle ul');
    const navRight = document.querySelector('.nav-right ul');

    if (navToggle) {
        navToggle.addEventListener('click', function() {
            navMiddle.classList.toggle('show');
            navRight.classList.toggle('show');
        });
    }

    
    const internalLinks = document.querySelectorAll('a[href^="#"]');

    internalLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);

            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop,
                    behavior: 'smooth'
                });
            }
        });
    });
    
    
    const menuItems = document.querySelectorAll('nav ul li a');
    const currentPath = window.location.pathname;

    menuItems.forEach(item => {
        if (item.getAttribute('href') === currentPath) {
            item.classList.add('active');
        }
    });
    

    const dropdowns = document.querySelectorAll('.dropdown');

    dropdowns.forEach(dropdown => {
        dropdown.addEventListener('mouseenter', () => {
            dropdown.querySelector('.dropdown-content').style.display = 'block';
        });

        dropdown.addEventListener('mouseleave', () => {
            dropdown.querySelector('.dropdown-content').style.display = 'none';
        });

        
        const dropdownLink = dropdown.querySelector('a');
        dropdownLink.addEventListener('focus', () => {
            dropdown.querySelector('.dropdown-content').style.display = 'block';
        });

        
        dropdown.querySelector('.dropdown-content').addEventListener('blur', () => {
            dropdown.querySelector('.dropdown-content').style.display = 'none';
        }, true);
    });
    
    const footerSections = document.querySelectorAll('.footer-section');

    footerSections.forEach(section => {
        const sectionHeader = section.querySelector('h3');
        sectionHeader.addEventListener('click', () => {
            section.classList.toggle('expanded');
        });
    });
});

document.getElementById("load-more-btn").addEventListener("click", function() {
    const newCourses = `
        <div class="course">
            <a href="it_support_cs.html">
                <img src="course7.jpg" alt="Google IT Support Professional Certificate">
                <h3>Google IT Support Professional Certificate</h3>
            </a>
            <p>Learn the fundamentals of IT support, including troubleshooting, networking, and operating systems.</p>
        </div>
        <div class="course">
            <a href="aws_cs.html">
                <img src="course8.jpg" alt="AWS Certified Solutions">
                <h3>AWS Certified Solutions</h3>
            </a>
            <p>Gain expertise in designing and deploying scalable systems on Amazon Web Services (AWS).</p>
        </div>
        <div class="course">
            <a href="azure_cs.html">
                <img src="course9.jpg" alt="Microsoft Azure Fundamentals">
                <h3>Microsoft Azure Fundamentals</h3>
            </a>
            <p>Understand the basics of cloud services and how they are provided with Microsoft Azure.</p>
        </div>
    `;
    
    document.getElementById("courses-grid").insertAdjacentHTML('beforeend', newCourses);
    this.style.display = "none"; // Hide the button after loading more courses
});
