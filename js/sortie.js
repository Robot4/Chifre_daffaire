    // Get references to the button and form
    const showFormButton = document.getElementById('showFormButton');
    const addClientForm = document.getElementById('addClientForm');

    // Add a click event listener to the button
    showFormButton.addEventListener('click', function () {
    // Toggle the form's visibility
    if (addClientForm.style.display === 'none' || addClientForm.style.display === '') {
    addClientForm.style.display = 'block';
} else {
    addClientForm.style.display = 'none';
}
});
