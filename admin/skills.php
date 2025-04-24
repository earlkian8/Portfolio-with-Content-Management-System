<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio Admin - Skills</title>
    <link rel="stylesheet" href="../style/skills-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="logo">Portfolio CMS</div>
            <nav>
                <ul>
                    <li><a href="home.php"><i class="fas fa-home"></i> Home</a></li>
                    <li class="active"><a href="skills.php"><i class="fas fa-code"></i> Skills</a></li>
                    <li><a href="admin/projects.php"><i class="fas fa-project-diagram"></i> Projects</a></li>
                    <li><a href="admin/services.php"><i class="fas fa-concierge-bell"></i> Services</a></li>
                    <li><a href="admin/contact.php"><i class="fas fa-envelope"></i> Contact</a></li>
                </ul>
            </nav>
            <div class="logout">
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Log Out</a>
            </div>
        </div>

        <div class="content">
            <div class="section-header">
                <h2>Skills Section Management</h2>
                <p>Edit your skills content</p>
            </div>

            <div class="form-group">
                <h3>Technical Skills Description</h3>
                <textarea id="technicalSkillsDescription" rows="5">These are the main technologies I use to build full stack projects. Although I haven't worked with clients yet, I've created several personal projects that show my ability to handle both front-end and back-end development. I'm always learning, improving my skills, and working towards becoming a more experienced and reliable developer.</textarea>
                <div class="button-row">
                    <button class="btn primary">Save Description</button>
                </div>
            </div>

            <div class="form-section">
                <div class="section-header-with-button">
                    <h3>Programming Skills</h3>
                    <button class="btn primary add-btn" onclick="openModal('skillModal')"><i class="fas fa-plus"></i> Add Skill</button>
                </div>
                <div class="cards-grid">
                    <div class="skill-card">
                        <div class="skill-icon"><i class="fab fa-html5"></i></div>
                        <div class="skill-name">HTML5</div>
                        <div class="card-actions">
                            <button class="btn-icon edit" onclick="editSkill('html5')"><i class="fas fa-edit"></i></button>
                            <button class="btn-icon delete" onclick="deleteSkill('html5')"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>
                    <div class="skill-card">
                        <div class="skill-icon"><i class="fab fa-css3-alt"></i></div>
                        <div class="skill-name">CSS3</div>
                        <div class="card-actions">
                            <button class="btn-icon edit" onclick="editSkill('css3')"><i class="fas fa-edit"></i></button>
                            <button class="btn-icon delete" onclick="deleteSkill('css3')"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>
                    <div class="skill-card">
                        <div class="skill-icon"><i class="fab fa-js"></i></div>
                        <div class="skill-name">JavaScript</div>
                        <div class="card-actions">
                            <button class="btn-icon edit" onclick="editSkill('javascript')"><i class="fas fa-edit"></i></button>
                            <button class="btn-icon delete" onclick="deleteSkill('javascript')"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>
                    <div class="skill-card">
                        <div class="skill-icon"><i class="fab fa-python"></i></div>
                        <div class="skill-name">Python</div>
                        <div class="card-actions">
                            <button class="btn-icon edit" onclick="editSkill('python')"><i class="fas fa-edit"></i></button>
                            <button class="btn-icon delete" onclick="deleteSkill('python')"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>
                    <div class="skill-card">
                        <div class="skill-icon"><i class="fab fa-php"></i></div>
                        <div class="skill-name">PHP</div>
                        <div class="card-actions">
                            <button class="btn-icon edit" onclick="editSkill('php')"><i class="fas fa-edit"></i></button>
                            <button class="btn-icon delete" onclick="deleteSkill('php')"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>
                    <div class="skill-card">
                        <div class="skill-icon"><i class="fas fa-database"></i></div>
                        <div class="skill-name">MySQL</div>
                        <div class="card-actions">
                            <button class="btn-icon edit" onclick="editSkill('mysql')"><i class="fas fa-edit"></i></button>
                            <button class="btn-icon delete" onclick="deleteSkill('mysql')"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>
                    <div class="skill-card">
                        <div class="skill-icon"><i class="fab fa-react"></i></div>
                        <div class="skill-name">React</div>
                        <div class="card-actions">
                            <button class="btn-icon edit" onclick="editSkill('react')"><i class="fas fa-edit"></i></button>
                            <button class="btn-icon delete" onclick="deleteSkill('react')"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>
                    <div class="skill-card">
                        <div class="skill-icon"><i class="fas fa-code"></i></div>
                        <div class="skill-name">C++</div>
                        <div class="card-actions">
                            <button class="btn-icon edit" onclick="editSkill('cpp')"><i class="fas fa-edit"></i></button>
                            <button class="btn-icon delete" onclick="deleteSkill('cpp')"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <div class="section-header-with-button">
                    <h3>Education</h3>
                    <button class="btn primary add-btn" onclick="openModal('educationModal')"><i class="fas fa-plus"></i> Add Education</button>
                </div>
                <div class="education-cards">
                    <div class="education-card">
                        <div class="education-info">
                            <h4>Bachelor of Science in Information Technology</h4>
                            <p class="institution">Western Mindanao State University</p>
                            <p class="period">2023 - Present</p>
                            <p class="description">Currently pursuing a degree in Information Technology, focusing on web development and software engineering.</p>
                        </div>
                        <div class="card-actions">
                            <button class="btn-icon edit" onclick="editEducation('bsit')"><i class="fas fa-edit"></i></button>
                            <button class="btn-icon delete" onclick="deleteEducation('bsit')"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>
                    <div class="education-card">
                        <div class="education-info">
                            <h4>TVL - ICT Technical Drafting</h4>
                            <p class="institution">Mangasu Integrated School</p>
                            <p class="period">2021-2023</p>
                            <p class="description">Completed Senior High School under the TVL-ICT strand, specializing in Technical Drafting.</p>
                        </div>
                        <div class="card-actions">
                            <button class="btn-icon edit" onclick="editEducation('tvl')"><i class="fas fa-edit"></i></button>
                            <button class="btn-icon delete" onclick="deleteEducation('tvl')"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <div class="section-header-with-button">
                    <h3>Experience</h3>
                    <button class="btn primary add-btn" onclick="openModal('experienceModal')"><i class="fas fa-plus"></i> Add Experience</button>
                </div>
                <div class="experience-cards">
                    <div class="experience-card">
                        <div class="experience-info">
                            <h4>Network Intern</h4>
                            <p class="company">Department of Information Communication Technology</p>
                            <p class="period">2023</p>
                            <p class="description">Assisted in setting up, maintaining, and troubleshooting network systems. Gained hands-on experience with routers, switches, and basic IT infrastructure.</p>
                        </div>
                        <div class="card-actions">
                            <button class="btn-icon edit" onclick="editExperience('network')"><i class="fas fa-edit"></i></button>
                            <button class="btn-icon delete" onclick="deleteExperience('network')"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <div class="section-header">
                    <h3>Statistics</h3>
                </div>
                <div class="stats-container">
                    <div class="stat-group">
                        <label for="projectsCompleted">Projects Completed</label>
                        <input type="number" id="projectsCompleted" value="25">
                    </div>
                    <div class="stat-group">
                        <label for="clientsServed">Clients Served</label>
                        <input type="number" id="clientsServed" value="18">
                    </div>
                    <div class="stat-group">
                        <label for="yearsExperience">Years Experience</label>
                        <input type="number" id="yearsExperience" value="3">
                    </div>
                </div>
                <div class="button-row">
                    <button class="btn primary">Save Statistics</button>
                </div>
            </div>

            <div class="form-actions">
                <button class="btn primary">Save All Changes</button>
                <button class="btn secondary">Cancel</button>
            </div>
        </div>
    </div>

    <div id="skillModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Add Skill</h3>
                <span class="close" onclick="closeModal('skillModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="skillName">Skill Name</label>
                    <input type="text" id="skillName" placeholder="e.g. JavaScript">
                </div>
                <div class="form-group">
                    <label for="skillIcon">Icon Class</label>
                    <input type="text" id="skillIcon" placeholder="e.g. fab fa-js">
                    <p class="help-text">Use Font Awesome classes. <a href="https://fontawesome.com/icons" target="_blank">Browse icons</a></p>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn primary">Save Skill</button>
                <button class="btn secondary" onclick="closeModal('skillModal')">Cancel</button>
            </div>
        </div>
    </div>

    <div id="educationModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Add Education</h3>
                <span class="close" onclick="closeModal('educationModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="eduTitle">Degree/Program</label>
                    <input type="text" id="eduTitle" placeholder="e.g. Bachelor of Science in Information Technology">
                </div>
                <div class="form-group">
                    <label for="eduInstitution">Institution</label>
                    <input type="text" id="eduInstitution" placeholder="e.g. Western Mindanao State University">
                </div>
                <div class="form-group">
                    <label for="eduStartYear">Start Year</label>
                    <input type="number" id="eduStartYear" placeholder="e.g. 2023">
                </div>
                <div class="form-group">
                    <label for="eduEndYear">End Year</label>
                    <input type="text" id="eduEndYear" placeholder="e.g. 2027 or Present">
                </div>
                <div class="form-group">
                    <label for="eduDescription">Description</label>
                    <textarea id="eduDescription" rows="3" placeholder="Describe your education program"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn primary">Save Education</button>
                <button class="btn secondary" onclick="closeModal('educationModal')">Cancel</button>
            </div>
        </div>
    </div>

    <div id="experienceModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Add Experience</h3>
                <span class="close" onclick="closeModal('experienceModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="expTitle">Position</label>
                    <input type="text" id="expTitle" placeholder="e.g. Network Intern">
                </div>
                <div class="form-group">
                    <label for="expCompany">Company/Organization</label>
                    <input type="text" id="expCompany" placeholder="e.g. Department of Information Communication Technology">
                </div>
                <div class="form-group">
                    <label for="expStartYear">Start Year</label>
                    <input type="number" id="expStartYear" placeholder="e.g. 2023">
                </div>
                <div class="form-group">
                    <label for="expEndYear">End Year</label>
                    <input type="text" id="expEndYear" placeholder="e.g. 2023 or Present">
                </div>
                <div class="form-group">
                    <label for="expDescription">Description</label>
                    <textarea id="expDescription" rows="3" placeholder="Describe your role and responsibilities"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn primary">Save Experience</button>
                <button class="btn secondary" onclick="closeModal('experienceModal')">Cancel</button>
            </div>
        </div>
    </div>

    <script>
        function openModal(modalId) {
            document.getElementById(modalId).style.display = "block";
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = "none";
        }

        function editSkill(id) {
            openModal('skillModal');
        }

        function deleteSkill(id) {
            if (confirm("Are you sure you want to delete this skill?")) {
                console.log("Deleting skill: " + id);
            }
        }

        function editEducation(id) {
            openModal('educationModal');
        }

        function deleteEducation(id) {
            if (confirm("Are you sure you want to delete this education entry?")) {
                console.log("Deleting education: " + id);
            }
        }

        function editExperience(id) {
            openModal('experienceModal');
        }

        function deleteExperience(id) {
            if (confirm("Are you sure you want to delete this experience entry?")) {
                console.log("Deleting experience: " + id);
            }
        }

        window.onclick = function(event) {
            if (event.target.className === 'modal') {
                event.target.style.display = "none";
            }
        }
    </script>
</body>
</html>