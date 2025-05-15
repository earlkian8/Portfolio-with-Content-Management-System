document.addEventListener("DOMContentLoaded", function(){
    document.getElementById("addServiceButton").addEventListener("click", function(event){
        event.preventDefault();
        document.getElementById("serviceModal").classList.add("show");
    });

    document.getElementById("serviceModal").addEventListener("submit", function(event){
        event.preventDefault();
        addServices();
    });

    getServices();
});

function addServices(){
    const formData = {
        name: document.getElementById("serviceTitle").value,
        description: document.getElementById("serviceDescription").value
    }
    fetch("../api/service_api.php", {
        method: "POST",
        body: JSON.stringify(formData),
        headers: {"Content-Type": "application/json"}
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            alert("Added Successfully!");
            window.location.reload();
        }
    })
    .catch(error => console.error(error));
}

function getServices(){
    fetch("../api/service_api.php")
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            document.getElementById("servicesGridId").innerHTML = "";
            data.services.forEach(s => {
                document.getElementById("servicesGridId").innerHTML += `
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-laptop-code"></i>
                        </div>
                        <div class="service-info">
                            <h4>${s.name}</h4>
                            <p class="service-description">${s.description}</p>
                        </div>
                        <div class="card-actions">
                            <button class="btn-icon edit" data-id="${s.service_id}"><i class="fas fa-edit"></i></button>
                            <button class="btn-icon delete" data-id="${s.service_id}"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>
                `;
            });

            document.querySelectorAll(".btn-icon.edit").forEach(button => {
                button.addEventListener("click", function(event){
                    event.preventDefault();
                    const sId = this.getAttribute("data-id");
                    const sData = data.services.find(s => s.service_id == sId);
                    if(sData){
                        document.getElementById("editServiceModal").classList.add("show");

                        document.getElementById("editServiceClose").addEventListener("click", function(event){
                            event.preventDefault();
                            document.getElementById("editServiceModal").classList.remove("show");
                        });

                        document.getElementById("editServiceTitle").value = sData.name;
                        document.getElementById("editServiceDescription").value = sData.description;

                        document.getElementById("editServiceModal").addEventListener("submit", function(event){
                            event.preventDefault();
                            editServices(sData.service_id);
                        });
                    }
                });
            });

            document.querySelectorAll(".btn-icon.delete").forEach(button => {
                button.addEventListener("click", function(event){
                    event.preventDefault();
                    const sId = this.getAttribute("data-id");
                    deleteServices(sId);
                });
            });
        }
    })
    .catch(error => console.error(error));
}

function editServices(id){
    const formData = {
        serviceId: Number(id),
        name: document.getElementById("editServiceTitle").value,
        description: document.getElementById("editServiceDescription").value
    }
    fetch("../api/service_api.php", {
        method: "PUT",
        body: JSON.stringify(formData),
        headers: {"Content-Type": "application/json"}
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            alert("Updated Successfully!");
            window.location.reload();
        }
    })
    .catch(error => console.error(error));
}

function deleteServices(id){
    const formData = {
        serviceId: Number(id)
    }
    fetch("../api/service_api.php", {
        method: "DELETE",
        body: JSON.stringify(formData),
        headers: {"Content-Type": "application/json"}
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            alert("Deleted Successfully!");
            window.location.reload();
        }
    })
    .catch(error => console.error(error));
}