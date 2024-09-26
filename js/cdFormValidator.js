
// Form validation function

function validateCDForm() {
   const titleBox = document.querySelector("input#title");
    const secondsBox = document.querySelector("input#seconds");
    const minutesBox = document.querySelector("input#minutes");
    const authorBox = document.querySelector("input#author");
    const releaseDateBox = document.querySelector("input#release_date");

    const title = titleBox.value;
    const seconds = parseInt(secondsBox.value, 10);
    const minutes = parseInt(minutesBox.value, 10);
    const author = authorBox.value;
    const releaseDate = releaseDateBox.value;
    
    const errorMessageTitle = document.querySelector("div#error-title");
    const errorMessageSeconds = document.querySelector("div#error-seconds");
    const errorMessageAuthor = document.querySelector("div#error-author");
    const errorMessageReleaseDate = document.querySelector("div#error-date");

    errorMessageTitle.innerText = "";
    errorMessageSeconds.innerText = "";
    errorMessageAuthor.innerText = "";
    errorMessageReleaseDate.innerText = "";

    titleBox.classList.remove("error-input");
    secondsBox.classList.remove("error-input");
    minutesBox.classList.remove("error-input");
    authorBox.classList.remove("error-input");
    releaseDateBox.classList.remove("error-input");

    // Validate title length
    if (title.length < 1 || title.length > 100) {
        errorMessageTitle.innerText = "Title must be between 1 and 100 characters.\n";
        titleBox.classList.add("error-input");
        return false;
    }

    // Validate seconds and minutes together
    if (minutes > 0 && seconds === 0) {
        // Allow seconds to be 0 if minutes is greater than 0
    } else if (seconds <= 0 || seconds >= 60) {
        errorMessageSeconds.innerText = "Seconds must be between 1 and 59 unless minutes are greater than 0.";
        secondsBox.classList.add("error-input");
        return false;
    }

    // Validate author length
    if (author.length < 1 || author.length > 100) {
        errorMessageAuthor.innerText = "Author must be between 1 and 100 characters.\n";
        authorBox.classList.add("error-input");
        return false;
    }

    // Validate release date
    const releaseDateObj = new Date(releaseDate); // Convert to Date object
    const currentDate = new Date(); // Get current date

    // Check if the releaseDate is valid
    if (isNaN(releaseDateObj.getTime())) { // Check if releaseDate is a valid date
        errorMessageReleaseDate.innerText = "Please enter a valid release date.";
        releaseDateBox.classList.add("error-input");
        return false;
    }

    const releaseYear = releaseDateObj.getFullYear();

    // Validate year and date range
    if (releaseYear <= 1948 || releaseDateObj >= currentDate) {
        errorMessageReleaseDate.innerText = "Release date must be after 1948 and before curent date."; // First vinyls were invented in 1948, now vinyls aren't CD's but they are a release of some kind that is able to be sold in mass. So released vinyl in CD version isn't the first release for me.
        releaseDateBox.classList.add("error-input");
        return false;
    }

    return true;
    
}



// Validate CD Form

const cdForm = document.querySelector("form#cd");
cdForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    const isValid = await validateCDForm();
    if(isValid) {
        cdForm.submit();
    }
});

