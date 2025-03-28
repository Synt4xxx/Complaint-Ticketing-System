import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();



document.addEventListener("DOMContentLoaded", function () {
    // Hide loader on page load
    const loader = document.getElementById("loader");
    if (loader) {
        loader.style.display = "none";
    }

    // Show loader on link click
    document.querySelectorAll("a").forEach(link => {
        link.addEventListener("click", function () {
            if (loader) {
                loader.style.display = "flex";
            }
        });
    });
});
// Tailwind Configuration
window.tailwind = window.tailwind || {};
tailwind.config = {
    darkMode: "class",
    theme: {
        extend: {
            animation: {
                "fade-in": "fadeIn 0.3s ease-in-out",
                "fade-out": "fadeOut 0.3s ease-in-out",
            },
        },
    },
};

// Initialize theme based on localStorage or system preference
function initializeTheme() {
    if (
        localStorage.theme === "dark" ||
        (!("theme" in localStorage) && window.matchMedia("(prefers-color-scheme: dark)").matches)
    ) {
        document.documentElement.classList.add("dark");
    } else {
        document.documentElement.classList.remove("dark");
    }
    updateThemeIcons();
}

// Update theme icons visibility
function updateThemeIcons() {
    const sunIcon = document.querySelector(".sun-icon");
    const moonIcon = document.querySelector(".moon-icon");
    const isDark = document.documentElement.classList.contains("dark");

    if (sunIcon && moonIcon) {
        sunIcon.classList.toggle("hidden", !isDark);
        moonIcon.classList.toggle("hidden", isDark);
    }
}
function openAssignModal(complaintId) {
    document.getElementById('complaint_id').value = complaintId;

    // Update form action dynamically
    let form = document.getElementById('assignForm');
    form.action = `/admin/complaints/${complaintId}/assign`;

    document.getElementById('assignModal').classList.remove('hidden');
}

function closeAssignModal() {
    document.getElementById('assignModal').classList.add('hidden');
}

document.addEventListener('DOMContentLoaded', function () {
    let assignForm = document.getElementById('assignForm');
    if (assignForm) {
        assignForm.addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent form from reloading the page

            let complaintId = document.getElementById('complaint_id').value;
            let supportId = document.getElementById('support_id').value;
            let formData = new FormData();
            formData.append('_token', document.querySelector('input[name="_token"]').value);
            formData.append('support_id', supportId);

            fetch(`/admin/complaints/${complaintId}/assign`, {
                method: 'POST',
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest' } // Identify as an AJAX request
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("✅ Complaint assigned successfully!");

                        // Update the UI dynamically
                        let row = document.querySelector(`tr[data-complaint-id="${complaintId}"]`);
                        if (row) {
                            row.querySelector(".status").innerHTML = `<span class="px-3 py-1 text-xs font-semibold bg-green-100 text-green-800 rounded-full">Assigned</span>`;
                            row.querySelector(".support-staff").innerText = data.support_name;
                        }

                        closeAssignModal();
                    } else {
                        alert("❌ " + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert("❌ Something went wrong!");
                });
        });
    }
});

