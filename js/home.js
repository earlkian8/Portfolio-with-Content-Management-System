document.addEventListener("DOMContentLoaded", function() {
    getHome();

    document.getElementById("homeForm").addEventListener("submit", function(e) {
        e.preventDefault();
        updateHome();
    });

    document.getElementById("profile-image").addEventListener("change", function(e) {
        const fileName = e.target.files[0] ? e.target.files[0].name : "No file chosen";
        document.querySelector(".file-name").textContent = fileName;

        if (e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById("profile-preview");
                preview.src = e.target.result;
                preview.style.display = "block";
            };
            reader.readAsDataURL(e.target.files[0]);
        }
    });
});

function getHome() {
    fetch("../api/admin_home_api.php", {
        method: "GET",
        headers: { "Content-Type": "application/json" }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === "success") {
            const home = data.homeData[0];
            document.getElementById("name").value = home.name || "";
            document.getElementById("designation").value = home.designation || "";
            document.getElementById("tagline").value = home.tagline || "";
            if (home.profile_image) {
                document.getElementById("profile-preview").src = "../uploads/" + home.profile_image;
                document.getElementById("profile-preview").style.display = "block";
            }
        }
    })
    .catch(error => console.error("Error fetching home data:", error));
}

function updateHome() {
    const formData = new FormData();
    formData.append("name", document.getElementById("name").value);
    formData.append("designation", document.getElementById("designation").value);
    formData.append("tagline", document.getElementById("tagline").value);
    
    const imageInput = document.getElementById("profile-image");
    if (imageInput.files[0]) {
        formData.append("profile_image", imageInput.files[0]);
    }

    fetch("../api/admin_home_api.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === "success") {
            alert("Home section updated successfully!");
            if (data.profile_image) {
                document.getElementById("profile-preview").src = "../Uploads/" + data.profile_image;
                document.getElementById("profile-preview").style.display = "block";
            }
            document.getElementById("profile-image").value = "";
            document.querySelector(".file-name").textContent = "No file chosen";
        } else {
            alert("Error: " + (data.message || "Failed to update home section"));
        }
    })
    .catch(error => {
        console.error("Error updating home data:", error);
        alert("An error occurred while updating home section");
    });
}