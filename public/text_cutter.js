document.querySelectorAll('.description').forEach(description => {
    const maxHeight = parseFloat(window.getComputedStyle(description).maxHeight);
    let text = description.textContent;

    while (description.scrollHeight > maxHeight) {
        text = text.split(' ').slice(0, -1).join(' ') + '...';
        description.textContent = text;
    }
});
