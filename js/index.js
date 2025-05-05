document.addEventListener('DOMContentLoaded', () => {
    getHome();
    getSkill();

    initCursor();

    initMobileMenu();

    initSectionObservers();

    initSmoothScrolling();

    initAnimations();

    initCounters();

    const homeSection = document.getElementById('home');
    if (homeSection) {
        homeSection.classList.add('active');
        
        const homeElements = document.querySelectorAll('#home .intro-text > *, #home .profile-image');
        homeElements.forEach((element, index) => {
            element.style.opacity = '0';
            element.style.animation = `fadeInUp 0.8s ease-out forwards ${index * 0.3}s`;
        });
    }
    
    document.getElementById("adminButton").addEventListener("click", function(event){
        event.preventDefault();
        document.getElementById("adminLoginModal").classList.add("show");
    });

    document.getElementById("closeBtn").addEventListener("click", function(event){
        event.preventDefault();
        document.getElementById("adminLoginModal").classList.remove("show");
    });
    document.getElementById("cancelBtn").addEventListener("click", function(event){
        event.preventDefault();
        document.getElementById("adminLoginModal").classList.remove("show");
    });

    document.getElementById("adminLoginModal").addEventListener("submit", function(event){
        event.preventDefault();
    
        const formData = {
            username: document.getElementById("username").value,
            password: document.getElementById("password").value
        };
    
        fetch("api/admin_login_api.php", {
            method: "POST",
            body: JSON.stringify(formData),
            headers: {"Content-Type": "application/json"}
        })
        .then(response => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.json();
        })
        .then(data => {
            if(data.status === "success"){
                document.getElementById("adminLoginModal").classList.remove("show");
                window.location.reload();
            } else {
                alert(data.message || "Login failed");
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("An error occurred during login");
        });
    });

    
});

function initCursor() {
    const cursor = document.querySelector('.cursor');
    if (!cursor) return;
    
    document.addEventListener('mousemove', (e) => {
        cursor.style.left = `${e.clientX}px`;
        cursor.style.top = `${e.clientY}px`;
    });
    
    document.addEventListener('click', () => {
        cursor.classList.add('cursor-click');
        setTimeout(() => {
            cursor.classList.remove('cursor-click');
        }, 500);
    });
    
    document.querySelectorAll('a, button, .menu-toggle').forEach(link => {
        link.addEventListener('mouseenter', () => {
            cursor.classList.add('cursor-hover');
        });
        
        link.addEventListener('mouseleave', () => {
            cursor.classList.remove('cursor-hover');
        });
    });
}

function initMobileMenu() {
    const menuToggle = document.querySelector('.menu-toggle');
    const navList = document.querySelector('nav ul');
    
    if (menuToggle && navList) {
        menuToggle.addEventListener('click', () => {
            menuToggle.classList.toggle('active');
            navList.classList.toggle('active');
        });
    }
}

function initSectionObservers() {
    const sections = document.querySelectorAll('.section');
    const navLinks = document.querySelectorAll('nav ul li a');
    
    if (!sections.length) return;
    
    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.3
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');

                const id = entry.target.getAttribute('id');
                navLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href') === `#${id}`) {
                        link.classList.add('active');
                    }
                });

                animateSectionElements(entry.target, id);
            }
        });
    }, observerOptions);
    
    sections.forEach(section => {
        observer.observe(section);
    });
}

function animateSectionElements(section, id) {

    if (id === 'skills') {

        section.querySelectorAll('.progress').forEach(progress => {
            const width = progress.getAttribute('style')?.split(':')[1];
            if (width) {
                progress.style.width = width;
            }
        });

        animateElements(section.querySelectorAll('.skill-icon-item'), 0.1);

        animateElements(section.querySelectorAll('.timeline-item'), 0.3);

        animateElements(section.querySelectorAll('.stat-item'), 0.2);
    }

    else if (id === 'projects') {
        animateElements(section.querySelectorAll('.project-card'), 0.2);
    }

    else if (id === 'services') {
        animateElements(section.querySelectorAll('.service-card'), 0.2);
    }

    else if (id === 'contact') {
        animateElements(section.querySelectorAll('.contact-item'), 0.2);
        animateElements(section.querySelectorAll('.form-group, .contact-form .primary-btn'), 0.15);
        
        const socialLinks = section.querySelector('.social-links');
        if (socialLinks) {
            socialLinks.style.opacity = '0';
            socialLinks.style.animation = 'fadeInUp 0.6s ease-out forwards 0.8s';
        }
    }
}

function animateElements(elements, delayIncrement) {
    if (!elements.length) return;
    
    elements.forEach((element, index) => {
        element.style.opacity = '0';
        element.style.animation = `fadeInUp 0.6s ease-out forwards ${index * delayIncrement}s`;
    });
}

function initSmoothScrolling() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            const targetSection = document.querySelector(targetId);
            
            if (targetSection) {

                const menuToggle = document.querySelector('.menu-toggle');
                const navList = document.querySelector('nav ul');
                
                if (menuToggle && menuToggle.classList.contains('active')) {
                    menuToggle.classList.remove('active');
                    navList.classList.remove('active');
                }

                window.scrollTo({
                    top: targetSection.offsetTop - 80,
                    behavior: 'smooth'
                });
            }
        });
    });
}

function initAnimations() {

    const nameElement = document.querySelector('.typing-effect');
    if (nameElement) {
        const name = nameElement.textContent;
        nameElement.textContent = '';
        let i = 0;
        
        function typeWriter() {
            if (i < name.length) {
                nameElement.textContent += name.charAt(i);
                i++;
                setTimeout(typeWriter, 150);
            }
        }
        
        setTimeout(typeWriter, 1000);
    }

    const greeting = document.querySelector('.greeting');
    const profession = document.querySelector('.profession');
    const tagline = document.querySelector('.tagline');
    const ctaButtons = document.querySelector('.cta-buttons');
    
    if (greeting) greeting.style.animation = 'fadeInUp 0.8s ease-out forwards';
    if (profession) profession.style.animation = 'fadeInUp 0.8s ease-out forwards 1.5s';
    if (tagline) tagline.style.animation = 'fadeInUp 0.8s ease-out forwards 1.8s';
    if (ctaButtons) ctaButtons.style.animation = 'fadeInUp 0.8s ease-out forwards 2.1s';
    
    [greeting, profession, tagline, ctaButtons].forEach(el => {
        if (el) el.style.opacity = '0';
    });
}

function initCounters() {
    const statsContainer = document.querySelector('.stats-container');
    
    if (!statsContainer) return;
    
    const statsObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                startCounters();
                statsObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });
    
    statsObserver.observe(statsContainer);
    
    function startCounters() {
        const counters = document.querySelectorAll('.counter');
        
        counters.forEach(counter => {
            const target = parseInt(counter.textContent, 10);
            let count = 0;
            const speed = 100 / target;
            
            function updateCount() {
                const increment = target / 100;
                
                if (count < target) {
                    counter.textContent = Math.ceil(count + increment);
                    count = count + increment;
                    setTimeout(updateCount, speed);
                } else {
                    counter.textContent = target;
                }
            }
            
            updateCount();
        });
    }
}

function getHome(){
    fetch("api/admin_home_api.php")
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            const home = data.homeData[0];

            document.getElementById("homeContentId").innerHTML += `
                <div class="intro-text">
                    <h1 class="greeting">Hello, I'm</h1>
                    <h2 class="name typing-effect">${home.name}</h2>
                    <h3 class="profession gradient-text">${home.designation}</h3>
                    <p class="tagline">${home.tagline}</p>
                    <div class="cta-buttons">
                        <a href="#contact" class="btn primary-btn">Contact Me</a>
                        <a href="#projects" class="btn secondary-btn">View Work</a>
                    </div>
                </div>
                <div class="profile-image">
                    <div class="image-container" id="imageContainer">
                        <div class="blob-bg"></div>
                        <img src="Uploads/${home.profile_image}" alt="Profile Image">
                    </div>
                </div>
            `;

            initAnimations();

            const homeElements = document.querySelectorAll('#home .intro-text > *, #home .profile-image');
            homeElements.forEach((element, index) => {
                element.style.opacity = '0';
                element.style.animation = `fadeInUp 0.8s ease-out forwards ${index * 0.3}s`;
            });
        }
    })
    .catch(error => console.error(error));
}

function getSkill(){
    fetch("api/admin_skills_api.php", {
        method: "GET",
        headers: {"Content-Type": "application/json"}
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            const skillData = data.skills;
            document.getElementById("skillsDescription").textContent = skillData.description;
            document.getElementById("projectCompletedId").textContent = skillData.project_completed;
            document.getElementById("clientsServedId").textContent = skillData.clients_served;
            document.getElementById("yearsExperienceId").textContent = skillData.years_experience;
        }
    })
    .catch(error => console.error(error));
}