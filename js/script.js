// Check for saved theme on page load and apply it

window.onload = () => {
    const savedTheme = localStorage.getItem('theme') || 'blue';
    document.body.classList.add(savedTheme);
};


// Function to toggle between 'blue' and 'red' themes

function toggleTheme() {
    const body = document.body;
    const currentTheme = body.classList.contains('blue') ? 'blue' : 'red';
    const newTheme = currentTheme === 'blue' ? 'red' : 'blue';

    // Toggle theme class on body
    body.classList.replace(currentTheme, newTheme);

    // Save the selected theme to localStorage
    localStorage.setItem('theme', newTheme);
}


// Add event listener to the theme toggle button
document.addEventListener('DOMContentLoaded', () => {
    const themeToggleButton = document.querySelector('button#theme-toggle');
    if (themeToggleButton) {
        themeToggleButton.addEventListener('click', toggleTheme);
    }
});

// Function to render action links based on user session status
async function renderActionLinks(id) {
    try {
        const response = await fetch('check_session.php');
        const data = await response.json();

        if (data.loggedIn) {
            return `
                <td>
                    <a name="editBtn" href="editCD.php?id=${id}" class="btn edit">Edit</a>
                    <a href="deleteCD.php?id=${id}" class="btn delete">Delete</a>
                </td>
            `;
        } else {
            return ``;
        }
    } catch (error) {
        console.error('Error:', error);
        return ``;
    }
}


// Function to format time in minutes:seconds format
function formatTime(seconds) {
    if (seconds < 0) {
        throw new Error('Seconds must be a non-negative integer');
    }

    const minutes = Math.floor(seconds / 60);
    const remainingSeconds = seconds % 60;

    // Format minutes and seconds with leading zeros
    return `${String(minutes).padStart(2, '0')}:${String(remainingSeconds).padStart(2, '0')}`;
}

// Function to render CDs with pagination
async function renderCDs(page) {
    const tbody = document.querySelector('tbody#cd-table');
    tbody.innerHTML = ''; // Clear current content

    const start = (page - 1) * limit;
    const end = start + limit;
    const paginatedCDs = cds.slice(start, end);

    for (const cd of paginatedCDs) {
        const row = document.createElement('tr');
        const formattedTime = formatTime(cd.length);
        
        // Fetch action links asynchronously
        const actionLinks = await renderActionLinks(cd.id);

        // Populate table row
        row.innerHTML = `
            <td>${cd.title}</td>
            <td>${formattedTime}</td>
            <td>${cd.author}</td>
            <td>${cd.release_date}</td>
            ${actionLinks}
        `;
        
        tbody.appendChild(row);
    }
}

// Function to render pagination
function renderPagination() {
    const pagination = document.querySelector('div#pagination');
    pagination.innerHTML = ''; // Clear current content

    const totalPages = Math.ceil(cds.length / limit);

    for (let i = 1; i <= totalPages; i++) {
        const link = document.createElement('a');
        link.href = '#';
        link.innerText = i;
        link.className = (i === currentPage) ? 'active' : '';

        link.onclick = (e) => {
            e.preventDefault();
            currentPage = i;
            renderCDs(currentPage);
            renderPagination(); // Re-render pagination after changing page
        };

        pagination.appendChild(link);
    }
}



function showSnackbar() {
    // Get the snackbar DIV
    var snackbar = document.getElementById("snackbar");

    // Add the "show" class to DIV
    snackbar.className = "show";

    snackbar.className = snackbar.className.replace("show", "");
    // After 3 seconds, remove the show class and hide the snackbar
    //setTimeout(function() {
        
   // }, 3000);
}