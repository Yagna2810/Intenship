
function toggleSearch() {
    var searchForm = document.getElementById("search-form");
    searchForm.classList.toggle("hidden");
  }

  function performSearch() {
    var searchQuery = document.getElementById("search-query").value.toLowerCase();
    var searchResults = document.getElementById("search-results");

    // Here you would typically make an AJAX request to your server with the searchQuery,
    // and then update the searchResults based on the response.
    // For demonstration purposes, let's just simulate some search results.

    // Simulated search results
    var results = ["Apple", "Banana", "Orange", "Pineapple", "Grapes", "Watermelon", "Strawberry", "Mango"];

    // Clear previous results
    searchResults.innerHTML = '';

    // Filter results based on input
    var filteredResults = results.filter(function(result) {
      return result.toLowerCase().startsWith(searchQuery);
    });

    // Populate search results
    if (searchQuery.trim() !== '' && filteredResults.length > 0) {
      filteredResults.forEach(function(result) {
        var resultElement = document.createElement('div');
        resultElement.classList.add('search-result');
        resultElement.textContent = result;
        resultElement.onclick = function() { fillSearch(result); };
        searchResults.appendChild(resultElement);
      });
    } else {
      var messageElement = document.createElement('div');
      messageElement.textContent = "No suggestions found.";
      searchResults.appendChild(messageElement);
    }

    // Show search results
    searchResults.classList.remove('hidden');
  }

  function fillSearch(query) {
    var searchInput = document.getElementById("search-query");
    searchInput.value = query;
    // Hide search results after selection
    var searchResults = document.getElementById("search-results");
    searchResults.classList.add('hidden');
  }