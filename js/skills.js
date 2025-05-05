document.addEventListener("DOMContentLoaded", function(){

    // Open Skill Modal
    document.getElementById("addSkillButton").addEventListener("click", function(event){
        event.preventDefault();
        document.getElementById("skillModal").classList.add("show");
    });

    // Close Skill Modal
    document.getElementById("skillClose").addEventListener("click", function(event){
        event.preventDefault();
        document.getElementById("skillModal").classList.remove("show");
    });

    // Close Skill Modal Cancel
    document.getElementById("skillCancel").addEventListener("click", function(event){
        event.preventDefault();
        document.getElementById("skillModal").classList.remove("show");
    });

    // Open Education Modal
    document.getElementById("addEducationButton").addEventListener("click", function(event){
        event.preventDefault();
        document.getElementById("educationModal").classList.add("show");
    });

    // Close Education Modal
    document.getElementById("educationClose").addEventListener("click", function(event){
        event.preventDefault();
        document.getElementById("educationModal").classList.remove("show");
    });

    // Close Education Modal Cancel
    document.getElementById("cancelEducation").addEventListener("click", function(event){
        event.preventDefault();
        document.getElementById("educationModal").classList.remove("show");
    });

    // Open Experience Modal
    document.getElementById("addExperienceButton").addEventListener("click", function(event){
        event.preventDefault();
        document.getElementById("experienceModal").classList.add("show");
    });

    //Close Experience Modal
    document.getElementById("experienceClose").addEventListener("click", function(event){
        event.preventDefault();
        document.getElementById("experienceModal").classList.remove("show");
    });

    // Close Experience Modal Cancel
    document.getElementById("experienceCancel").addEventListener("click", function(event){
        event.preventDefault();
        document.getElementById("experienceModal").classList.remove("show");
    });

    getSkill();
    getProgramming();
    getEducation();
    getExperience();

    // Add Programming
    document.getElementById("skillModal").addEventListener("submit", function(){
        addProgramming();
    });

    // Add Education
    document.getElementById("educationModal").addEventListener("submit", function(){
        addEducation();
    });

    // Add Experience
    document.getElementById("experienceModal").addEventListener("submit", function(){
        addExperience();
    });

});

function getSkill(){
    fetch("../api/admin_skills_api.php", {
        method: "GET",
        headers: {"Content-Type": "application/json"}
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            const skillData = data.skills;
            document.getElementById("skillsId").value = skillData.skills_id;
            document.getElementById("technicalSkillsDescription").value = skillData.description;
            document.getElementById("projectsCompleted").value = skillData.project_completed;
            document.getElementById("clientsServed").value = skillData.clients_served;
            document.getElementById("yearsExperience").value = skillData.years_experience;

            document.getElementById("saveChangesId").addEventListener("click", function(){
                updateSkill();
                location.reload();
            });
        }
    })
    .catch(error => console.error(error));
}

function updateSkill(){
    const formData = {
        id: Number(document.getElementById("skillsId").value),
        description: document.getElementById("technicalSkillsDescription").value,
        projectCompleted: document.getElementById("projectsCompleted").value,
        clientsServed: document.getElementById("clientsServed").value,
        yearsExperience: document.getElementById("yearsExperience").value
    }
    fetch("../api/admin_skills_api.php", {
        method: "POST",
        body: JSON.stringify(formData),
        headers: {"Content-Type": "application/json"}
    })
    .then(response => response.json())
    .then(data =>{

    })
    .catch(error => console.error(error));
}

function getProgramming(){
    fetch("../api/admin_programming_api.php", {
        method: "GET",
        headers: {"Content-Type": "application/json"}
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            document.getElementById("cardsGridId").innerHTML = "";
            data.programmings.forEach(programming =>{
                document.getElementById("cardsGridId").innerHTML += `
                    <div class="skill-card">
                        <div class="skill-icon"><i class="${programming.icon_class}"></i></div>
                        <div class="skill-name">${programming.name}</div>
                        <div class="card-actions">
                            <button class="btn-icon edit" data-id="${programming.programming_id}"><i class="fas fa-edit"></i></button>
                            <button class="btn-icon delete" data-id="${programming.programming_id}"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>
                `;
            });

            document.querySelectorAll(".btn-icon.edit").forEach(button =>{
                button.addEventListener("click", function(event){
                    event.preventDefault();
                    const programmingId = this.getAttribute("data-id");
                    const programmingData = data.programmings.find(p => p.programming_id == programmingId);
                    if(programmingData){
                        // Store Their Value
                        document.getElementById("editSkillId").value = programmingData.programming_id;
                        document.getElementById("editSkillName").value = programmingData.name;
                        document.getElementById("editSkillIcon").value = programmingData.icon_class;

                        // Open Edit Modal
                        document.getElementById("editSkillModal").classList.add("show");

                        // Close Modal
                        document.getElementById("editSkillClose").addEventListener("click", function(event){
                            event.preventDefault();
                            document.getElementById("editSkillModal").classList.remove("show");
                        });
                        document.getElementById("editSkillCancel").addEventListener("click", function(event){
                            event.preventDefault();
                            document.getElementById("editSkillModal").classList.remove("show");
                        });

                        // Edit Programming
                        document.getElementById("editSkillModal").addEventListener("submit", function(){
                            updateProgramming();
                        });
                    }
                });
            });

            // Delete Programming
            document.querySelectorAll(".btn-icon.delete").forEach(button =>{
                button.addEventListener("click", function(event){
                    event.preventDefault();
                    const programmingId = this.getAttribute("data-id");
                    const programmingData = data.programmings.find(p => p.programming_id == programmingId);
                    if(programmingData){
                       deleteProgramming(programmingData);
                       location.reload();
                    }
                });
            });
        }
    })
    .catch(error => console.error(error));
}

function addProgramming(){
    const formData = {
        name: document.getElementById("skillName").value,
        iconClass: document.getElementById("skillIcon").value
    }
    fetch("../api/admin_programming_api.php", {
        method: "POST",
        body: JSON.stringify(formData),
        headers: {"Content-Type": "application/json"}
    })
    .then(response => response.json())
    .then(data => {

    })
    .catch(error => console.error(error));
}

function updateProgramming(){
    const formData = {
        id: Number(document.getElementById("editSkillId").value),
        name: document.getElementById("editSkillName").value,
        iconClass: document.getElementById("editSkillIcon").value
    }
    fetch("../api/admin_programming_api.php", {
        method: "PUT",
        body: JSON.stringify(formData),
        headers: {"Content-Type": "application/json"}
    })
    .then(response => response.json())
    .then(data => {

    })
    .catch(error => console.error(error));
}

function deleteProgramming(programmingData){
    const formData = {
        id: programmingData.programming_id,
    }
    fetch("../api/admin_programming_api.php", {
        method: "DELETE",
        body: JSON.stringify(formData),
        headers: {"Content-Type": "application/json"}
    })
    .then(response => response.json())
    .then(data => {

    })
    .catch(error => console.error(error));
}

function getEducation(){
    fetch("../api/admin_education_api.php", {
        method: "GET",
        headers: {"Content-Type": "application/json"}
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            document.getElementById("educationCardsId").innerHTML = "";

            data.educations.forEach(education => {
                document.getElementById("educationCardsId").innerHTML += `
                    <div class="education-card">
                        <div class="education-info">
                            <h4>${education.degree}</h4>
                            <p class="institution">${education.institution}</p>
                            <p class="period">${education.start_year} - ${education.end_year}</p>
                            <p class="description">${education.description}</p>
                        </div>
                        <div class="card-actions">
                            <button class="btn-icon edit" data-id="${education.education_id}"><i class="fas fa-edit"></i></button>
                            <button class="btn-icon delete" data-id="${education.education_id}"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>
                `;
            });

            document.querySelectorAll(".btn-icon.edit").forEach(button =>{
                button.addEventListener("click", function(event){
                    event.preventDefault();
                    const educationId = this.getAttribute("data-id");
                    const educationData = data.educations.find(e => e.education_id == educationId);
                    if(educationData){
                        // Store Their Value
                        document.getElementById("editEduId").value = educationData.education_id;
                        document.getElementById("editEduDegree").value = educationData.degree;
                        document.getElementById("editEduInstitution").value = educationData.institution;
                        document.getElementById("editEduStartYear").value = educationData.start_year;
                        document.getElementById("editEduEndYear").value = educationData.end_year;
                        document.getElementById("editEduDescription").value = educationData.description;

                        // Open Edit Modal
                        document.getElementById("editEducationModal").classList.add("show");

                        // Close Modal
                        document.getElementById("editEducationClose").addEventListener("click", function(event){
                            event.preventDefault();
                            document.getElementById("editEducationModal").classList.remove("show");
                        });
                        document.getElementById("editEducationCancel").addEventListener("click", function(event){
                            event.preventDefault();
                            document.getElementById("editEducationModal").classList.remove("show");
                        });

                        // Edit Education
                        document.getElementById("editEducationModal").addEventListener("submit", function(){
                            updateEducation();
                        });
                    }
                });
            });

            document.querySelectorAll(".btn-icon.delete").forEach(button => {
                button.addEventListener("click", function(event){
                    event.preventDefault();
                    const educationId = this.getAttribute("data-id");
                    const educationData = data.educations.find(e => e.education_id == educationId);
                    if(educationData){
                        deleteEducation(educationData);
                        location.reload();
                    }
                });
            });
        }
    })
    .then(error => console.error(error));
}

function addEducation(){
    const formData = {
        degree: document.getElementById("eduTitle").value,
        institution: document.getElementById("eduInstitution").value,
        startYear: document.getElementById("eduStartYear").value,
        endYear: document.getElementById("eduEndYear").value,
        description: document.getElementById("eduDescription").value
    }
    fetch("../api/admin_education_api.php", {
        method: "POST",
        body: JSON.stringify(formData),
        headers: {"Content-Type": "application/json"}
    })
    .then(response => response.json())
    .then(data => {

    })
    .catch(error => console.error(error));
}

function updateEducation(){
    const formData = {
        id: Number(document.getElementById("editEduId").value),
        degree: document.getElementById("editEduDegree").value,
        institution: document.getElementById("editEduInstitution").value,
        startYear: document.getElementById("editEduStartYear").value,
        endYear: document.getElementById("editEduEndYear").value,
        description: document.getElementById("editEduDescription").value
    }
    fetch("../api/admin_education_api.php", {
        method: "PUT",
        body: JSON.stringify(formData),
        headers: {"Content-Type": "application/json"}
    })
    .then(response => response.json())
    .then(data => {

    })
    .catch(error => console.error(error));
}

function deleteEducation(educationData){
    const formData = {
        id: educationData.education_id,
    }
    fetch("../api/admin_education_api.php", {
        method: "DELETE",
        body: JSON.stringify(formData),
        headers: {"Content-Type": "application/json"}
    })
    .then(response => response.json())
    .then(data => {

    })
    .catch(error => console.error(error));
}

function getExperience(){
    fetch("../api/admin_experience_api.php", {
        method: "GET",
        headers: {"Content-Type": "application/json"}
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            document.getElementById("experienceCardsId").innerHTML = "";
            data.experiences.forEach(experience => {
                document.getElementById("experienceCardsId").innerHTML += `
                    <div class="experience-card">
                        <div class="experience-info">
                            <h4>${experience.position}</h4>
                            <p class="company">${experience.company}</p>
                            <p class="period">${experience.start_year} - ${experience.end_year}</p>
                            <p class="description">${experience.description}</p>
                        </div>
                        <div class="card-actions">
                            <button class="btn-icon edit" data-id="${experience.experience_id}"><i class="fas fa-edit"></i></button>
                            <button class="btn-icon delete" data-id="${experience.experience_id}"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>
                `;
            });

            document.querySelectorAll(".btn-icon.edit").forEach(button =>{
                button.addEventListener("click", function(event){
                    event.preventDefault();
                    const experienceId = this.getAttribute("data-id");
                    const experienceData = data.experiences.find(e => e.experience_id == experienceId);
                    if(experienceData){
                        // Add Their Values
                        document.getElementById("editExperienceId").value = experienceData.experience_id;
                        document.getElementById("editExpTitle").value = experienceData.position;
                        document.getElementById("editExpCompany").value = experienceData.company;
                        document.getElementById("editExpStartYear").value = experienceData.start_year;
                        document.getElementById("editExpEndYear").value = experienceData.end_year;
                        document.getElementById("editExpDescription").value = experienceData.description;

                        // Show Modal
                        document.getElementById("editExperienceModal").classList.add("show");

                        // Update Experience
                        document.getElementById("editExperienceModal").addEventListener("submit", function(){
                            updateExperience();
                        });
                    }
                });
            });

            document.querySelectorAll(".btn-icon.delete").forEach(button =>{
                button.addEventListener("click", function(event){
                    event.preventDefault();
                    const experienceId = this.getAttribute("data-id");
                    const experienceData = data.experiences.find(e => e.experience_id == experienceId);
                    if(experienceData){
                        deleteExperience(experienceData);
                        location.reload();
                    }
                });
            });
        }
    })
    .catch(error => console.error(error));
}

function addExperience(){
    const formData = {
        position: document.getElementById("expTitle").value,
        company: document.getElementById("expCompany").value,
        startYear: document.getElementById("expStartYear").value,
        endYear: document.getElementById("expEndYear").value,
        description: document.getElementById("expDescription").value
    }
    fetch("../api/admin_experience_api.php", {
        method: "POST",
        body: JSON.stringify(formData),
        headers: {"Content-Type": "application/json"}
    })
    .then(response => response.json())
    .then(data => {

    })
    .catch(error => console.error(error));
}

function updateExperience(){
    const formData = {
        id: Number(document.getElementById("editExperienceId").value),
        position: document.getElementById("editExpTitle").value,
        company: document.getElementById("editExpCompany").value,
        startYear: document.getElementById("editExpStartYear").value,
        endYear: document.getElementById("editExpEndYear").value,
        description: document.getElementById("editExpDescription").value
    }
    fetch("../api/admin_experience_api.php", {
        method: "PUT",
        body: JSON.stringify(formData),
        headers: {"Content-Type": "application/json"}
    })
    .then(response => response.json())
    .then(data => {

    })
    .catch(error => console.error(error));
}

function deleteExperience(experienceData){
    const formData = {
        id: experienceData.experience_id
    }
    fetch("../api/admin_experience_api.php", {
        method: "DELETE",
        body: JSON.stringify(formData),
        headers: {"Content-Type": "application/json"}
    })
    .then(response => response.json())
    .then(data => {

    })
    .catch(error => console.error(error));
}