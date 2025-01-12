function validateForm() {
    const username = document.getElementById('username').value.trim();
    const password = document.getElementById('password').value.trim();
    
    if (!username || !password) {
        showError('Please fill in all fields');
        return false;
    }
    
    // Basic username validation
    if (username.length < 3) {
        showError('Username must be at least 3 characters long');
        return false;
    }
    
    // Basic password validation
    if (password.length < 6) {
        showError('Password must be at least 6 characters long');
        return false;
    }
    
    return true;
}

function showError(message) {
    const alertDiv = document.createElement('div');
    alertDiv.className = 'alert alert-danger alert-dismissible fade show';
    alertDiv.role = 'alert';
    alertDiv.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    `;
    
    // Remove any existing alerts
    const existingAlerts = document.querySelectorAll('.alert');
    existingAlerts.forEach(alert => alert.remove());
    
    // Add new alert at the top of the form
    const form = document.querySelector('form');
    form.parentNode.insertBefore(alertDiv, form);
}