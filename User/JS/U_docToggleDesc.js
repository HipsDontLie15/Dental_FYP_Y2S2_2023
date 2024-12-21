function toggleDescription(event, docId) {
    event.preventDefault(); // Prevent the default scrolling behavior
    var docDescription = document.getElementById('doc_description_' + docId);
    if (docDescription.style.display === "none") {
        docDescription.style.display = "block";
        docDescription.scrollIntoView({ behavior: 'smooth' }); // Scroll the content into view
    } else {
        docDescription.style.display = "none";
    }
}