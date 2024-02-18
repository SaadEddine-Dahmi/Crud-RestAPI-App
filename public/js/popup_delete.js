// // popup question before deleting items
// function showPopup() {
//     var popupContainer = document.getElementById("popup");
//     let body = document.body;

//     popupContainer.innerHTML = `
//     <div class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2  max-w-sm p-6 bg-white rounded-md shadow-2xl z-50">
//         <h3 class="text-2xl font-bold">Are you sure you want to delete this item?</h3>
//         <div class="mt-4 flex justify-end">
//             <button onclick="confirmDelete()" class="mr-2 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
//                 Delete
//             </button>
//             <button onclick="cancelDelete()" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
//                 Cancel
//             </button>
//         </div>
//     </div>
//   `;
//     popupContainer.classList.remove("hidden");
//     popupContainer.style.overflow = "";
//     popupContainer.style.pointerEvents = "auto";
//     body.style.overflow = "hidden";
//     body.style.pointerEvents = "none";
// }

// function hidePopup() {
//     document.getElementById("popup").classList.add("hidden");
//     // popupContainer.style.overflow = "";
//     // popupContainer.style.pointerEvents = "auto";
//     body.style.overflow = "";
//     body.style.pointerEvents = "auto";
//     body.classList.remove("blurred");
// }

// function cancelDelete() {
//     hidePopup();
//     // Add any additional logic for cancel action here
// }

// function confirmDelete() {
//     // Replace 'GET_YOUR_ROW_ID_LOGIC' with the logic to get the ID from your data

//     // Construct the URL with the ID
//     var deleteUrl = "../inc/delete.php?id=" + rowId;

//     // Redirect to the delete URL
//     window.location.href = deleteUrl;
//     hidePopup();
//     // Add any additional logic for delete action here
// }

document.addEventListener("DOMContentLoaded", function () {
    const deleteButtons = document.querySelectorAll(".delete-button");
    const popup = document.getElementById("popup");
    const confirmDeleteBtn = document.getElementById("confirmDeleteBtn");
    const cancelDeleteBtn = document.getElementById("cancelDeleteBtn");

    deleteButtons.forEach((deleteButton) => {
        deleteButton.addEventListener("click", function () {
            const itemId = deleteButton.dataset.itemId;
            popup.classList.remove("hidden");
            document.body.style.overflow = "hidden";

            confirmDeleteBtn.addEventListener("click", function () {
                confirmDelete(itemId);
            });

            cancelDeleteBtn.addEventListener("click", function () {
                popup.classList.add("hidden");
                document.body.style.overflow = "";
            });
        });
    });

    function confirmDelete(itemId) {
        const deleteUrl = "/items/" + itemId;

        fetch(deleteUrl, {
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
                "Content-Type": "application/json",
            },
        })
            .then((response) => {
                if (response.ok) {
                    console.log("Item deleted successfully");
                    // Add any additional logic for successful deletion
                } else {
                    console.error("Failed to delete item");
                    // Handle deletion failure, e.g., show an error message
                }
            })
            .catch((error) => {
                console.error("Error:", error);
                // Handle other errors, e.g., show an error message
            })
            .finally(() => {
                popup.classList.add("hidden");
                document.body.style.overflow = "";
            });
    }
});
