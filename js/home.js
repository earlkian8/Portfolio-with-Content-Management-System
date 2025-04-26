document.addEventListener("DOMContentLoaded", function() {
    getHome();

    document.getElementById("homeForm").addEventListener("submit", function(e) {
        e.preventDefault();
        updateHome();
    });

    document.getElementById("profile-image").addEventListener("change", function(e) {
        const fileName = e.target.files[0] ? e.target.files[0].name : "No file chosen";
        document.querySelector(".file-name").textContent = fileName;
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
            }
        }
    })
    .catch(error => console.error("Error fetching home data:", error));
}

function updateHome() {
    const formData = {
        name: document.getElementById("name").value,
        designation: document.getElementById("designation").value,
        tagline: document.getElementById("tagline").value
    };

    const imageInput = document.getElementById("profile-image");
    const file = imageInput.files[0];
    
    if (file) {
        uploadImage(file)
            .then(imagePath => {
                formData.profile_image = imagePath;
                sendUpdateRequest(formData);
            })
            .catch(error => {
                console.error("Error uploading image:", error);
                alert("Error uploading image");
            });
    } else {
        sendUpdateRequest(formData);
    }
}

function uploadImage(file) {
    const formData = new FormData();
    formData.append("profile_image", file);

    return fetch("../api/upload_image.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === "success") {
            return data.fileName;
        } else {
            throw new Error(data.message || "Image upload failed");
        }
    });
}

function sendUpdateRequest(data) {
    fetch("../api/admin_home_api.php", {
        method: "PUT",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === "success") {
            alert("Home section updated successfully!");
            if (data.profile_image) {
                document.getElementById("profile-preview").src = "../uploads/" + data.profile_image;
            }
            // Clear file input after successful upload
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