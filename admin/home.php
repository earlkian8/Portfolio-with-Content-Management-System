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
    <title>Portfolio Admin Dashboard</title>
    <link rel="stylesheet" href="../style/home-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="logo">Portfolio CMS</div>
            <nav>
                <ul>
                    <li class="active"><a href="home.php"><i class="fas fa-home"></i> Home</a></li>
                    <li><a href="skills.php"><i class="fas fa-code"></i> Skills</a></li>
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
                <h2>Home Section Management</h2>
                <p>Edit your homepage content</p>
            </div>

            <div class="form-section">
                <form id="homeForm" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Your Name</label>
                        <input type="text" id="name" name="name" placeholder="Enter your name" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label for="designation">Designation/Title</label>
                        <input type="text" id="designation" name="designation" placeholder="e.g. Full Stack Web Developer" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label for="tagline">Tagline</label>
                        <textarea id="tagline" name="tagline" placeholder="Enter your professional tagline" autocomplete="off"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="profile-image">Profile Image</label>
                        <div class="file-upload">
                            <input type="file" id="profile-image" name="profile_image" accept="image/*" style="display: none;">
                            <div class="file-label" onclick="document.getElementById('profile-image').click()">
                                <i class="fas fa-upload"></i> Choose Image
                            </div>
                            <span class="file-name">No file chosen</span>
                        </div>
                        <img id="profile-preview" src="" alt="Profile Preview" style="max-width: 200px; display: none;">
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn primary">Save Changes</button>
                        <button type="reset" class="btn secondary">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('profile-image').addEventListener('change', function(e) {
            const fileName = e.target.files[0].name;
            document.querySelector('.file-name').textContent = fileName;
        });
    </script>
    <script src="../js/home.js"></script>
</body>
</html>