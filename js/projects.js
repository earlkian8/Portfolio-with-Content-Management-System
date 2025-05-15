document.addEventListener("DOMContentLoaded", function(){
    document.getElementById("addProjectButton").addEventListener("click", function(event){
        event.preventDefault();
        document.getElementById("projectModal").classList.add("show");
    });

    document.getElementById("projectClose").addEventListener("click", function(event){
        event.preventDefault();
        document.getElementById("projectModal").classList.remove("show");
    });

    document.getElementById("cancelAdd").addEventListener("click", function(event){
        event.preventDefault();
        document.getElementById("projectModal").classList.remove("show");
    });

    document.getElementById("projectModal").addEventListener("submit", function(event){
        event.preventDefault();
        addProject();
    });

    getProjects();
});

function addProject() {
    const formData = new FormData();
    formData.append("title", document.getElementById("projectTitle").value);
    formData.append("description", document.getElementById("projectDescription").value);
    formData.append("technologiesUsed", document.getElementById("techInput").value);
    formData.append("url", document.getElementById("projectLink").value);
    formData.append("github", document.getElementById("githubLink").value);
    
    const image = document.getElementById("projectImage");
    if (image.files[0]) {
        formData.append("image", image.files[0]);
    }

    fetch("../api/project_api.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === "success") {
            alert("Project added successfully!");
            window.location.reload();
        }
    })
    .catch(error => console.error(error));
}

function getProjects(){
    fetch("../api/project_api.php")
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            document.getElementById("projectsGridId").innerHTML = "";

            data.projects.forEach(project => {
                const technologies = project.technologies_used ? project.technologies_used.split(',').map(tech => tech.trim()) : [];
                const techSpans = technologies.map(tech => `<span class="tech-tag">${tech}</span>`).join('');

                document.getElementById("projectsGridId").innerHTML += `
                    <div class="project-card">
                        <div class="project-image">
                            <img src="../Uploads/${project.image}" alt="${project.title}">
                        </div>
                        <div class="project-info">
                            <h4>${project.title}</h4>
                            <p class="project-description">${project.description}</p>
                            <div class="project-tech">
                                ${techSpans}
                            </div>
                        </div>
                        <div class="card-actions">
                            <button class="btn-icon edit"><i class="fas fa-edit"></i></button>
                            <button class="btn-icon delete"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>
                `;
            });
        }
    })
    .catch(error => console.error(error));
}