const scrollContainers = document.querySelectorAll('.products_overview'); // Pobieramy wszystkie kontenery

scrollContainers.forEach(scrollContainer => {
    let isDown = false; // Lokalny stan dla tego kontenera
    let startX;
    let scrollLeft;

    scrollContainer.addEventListener('mousedown', (e) => {
        isDown = true;
        scrollContainer.classList.add('active');
        startX = e.pageX - scrollContainer.offsetLeft;
        scrollLeft = scrollContainer.scrollLeft;
        scrollContainer.style.cursor = "grabbing";
    });

    scrollContainer.addEventListener('mouseleave', () => {
        isDown = false;
        scrollContainer.style.cursor = "grab";
        scrollContainer.classList.remove('active');
    });

    scrollContainer.addEventListener('mouseup', () => {
        isDown = false;
        scrollContainer.style.cursor = "grab";
        scrollContainer.classList.remove('active');
    });

    scrollContainer.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - scrollContainer.offsetLeft;
        const walk = (x - startX); // Przesunięcie
        scrollContainer.scrollLeft = scrollLeft - walk;
    });
});
