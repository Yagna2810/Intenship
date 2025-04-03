let slider = document.querySelector('.slider');
let images = document.querySelectorAll('.slider img');
let currentIdx = 0;
const slideInterval = 3500; // Change this value to adjust slide interval

function nextSlide() {
  currentIdx = (currentIdx + 1) % images.length;
  updateSlider();
}

function updateSlider() {
  slider.style.transform = `translateX(${-currentIdx * 100}%)`;
}

setInterval(nextSlide, slideInterval);

// back to top

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    document.getElementById("myBtn").style.display = "block";
  } else {
    document.getElementById("myBtn").style.display = "none";
  }
}
function topFunction() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}


var searchResults = [
  { html: "achar masala-100g", content: "achar1.html" },
  { html: "achar masala-500g", content: "achar.hmtl" },
  { html: "red chilli powder-100g", content: "chilli1.html" },
  { html: "red chilli powder-500g", content: "chilli.html" },
  { html: "coriander cumin powder-100g ", content: "cc1.html" },
  { html: "coriander cumin powder-500g", content: "cc.html" },
  { html: "coriander powder-100g", content: "coriander1.html" },
  { html: "coriander powder-500g", content: "coriander.html" },
  { html: "garam masala-100g", content: "garam1.html" },
  { html: "garam masala-500g", content: "garam.html" },
  { html: "kumthi kashmiri chilli poweder-100g", content: "kashmiri1.html" },
  { html: "kumthi kashmiri chilli poweder-500g", content: "kashmiri.html" },
  { html: "turmeric powder-100g", content: "turmeric1.html" },
  { html: "turmeric powder-500g", content: "turmeric.html" },
];

function toggleSearch() {
  var searchForm = document.getElementById("search-form");
  searchForm.classList.toggle("hidden");
}

function performSearch() {
  var searchQuery = document.getElementById("search-query").value.toLowerCase();
  var searchResultsDiv = document.getElementById("search-results");

  // Clear previous results
  searchResultsDiv.innerHTML = '';

  // Filter results based on input
  var filteredResults = searchResults.filter(function(result) {
    return result.content.toLowerCase().startsWith(searchQuery);
  });

  // Populate search results
  if (searchQuery.trim() !== '' && filteredResults.length > 0) {
    filteredResults.forEach(function(result) {
      var resultElement = document.createElement('div');
      resultElement.classList.add('search-result');
      resultElement.innerHTML = result.html;
      resultElement.onclick = function() { goToResultPage(result.content); };
      searchResultsDiv.appendChild(resultElement);
    });
  } else {
    var messageElement = document.createElement('div');
    messageElement.textContent = "No suggestions found.";
    searchResultsDiv.appendChild(messageElement);
  }

  // Show search results
  searchResultsDiv.classList.remove('hidden');
}

function goToResultPage(query) {
  // Redirect to the result page with the query as a parameter
  window.location.href = "" + encodeURIComponent(query);
}




document.addEventListener("DOMContentLoaded", function () {
  let observer = new IntersectionObserver(
    function (entries) {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add("animate");
        }
      });
    },
    { threshold: 0.2 } // Trigger when 20% of the section is visible
  );

  let target = document.querySelector("#pure");
  if (target) observer.observe(target);
});
