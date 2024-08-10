document.addEventListener("DOMContentLoaded", () => {
  const tabs = document.querySelectorAll("nav ul li a");
  const tabContents = document.querySelectorAll(".tab-content");
  const modal = document.getElementById("modal");
  const closeBtn = document.querySelector(".close-btn");
  const modalForm = document.getElementById("modal-form");
  const profileInfo = document.getElementById("profile-info");
  const updateLog = document
    .getElementById("update-log")
    .querySelector("tbody");

  // Sample data for profile and logs
  const profileData = {
    name: "Admin User",
    email: "admin@example.com",
    role: "Administrator",
  };

  const updateLogs = [
    {
      date: "2024-07-31 12:00",
      admin: "Admin User",
      type: "Added Product",
      details: "Added new laptop",
    },
    {
      date: "2024-07-31 13:00",
      admin: "Admin User",
      type: "Edited User",
      details: "Updated user role",
    },
  ];

  // Initialize profile and logs
  function initializeProfile() {
    profileInfo.innerHTML = `
          <p><strong>Name:</strong> ${profileData.name}</p>
          <p><strong>Email:</strong> ${profileData.email}</p>
          <p><strong>Role:</strong> ${profileData.role}</p>
      `;
  }

  function initializeUpdateLog() {
    updateLog.innerHTML = updateLogs
      .map(
        (log) => `
          <tr>
              <td>${log.date}</td>
              <td>${log.admin}</td>
              <td>${log.type}</td>
              <td>${log.details}</td>
          </tr>
      `
      )
      .join("");
  }

  initializeProfile();
  initializeUpdateLog();

  tabs.forEach((tab) => {
    tab.addEventListener("click", (e) => {
      e.preventDefault();
      const targetId = e.target.id.split("-")[0] + "-section";

      // Remove active class from all tabs
      tabs.forEach((tab) => tab.classList.remove("active"));

      // Hide all tab contents
      tabContents.forEach((content) => (content.style.display = "none"));

      // Show the clicked tab content and add active class
      document.getElementById(targetId).style.display = "block";
      e.target.classList.add("active");
    });
  });

  document
    .getElementById("add-product-btn")
    .addEventListener("click", () => openModal("Product"));
  document
    .getElementById("add-category-btn")
    .addEventListener("click", () => openModal("Category"));
  document
    .getElementById("add-user-btn")
    .addEventListener("click", () => openModal("User"));
  document
    .getElementById("edit-profile-btn")
    .addEventListener("click", () => openModal("Profile"));

  closeBtn.addEventListener("click", () => closeModal());

  modalForm.addEventListener("submit", (e) => {
    e.preventDefault();
    // Handle form submission logic here
    closeModal();
  });

  function openModal(type) {
    document.getElementById("modal-title").innerText = `Add/Edit ${type}`;
    // Populate modal form based on the type
    modal.style.display = "block";
  }

  function closeModal() {
    modal.style.display = "none";
  }

  // Initialize default view
  document.getElementById("products-tab").click();
});
