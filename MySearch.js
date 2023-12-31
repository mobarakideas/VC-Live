const accessKey = "nzQuPMHRwMwEdigq6ILXw0hvc89fRH15DwX187IdXAU";
let myData = [];
const searchForm = document.getElementById("image-search-form"); // Updated id
const searchBox = document.getElementById("image-search-box"); // Updated id
const showMoreBtn = document.getElementById("more-btn"); // Updated id
const container = document.getElementById('image-grid-container'); // Updated id
let page = 1; // Track the page number
let keyword = "";

function fetchData() {
    keyword = searchBox.value;
    fetch(`https://api.unsplash.com/search/photos?page=${page}&query=${keyword}&client_id=${accessKey}&per_page=12`)
        .then((res) => res.json())
        .then((data) => {
            myData = data.results.map((item) => ({
                id: item.id,
                description: item.alt_description,
                imageUrl: item.urls.regular,
                user: {
                    username: item.user.username,
                    name: item.user.name,
                    portfolioUrl: item.user.portfolio_url,
                },
            }));
            updateHTML();
        })
        .catch((error) => console.log(error));
}

function updateHTML() {
    myData.forEach((item) => {
        const gridWrapper = document.createElement('div');
        gridWrapper.classList.add('image-item'); // Updated class

        const html = `<div>
                        <img src="${item.imageUrl}" alt="${item.description || 'not found'}">
                    </div>`;

        gridWrapper.innerHTML = html;
        container.appendChild(gridWrapper);
    });
}

function loadMore() {
    page++; // Increment the page number
    fetchData();
}

// Event listener for search form submission
searchForm.addEventListener('submit', function (e) {
    e.preventDefault();
    // Clear existing results
    container.innerHTML = '';
    // Reset page number
    page = 1;
    fetchData();
});

// Event listener for "Load More" button
showMoreBtn.addEventListener('click', function () {
    loadMore();
});
