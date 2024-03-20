document.addEventListener("DOMContentLoaded", function() {
    var themeToggleButton = document.querySelector(".light-dark-mode");

    themeToggleButton.addEventListener("click", function() {
        var htmlElement = document.getElementsByTagName("html")[0];
        if (htmlElement.hasAttribute("data-layout-mode")) {
            var currentMode = htmlElement.getAttribute("data-layout-mode");
            console.log(currentMode)
            var newMode = currentMode === "dark" ? "light" : "dark";
            htmlElement.setAttribute("data-layout-mode", newMode);

            saveThemePreference(newMode);
            applyThemeChanges(newMode);
        }
    });
});

function saveThemePreference(themeMode) {
            var formData = new FormData();
            formData.append('themeMode', themeMode);

            fetch('/admin/save-theme-preference', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(formData)
            })

            console.log(body)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to save theme preference');
                }
                return response.json();
            })
            .then(data => {
                console.log('Theme preference saved:', data);
            })
            .catch(error => {
                console.error('Error saving theme preference:', error);
            });
        }
