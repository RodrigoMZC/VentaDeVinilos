document.addEventListener("DOMContentLoaded", () => {
    const modal = document.getElementById('add-artista-modal');
    const btnModal = document.getElementById('btn-add-artista');
    const btnClose = document.querySelector('.close-modal');

    btnModal.addEventListener('click', () => {
        modal.style.display = 'flex';
    });

    btnClose.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    window.addEventListener('click', (evt) => {
        if (evt.target === modal) {
            modal.style.display = 'none';
        }
    });
});

