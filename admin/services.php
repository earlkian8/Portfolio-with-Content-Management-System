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
    <title>Portfolio Admin - Services</title>
    <link rel="stylesheet" href="../style/services-style.css">
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
                    <li><a href="projects.php"><i class="fas fa-project-diagram"></i> Projects</a></li>
                    <li class="active"><a href="services.php"><i class="fas fa-concierge-bell"></i> Services</a></li>
                </ul>
            </nav>
            <div class="logout">
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Log Out</a>
            </div>
        </div>

        <div class="content">
            <div class="section-header">
                <h2>Services Section Management</h2>
                <p>Edit your services content and offerings</p>
            </div>

            <div class="form-section">
                <div class="section-header-with-button">
                    <h3>Your Services</h3>
                    <button class="btn primary add-btn" id="addServiceButton"><i class="fas fa-plus"></i> Add Service</button>
                </div>
                <div class="services-grid" id="servicesGridId">
                    <!-- Service cards will be loaded dynamically -->
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-laptop-code"></i>
                        </div>
                        <div class="service-info">
                            <h4>Web Development</h4>
                            <p class="service-description">I create responsive and well-structured websites that perform smoothly across all devices. By combining modern technologies with tailored design, I deliver web solutions that help you stand out and support your goals.</p>
                        </div>
                        <div class="card-actions">
                            <button class="btn-icon edit"><i class="fas fa-edit"></i></button>
                            <button class="btn-icon delete"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <div class="service-info">
                            <h4>Software Development</h4>
                            <p class="service-description">I develop user-centered software with clean interfaces and reliable functionality. Every project is designed to be efficient, easy to navigate, and aligned with your specific needs.</p>
                        </div>
                        <div class="card-actions">
                            <button class="btn-icon edit"><i class="fas fa-edit"></i></button>
                            <button class="btn-icon delete"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-pencil-ruler"></i>
                        </div>
                        <div class="service-info">
                            <h4>UI/UX Design</h4>
                            <p class="service-description">I design thoughtful and intuitive user experiences that enhance how people interact with your product. With a strong focus on both usability and visual appeal, I help turn ideas into meaningful digital experiences.</p>
                        </div>
                        <div class="card-actions">
                            <button class="btn-icon edit"><i class="fas fa-edit"></i></button>
                            <button class="btn-icon delete"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Add Service Modal -->
    <form id="serviceModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Add Service</h3>
                <span class="close" id="serviceClose">&times;</span>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="serviceTitle">Service Title</label>
                    <input type="text" id="serviceTitle" placeholder="e.g. Web Development" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="serviceDescription">Description</label>
                    <textarea id="serviceDescription" rows="4" placeholder="Describe your service" required autocomplete="off"></textarea>
                </div>
                
            </div>
            <div class="modal-footer">
                <button class="btn primary" type="submit">Add Service</button>
                <button class="btn secondary" type="button" id="cancelAdd">Cancel</button>
            </div>
        </div>
    </form>

    <!-- Edit Service Modal -->
    <form id="editServiceModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Edit Service</h3>
                <span class="close" id="editServiceClose">&times;</span>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="hidden" name="editServiceId" id="editServiceId">
                    <label for="editServiceTitle">Service Title</label>
                    <input type="text" id="editServiceTitle" placeholder="e.g. Web Development" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="editServiceDescription">Description</label>
                    <textarea id="editServiceDescription" rows="4" placeholder="Describe your service" required autocomplete="off"></textarea>
                </div>
            <div class="modal-footer">
                <button class="btn primary" type="submit">Save Service</button>
                <button class="btn secondary" id="editServiceCancel" type="button">Cancel</button>
            </div>
        </div>
    </form>
    
    <script src="../js/services.js"></script>
    
</body>
</html>