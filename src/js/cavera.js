//NAO MEXER

function clearFilters() {
    document.querySelector('input[name="searchUser"]').value = '';
}

document.querySelector('form').addEventListener('submit', function(event) {
    event.preventDefault();
    const inputField = document.querySelector('input[name="searchUser"]');
    if (inputField.value.trim() !== "") {
        this.submit(); 
    }
});