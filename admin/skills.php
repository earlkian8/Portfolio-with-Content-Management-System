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
                    <li><a href="projects.php"><i class="fas fa-project-diagram"></i> Projects</a></li>
                    <li><a href="services.php"><i class="fas fa-concierge-bell"></i> Services</a></li>
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
                <input type="hidden" name="skillsId" id="skillsId">
                <textarea id="technicalSkillsDescription" rows="5"></textarea>
            </div>

            <div class="form-section">
                <div class="section-header-with-button">
                    <h3>Programming Skills</h3>
                    <button class="btn primary add-btn" id="addSkillButton"><i class="fas fa-plus"></i> Add Skill</button>
                </div>
                <div class="cards-grid" id="cardsGridId">
                    
                </div>
            </div>

            <div class="form-section">
                <div class="section-header-with-button">
                    <h3>Education</h3>
                    <button class="btn primary add-btn" id="addEducationButton"><i class="fas fa-plus"></i> Add Education</button>
                </div>
                <div class="education-cards" id="educationCardsId">
                    <div class="education-card">
                        <div class="education-info">
                            <h4>Bachelor of Science in Information Technology</h4>
                            <p class="institution">Western Mindanao State University</p>
                            <p class="period">2023 - Present</p>
                            <p class="description">Currently pursuing a degree in Information Technology, focusing on web development and software engineering.</p>
                        </div>
                        <div class="card-actions">
                            <button class="btn-icon edit"><i class="fas fa-edit"></i></button>
                            <button class="btn-icon delete"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>
                    <div class="education-card">
                        <div class="education-info">
                            <h4>TVL - ICT Technical Drafting</h4>
                            <p class="institution">Mangusu Integrated School</p>
                            <p class="period">2021-2023</p>
                            <p class="description">Completed Senior High School under the TVL-ICT strand, specializing in Technical Drafting.</p>
                        </div>
                        <div class="card-actions">
                            <button class="btn-icon edit"><i class="fas fa-edit"></i></button>
                            <button class="btn-icon delete"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <div class="section-header-with-button">
                    <h3>Experience</h3>
                    <button class="btn primary add-btn" id="addExperienceButton"><i class="fas fa-plus"></i> Add Experience</button>
                </div>
                <div class="experience-cards" id="experienceCardsId">
                    <div class="experience-card">
                        <div class="experience-info">
                            <h4>Network Intern</h4>
                            <p class="company">Department of Information Communication Technology</p>
                            <p class="period">2023</p>
                            <p class="description">Assisted in setting up, maintaining, and troubleshooting network systems. Gained hands-on experience with routers, switches, and basic IT infrastructure.</p>
                        </div>
                        <div class="card-actions">
                            <button class="btn-icon edit"><i class="fas fa-edit"></i></button>
                            <button class="btn-icon delete"><i class="fas fa-trash-alt"></i></button>
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
                        <input type="number" id="projectsCompleted">
                    </div>
                    <div class="stat-group">
                        <label for="clientsServed">Clients Served</label>
                        <input type="number" id="clientsServed">
                    </div>
                    <div class="stat-group">
                        <label for="yearsExperience">Years Experience</label>
                        <input type="number" id="yearsExperience">
                    </div>
                </div>

            </div>

            <div class="form-actions">
                <button class="btn primary" id="saveChangesId">Save Changes</button>
                <button class="btn secondary">Cancel</button>
            </div>
        </div>
    </div>

    <!-- Add Skill Modal -->
    <form method="POST" id="skillModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Add Skill</h3>
                <span class="close" id="skillClose">&times;</span>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="skillName">Skill Name</label>
                    <input type="text" id="skillName" placeholder="e.g. JavaScript" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="skillIcon">Icon Class</label>
                    <input type="text" id="skillIcon" placeholder="e.g. fab fa-js" required autocomplete="off">
                    <p class="help-text">Use Font Awesome classes. <a href="https://fontawesome.com/icons" target="_blank">Browse icons</a></p>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn primary" type="submit">Add Skill</button>
                <button class="btn secondary" id="skillCancel">Cancel</button>
            </div>
        </div>
    </form>

    <!-- Edit Skill Modal -->
    <form method="PUT" id="editSkillModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Add Skill</h3>
                <span class="close" id="editSkillClose">&times;</span>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="hidden" name="editSkillId" id="editSkillId">
                    <label for="editSkillName">Skill Name</label>
                    <input type="text" id="editSkillName" placeholder="e.g. JavaScript" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="editSkillIcon">Icon Class</label>
                    <input type="text" id="editSkillIcon" placeholder="e.g. fab fa-js" required autocomplete="off">
                    <p class="help-text">Use Font Awesome classes. <a href="https://fontawesome.com/icons" target="_blank">Browse icons</a></p>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn primary" type="submit">Save Skill</button>
                <button class="btn secondary" id="editSkillCancel">Cancel</button>
            </div>
        </div>
    </form>

    <!-- Add Education -->
    <form method="POST" id="educationModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Add Education</h3>
                <span class="close" id="educationClose">&times;</span>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="eduTitle">Degree/Program</label>
                    <input type="text" id="eduTitle" placeholder="e.g. Bachelor of Science in Information Technology" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="eduInstitution">Institution</label>
                    <input type="text" id="eduInstitution" placeholder="e.g. Western Mindanao State University" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="eduStartYear">Start Year</label>
                    <input type="text" id="eduStartYear" placeholder="e.g. 2023" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="eduEndYear">End Year</label>
                    <input type="text" id="eduEndYear" placeholder="e.g. 2027 or Present" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="eduDescription">Description</label>
                    <textarea id="eduDescription" rows="3" placeholder="Describe your education program" required autocomplete="off"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn primary" type="submit">Add Education</button>
                <button class="btn secondary" id="cancelEducation">Cancel</button>
            </div>
        </div>
    </form>

    <!-- Edit Education -->
    <form method="PUT" id="editEducationModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Add Education</h3>
                <span class="close" id="editEducationClose">&times;</span>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="hidden" name="editEduId" id="editEduId">
                    <label for="editEduDegree">Degree/Program</label>
                    <input type="text" id="editEduDegree" placeholder="e.g. Bachelor of Science in Information Technology" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="editEduInstitution">Institution</label>
                    <input type="text" id="editEduInstitution" placeholder="e.g. Western Mindanao State University" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="editEduStartYear">Start Year</label>
                    <input type="text" id="editEduStartYear" placeholder="e.g. 2023" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="editEduEndYear">End Year</label>
                    <input type="text" id="editEduEndYear" placeholder="e.g. 2027 or Present" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="editEduDescription">Description</label>
                    <textarea id="editEduDescription" rows="3" placeholder="Describe your education program" required autocomplete="off"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn primary" type="submit">Save Education</button>
                <button class="btn secondary" id="editEducationCancel">Cancel</button>
            </div>
        </div>
    </form>

    <!-- Add Experience -->
    <form method="POST" id="experienceModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Add Experience</h3>
                <span class="close" id="experienceClose">&times;</span>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="expTitle">Position</label>
                    <input type="text" id="expTitle" placeholder="e.g. Network Intern" required autocomplete="off"> 
                </div>
                <div class="form-group">
                    <label for="expCompany">Company/Organization</label>
                    <input type="text" id="expCompany" placeholder="e.g. Department of Information Communication Technology" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="expStartYear">Start Year</label>
                    <input type="text" id="expStartYear" placeholder="e.g. 2023" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="expEndYear">End Year</label>
                    <input type="text" id="expEndYear" placeholder="e.g. 2023 or Present" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="expDescription">Description</label>
                    <textarea id="expDescription" rows="3" placeholder="Describe your role and responsibilities" required autocomplete="off"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn primary" type="submit">Add Experience</button>
                <button class="btn secondary" id="experienceCancel">Cancel</button>
            </div>
        </div>
    </form>

    <!-- Edit Experience -->
    <form method="POST" id="editExperienceModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Add Experience</h3>
                <span class="close" id="editExperienceClose">&times;</span>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="hidden" name="editExperienceId" id="editExperienceId">
                    <label for="editExpTitle">Position</label>
                    <input type="text" id="editExpTitle" placeholder="e.g. Network Intern" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="editExpCompany">Company/Organization</label>
                    <input type="text" id="editExpCompany" placeholder="e.g. Department of Information Communication Technology" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="editExpStartYear">Start Year</label>
                    <input type="text" id="editExpStartYear" placeholder="e.g. 2023" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="editExpEndYear">End Year</label>
                    <input type="text" id="editExpEndYear" placeholder="e.g. 2023 or Present" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="editExpDescription">Description</label>
                    <textarea id="editExpDescription" rows="3" placeholder="Describe your role and responsibilities" required autocomplete="off"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn primary" type="submit">Save Experience</button>
                <button class="btn secondary" id="experienceCancel">Cancel</button>
            </div>
        </div>
    </form>
    
    <script src="../js/skills.js"></script>
    
</body>
</html>