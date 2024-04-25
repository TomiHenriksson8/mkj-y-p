document.addEventListener('DOMContentLoaded', function() {
    var filter = document.getElementById('categoryFilter');
    filter.addEventListener('change', function() {
        var selectedCategory = this.value;
        var productsContainers = document.querySelectorAll('.products-container');
        productsContainers.forEach(function(container) {
            if (selectedCategory === 'all' || container.getAttribute('data-category') === selectedCategory) {
                container.style.display = ''; // Use '' to return to the default display style
            } else {
                container.style.display = 'none';
            }
        });
    });
});