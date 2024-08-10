document.addEventListener("DOMContentLoaded", function() {
    // Get form element
    const generateForm = document.getElementById("generateForm");

    // Add event listener for form submission
    generateForm.addEventListener("submit", function(event) {
        event.preventDefault();

        // Get min and max values from form input
        const min = document.getElementById("min").value;
        const max = document.getElementById("max").value;

        // Send form data to server using Fetch API
        fetch("generate.php", {
            method: "POST",
            body: new URLSearchParams({
                min: min,
                max: max
            }),
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            }
        })
        .then(response => response.json())
        .then(data => {
            // Display generated random number
            document.getElementById("result").innerText = `Generated Number: ${data.number}`;
        })
        .catch(error => {
            console.error("Error:", error);
        });
    });
});
