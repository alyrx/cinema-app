function openDropdown() {
    clearTimeout();
    
    const dropdownMenu = document.getElementById('user-dropdown-menu');
    dropdownMenu.style.visibility = "visible";
}

function closeDropdown() {
    setTimeout(() => {
        const dropdownMenu = document.getElementById('user-dropdown-menu');
        dropdownMenu.style.visibility = "hidden"; 
    }, 300);
}