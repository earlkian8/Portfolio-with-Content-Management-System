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
    <title>Portfolio Admin - Projects</title>
    <link rel="stylesheet" href="../style/projects-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="logo">Portfolio CMS</div>
            <nav>
                <ul>
                    <li><a href="home.php"><i class="fas fa-home"></i> Home</a></li>
                    <li><a href="skills.php"><i class="fas fa-code"></i> Skills</a></li>
                    <li class="active"><a href="projects.php"><i class="fas fa-project-diagram"></i> Projects</a></li>
                    <li><a href="services.php"><i class="fas fa-concierge-bell"></i> Services</a></li>
                </ul>
            </nav>
            <div class="logout">
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Log Out</a>
            </div>
        </div>

        <div class="content">
            <div class="section-header">
                <h2>Projects Section Management</h2>
                <p>Edit your featured projects content</p>
            </div>

            <div class="form-section">
                <div class="section-header-with-button">
                    <h3>Featured Projects</h3>
                    <button class="btn primary add-btn" id="addProjectButton"><i class="fas fa-plus"></i> Add Project</button>
                </div>
                <div class="projects-grid" id="projectsGridId">
                    <!-- Project cards will be loaded dynamically -->
                    <div class="project-card">
                        <div class="project-image">
                            <img src="../assets/images/payroll-project.jpg" alt="Payroll Management System">
                        </div>
                        <div class="project-info">
                            <h4>Payroll Management System</h4>
                            <p class="project-description">A web-based application that automates employee salary computation, and payroll reporting. Designed for small to medium-sized businesses with user-friendly features and secure access.</p>
                            <div class="project-tech">
                                <span class="tech-tag">PHP</span>
                                <span class="tech-tag">JavaScript</span>
                            </div>
                        </div>
                        <div class="card-actions">
                            <button class="btn-icon edit"><i class="fas fa-edit"></i></button>
                            <button class="btn-icon delete"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>
                    <div class="project-card">
                        <div class="project-image">
                            <img src="../assets/images/inventory-project.jpg" alt="Inventory Management System">
                        </div>
                        <div class="project-info">
                            <h4>Inventory Management System</h4>
                            <p class="project-description">A web-based system designed to manage product stocks, sales, and inventory updates efficiently. Includes features for real-time tracking, user roles, and transaction for products.</p>
                            <div class="project-tech">
                                <span class="tech-tag">PHP</span>
                                <span class="tech-tag">JavaScript</span>
                            </div>
                        </div>
                        <div class="card-actions">
                            <button class="btn-icon edit" id="editButton"><i class="fas fa-edit"></i></button>
                            <button class="btn-icon delete"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Add Project Modal -->
    <form id="projectModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Add Project</h3>
                <span class="close" id="projectClose">&times;</span>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="projectTitle">Project Title</label>
                    <input type="text" id="projectTitle" placeholder="e.g. Inventory Management System" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="projectDescription">Description</label>
                    <textarea id="projectDescription" rows="4" placeholder="Describe your project" required autocomplete="off"></textarea>
                </div>
                <div class="form-group">
                    <label for="projectImage">Project Image</label>
                    <input type="file" id="projectImage" accept="image/*">
                    <p class="help-text">Recommended size: 800x500px, Max size: 2MB</p>
                </div>

                <div class="form-group">
                    <label>Technologies Used</label>
                    <div class="tech-tags-input">
                        <input type="text" id="techInput" placeholder="e.g. PHP, JavaScript, React">
                    </div>
                    <div class="selected-tech-tags" id="selectedTechTags">
                        <!-- Selected tech tags will appear here -->
                    </div>
                </div>
                <div class="form-group">
                    <label for="projectLink">Project URL (optional)</label>
                    <input type="url" id="projectLink" placeholder="e.g. https://example.com/project" autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="githubLink">GitHub URL (optional)</label>
                    <input type="url" id="githubLink" placeholder="e.g. https://github.com/username/project" autocomplete="off">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn primary" type="submit">Add Project</button>
                <button class="btn secondary" type="button" id="cancelAdd">Cancel</button>
            </div>
        </div>
    </form>

    <!-- Edit Project Modal -->
    <form method="PUT" id="editProjectModal" class="modal" enctype="multipart/form-data">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Edit Project</h3>
                <span class="close" id="editProjectClose">&times;</span>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="hidden" name="editProjectId" id="editProjectId">
                    <label for="editProjectTitle">Project Title</label>
                    <input type="text" id="editProjectTitle" placeholder="e.g. Inventory Management System" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="editProjectDescription">Description</label>
                    <textarea id="editProjectDescription" rows="4" placeholder="Describe your project" required autocomplete="off"></textarea>
                </div>
                <div class="form-group">
                    <label for="editProjectImage">Project Image</label>
                    <div class="current-image">
                        <img id="currentProjectImage" src="" alt="Current Project Image">
                    </div>
                    <input type="file" id="editProjectImage" accept="image/*">
                    <!-- <p class="help-text">Leave empty to keep current image</p> -->
                </div>
                <div class="form-group">
                    <label>Technologies Used</label>
                    <div class="tech-tags-input">
                        <input type="text" id="editTechInput" placeholder="e.g. PHP, JavaScript, React">
                        <button type="button" id="editAddTechBtn" class="btn primary">Add</button>
                    </div>
                    <div class="selected-tech-tags" id="editSelectedTechTags">
                        <!-- Selected tech tags will appear here -->
                    </div>
                </div>
                <div class="form-group">
                    <label for="editProjectLink">Project URL (optional)</label>
                    <input type="url" id="editProjectLink" placeholder="e.g. https://example.com/project" autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="editGithubLink">GitHub URL (optional)</label>
                    <input type="url" id="editGithubLink" placeholder="e.g. https://github.com/username/project" autocomplete="off">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn primary" type="submit">Save Project</button>
                <button class="btn secondary" id="editProjectCancel" type="button">Cancel</button>
            </div>
        </div>
    </form>
    
    <script src="../js/projects.js"></script>
    
</body>
</html>