
    document.addEventListener('DOMContentLoaded', function () {
        // Parse URL parameters
        const urlParams = new URLSearchParams(window.location.search);
        const selectedCategory = urlParams.get('category');

        // Set active state for the corresponding subcategory
        if (selectedCategory) {
            const subcategoryElement = document.getElementById(selectedCategory);
            if (subcategoryElement) {
                subcategoryElement.classList.add('active');
            }
        }

        // Initialize with "all" category selected
        filterResults("all");

        // Add click event listener to category buttons
        var submenu = document.getElementsByClassName("submenu")[0];
        var buttons = submenu.getElementsByTagName("a");
        for (var i = 0; i < buttons.length; i++) {
            buttons[i].addEventListener("click", function () {
                // Remove active class from all buttons
                for (var j = 0; j < buttons.length; j++) {
                    buttons[j].classList.remove("active");
                }

                // Add active class to the clicked button
                this.classList.add("active");

                // Filter based on the clicked category
                var category = this.getAttribute("data-category");
                filterSelection(category);
                filterResults(category);
            });
        }
    });

    

    
