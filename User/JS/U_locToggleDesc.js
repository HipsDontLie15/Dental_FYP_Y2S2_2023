$(document).ready(function() {
    // Hide all map containers and pemail text initially
    $('.map-container, .pemail').hide();

    // Show the first map container initially
    $('.map-container:first').show();
    $('.pemail:first').show();
    $('.show-map:first').addClass('full-width');

    

    // Handle click event for the links
    $('.show-map').click(function(event) {
        event.preventDefault(); // Prevent default link behavior

        // Hide all map containers and pemail text
        $('.map-container, .pemail').hide();

        // Show the corresponding map container and pemail text for the clicked item
        const clickedContainer = $(this).next('.map-container');
        clickedContainer.show();
        clickedContainer.closest('.BTM_li').find('.pemail').show();

        // Scroll to the clicked container
        $('html, body').animate({
            scrollTop: clickedContainer.offset().top
        }, 800); // Adjust the scrolling speed as needed
        
        // Add 'full-width' class to the clicked link
        $(this).addClass('full-width');
        
    });
});
