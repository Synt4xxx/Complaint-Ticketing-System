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

// Tailwind Dark Mode Configuration
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

// Initialize Theme
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

// Update Theme Icons
function updateThemeIcons() {
    const sunIcon = document.querySelector(".sun-icon");
    const moonIcon = document.querySelector(".moon-icon");
    const isDark = document.documentElement.classList.contains("dark");

    if (sunIcon && moonIcon) {
        sunIcon.classList.toggle("hidden", !isDark);
        moonIcon.classList.toggle("hidden", isDark);
    }
}

// ✅ Fix `openAssignModal()` Not Defined
window.openAssignModal = function (complaintId) {
    console.log("🔹 openAssignModal() called with ID:", complaintId);

    let modal = document.getElementById('assignModal');
    let complaintInput = document.getElementById('complaint_id');
    let form = document.getElementById('assignForm');

    if (!modal || !complaintInput || !form) {
        console.error("❌ Modal, complaint input, or form not found.");
        return;
    }

    complaintInput.value = complaintId;
    form.action = `/admin/complaints/${complaintId}/assign`;
    
    modal.classList.remove('hidden');
};

// ✅ Close Modal Function
window.closeAssignModal = function () {
    let modal = document.getElementById('assignModal');
    if (modal) {
        modal.classList.add('hidden');
    }
};

// Handle Assign Form Submission
document.addEventListener('DOMContentLoaded', function () {
    let assignForm = document.getElementById('assignForm');
    if (assignForm) {
        assignForm.addEventListener('submit', function (event) {
            event.preventDefault();

            let complaintId = document.getElementById('complaint_id').value;
            let supportId = document.getElementById('support_id').value;
            let formData = new FormData();
            formData.append('_token', document.querySelector('input[name="_token"]').value);
            formData.append('support_id', supportId);

            fetch(`/admin/complaints/${complaintId}/assign`, {
                method: 'POST',
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest' } 
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("✅ Complaint assigned successfully!");
                    location.reload(); // Reload the page after assignment

                    let row = document.querySelector(`tr[data-complaint-id="${complaintId}"]`);
                    if (row) {
                        row.querySelector(".status").innerHTML = 
                            `<span class="px-3 py-1 text-xs font-semibold bg-green-100 text-green-800 rounded-full">Assigned</span>`;
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
