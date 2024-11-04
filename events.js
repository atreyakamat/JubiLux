document.addEventListener("DOMContentLoaded", function() {
    const eventForm = document.getElementById("eventForm");

    eventForm.addEventListener("submit", function(event) {
        const eventName = document.getElementById("event_name").value.trim();
        const eventDescription = document.getElementById("event_description").value.trim();
        const eventDate = document.getElementById("event_date").value;
        const eventLocation = document.getElementById("event_location").value.trim();
        const eventImage = document.getElementById("event_image").files[0];

        if (eventName === "" || eventDescription === "" || eventLocation === "" || !eventDate) {
            alert("Please fill out all required fields.");
            event.preventDefault(); 
            return;
        }

        if (!eventImage) {
            alert("Please upload an event image.");
            event.preventDefault(); 
            return;
        }

        const validImageTypes = ["image/jpeg", "image/png", "image/gif"];
        if (!validImageTypes.includes(eventImage.type)) {
            alert("Please upload a valid image (JPEG, PNG, or GIF).");
            event.preventDefault(); 
            return;
        }

    });
});
