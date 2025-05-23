<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio</title>
    <link rel="stylesheet" href="style/styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</head>
    <form method="post" action="index.php" id="adminLoginModal" class="modal-overlay">
        <div class="modal-content">
        <div class="modal-header">
            <h2>Admin Login</h2>
            <span class="close-btn" id="closeBtn">&times;</span>
        </div>
        <div class="modal-body">
            <form id="adminLoginForm">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required autocomplete="off">
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required autocomplete="off">
            </div>
            <div class="form-actions">
                <button type="button" class="cancel-btn" id="cancelBtn">Cancel</button>
                <button type="submit" class="login-btn" name="login" id="login">Login</button>
            </div>
            </form>
        </div>
        </div>
    </form>
    <header>
        <div class="logo">
            <span class="gradient-text" id="headText">Portfolio</span>
        </div>
        <nav>
            <ul>
                <li><a href="#home" class="active">Home</a></li>
                <li><a href="#skills">Skills</a></li>
                <li><a href="#projects">Projects</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
        <div class="menu-toggle">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>
    </header>

    <main>
        <section id="home" class="section active">
            <div class="container">
                <div class="home-content" id="homeContentId">
                    
                </div>
            </div>
        </section>

        <section id="skills" class="section">
            <div class="container">
                <h2 class="section-title">My <span class="gradient-text">Skills</span></h2>
                
                <div class="skills-container">
                    <div class="skill-category">
                        <h3>Technical Skills</h3>
                        <p class="skills-description" id="skillsDescription"></p>
                        
                        <div class="skills-icons-grid" id="skillsIconsGrid">
                            <!-- <div class="skill-icon-item">
                                <div class="skill-logo">
                                    <i class="fab fa-html5"></i>
                                </div>
                                <span>HTML5</span>
                            </div>
                            <div class="skill-icon-item">
                                <div class="skill-logo">
                                    <i class="fab fa-css3-alt"></i>
                                </div>
                                <span>CSS3</span>
                            </div>
                            <div class="skill-icon-item">
                                <div class="skill-logo">
                                    <i class="fab fa-js"></i>
                                </div>
                                <span>JavaScript</span>
                            </div>
                            <div class="skill-icon-item">
                                <div class="skill-logo">
                                    <i class="fab fa-python"></i>
                                </div>
                                <span>Python</span>
                            </div>
                            <div class="skill-icon-item">
                                <div class="skill-logo">
                                    <i class="fab fa-php"></i>
                                </div>
                                <span>PHP</span>
                            </div>
                            <div class="skill-icon-item">
                                <div class="skill-logo">
                                    <i class="fas fa-database"></i>
                                </div>
                                <span>MySQL</span>
                            </div>
                            <div class="skill-icon-item">
                                <div class="skill-logo">
                                    <i class="fa-brands fa-java"></i>
                                </div>
                                <span>Java</span>
                            </div>
                            <div class="skill-icon-item">
                                <div class="skill-logo">
                                    <i class="fas fa-code"></i>
                                </div>
                                <span>C++</span>
                            </div> -->
                        </div>
                    </div>
                    
                    <!-- Education Section -->
                    <div class="skill-category">
                        <h3>Education</h3>
                        <div class="timeline" id="timelineId">
                            <!-- <div class="timeline-item">
                                <div class="timeline-dot"></div>
                                <div class="timeline-content">
                                    <h4>Bachelor of Science in Information Technology</h4>
                                    <p class="timeline-location">Western Mindanao State University</p>
                                    <p class="timeline-date">2023 - Present</p>
                                    <p>Currently pursuing a degree in Information Technology, focusing on web development and software engineering.</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-dot"></div>
                                <div class="timeline-content">
                                    <h4>TVL - ICT Technical Drafting</h4>
                                    <p class="timeline-location">Mangusu Integrated School</p>
                                    <p class="timeline-date">2021-2023</p>
                                    <p>Completed Senior High School under the TVL-ICT strand, specializing in Technical Drafting.</p>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    
                    <!-- Experience Section -->
                    <div class="skill-category">
                        <h3>Experience</h3>
                        <div class="timeline" id="experienceTimeline">
                            <!-- <div class="timeline-item">
                                <div class="timeline-dot"></div>
                                <div class="timeline-content">
                                    <h4>Network Intern</h4>
                                    <p class="timeline-location">Department of Information Communication Technology</p>
                                    <p class="timeline-date">2023</p>
                                    <p>Assisted in setting up, maintaining, and troubleshooting network systems. Gained hands-on experience with routers, switches, and basic IT infrastructure.</p>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    
                    <!-- Stats Section -->
                    <div class="stats-container">
                        <div class="stat-item">
                            <div class="stat-number counter" id="projectCompletedId"></div>
                            <div class="stat-title">Projects Completed</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number counter" id="clientsServedId"></div>
                            <div class="stat-title">Clients Served</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number counter" id="yearsExperienceId"></div>
                            <div class="stat-title">Years Experience</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="projects" class="section">
            <div class="container">
                <h2 class="section-title">Featured <span class="gradient-text">Projects</span></h2>
                <div class="projects-grid" id="projectGridId">
                    <!-- <div class="project-card">
                        <div class="project-image">
                            <img src="images/payroll.png" alt="Project 1">
                            <div class="project-overlay">
                                <div class="project-links">
                                    <a href="#" class="project-link" ><i class="fas fa-eye"></i></a>
                                    <a href="#" class="project-link"><i class="fab fa-github"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="project-info">
                            <h3>Payroll Management System</h3>
                            <p>A web-based application that automates employee salary computation, and payroll reporting. Designed for small to medium-sized businesses with user-friendly features and secure access.</p>
                            <div class="project-tags">
                                <span>PHP</span>
                                <span>Javascript</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="project-card">
                        <div class="project-image">
                            <img src="images/inventory.png" alt="Project 2">
                            <div class="project-overlay">
                                <div class="project-links">
                                    <a href="#" class="project-link"><i class="fas fa-eye"></i></a>
                                    <a href="#" class="project-link"><i class="fab fa-github"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="project-info">
                            <h3>Inventory Management System</h3>
                            <p>A web-based system designed to manage product stocks, sales, and inventory updates efficiently. Includes features for real-time tracking, user roles, and transaction for products.</p>
                            <div class="project-tags">
                                <span>PHP</span>
                                <span>JavaScript</span>
                            </div>
                        </div>
                    </div> -->
                    
                </div>
            </div>
        </section>

        <section id="services" class="section">
            <div class="container">
                <h2 class="section-title">My <span class="gradient-text">Services</span></h2>
                <div class="services-grid" id="serviceGrids">
                    <!-- <div class="service-card">
                        <h3>Web Development</h3>
                        <p>I create responsive and well-structured websites that perform smoothly across all devices. By combining modern technologies with tailored design, I deliver web solutions that help you stand out and support your goals.</p>
                    </div>
                    
                    <div class="service-card">
                        <h3>Software Development</h3>
                        <p>I develop user-centered software with clean interfaces and reliable functionality. Every project is designed to be efficient, easy to navigate, and aligned with your specific needs.</p>
                    </div>
                    
                    <div class="service-card">
                        <h3>UI/UX Design</h3>
                        <p>I design thoughtful and intuitive user experiences that enhance how people interact with your product. With a strong focus on both usability and visual appeal, I help turn ideas into meaningful digital experiences.</p>
                    </div> -->
                </div>
            </div>
        </section>

        <section id="contact" class="section">
            <div class="container">
                <h2 class="section-title">Get In <span class="gradient-text">Touch</span></h2>
                <div class="contact-content">
                    <div class="contact-info">
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="contact-details">
                                <h3>Email</h3>
                                <p>earlkian8@gmail.com</p>
                            </div>
                        </div>
                        
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div class="contact-details">
                                <h3>Phone</h3>
                                <p>+63 977 492 5594</p>
                            </div>
                        </div>
                        
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="contact-details">
                                <h3>Location</h3>
                                <p>Mangusu, Zamboanga City</p>
                            </div>
                        </div>
                        
                        <div class="social-links">
                            <a href="https://github.com/earlkian8" class="social-link"><i class="fab fa-github"></i></a>
                            <a href="https://www.linkedin.com/in/earl-kian-bancayrin-213858354/" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    
                    <div class="contact-form">
                        <form id="contactForm">
                            <div class="form-group">
                                <input type="text" id="name" placeholder="Your Name" required  autocomplete="off">
                            </div>
                            <div class="form-group">
                                <input type="email" id="email" placeholder="Your Email" required autocomplete="off">
                            </div>
                            <div class="form-group">
                                <input type="text" id="subject" placeholder="Subject" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <textarea id="message" placeholder="Your Message" required autocomplete="off"></textarea>
                            </div>
                            <button type="submit" class="btn primary-btn">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        
    </main>
    <button class="admin-button-style secondary-btn" id="adminButton">Admin Login</button>
    <script src="js/index.js"></script>
</body>
</html>