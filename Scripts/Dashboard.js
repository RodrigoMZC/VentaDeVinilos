        // Modales Para Agregar en Dashboard
document.addEventListener("DOMContentLoaded", () => {
    // Modal Artistas
    const modalArtista = document.getElementById('add-artista-modal');
    const btnModalArtista = document.getElementById('btn-add-artista');
    //Modal Vinilos
    const modalVinilo = document.getElementById('add-vinilo-modal');
    const btnModalVinilo = document.getElementById('btn-add-vinilo');

    const btnClose = document.querySelectorAll('.close-modal');

    btnModalArtista.addEventListener('click', () => {
        modalArtista.style.display = 'flex';
    });

    btnClose.forEach(button => {
        button.addEventListener('click', () => {
            modalArtista.style.display = 'none';
            modalVinilo.style.display = 'none';
        });
    });

    window.addEventListener('click', (evt) => {
        if (evt.target === modalArtista) {
            modalArtista.style.display = 'none';
        }
    });


    btnModalVinilo.addEventListener('click', () => {
        modalVinilo.style.display = 'flex';
    });

    window.addEventListener('click', (evt) => {
        if (evt.target === modalVinilo) {
            modalVinilo.style.display = 'none';
        }
    });

    btnClose.forEach(button => {
        button.addEventListener('click', () => {
            modalArtista.style.display = 'none';
            modalVinilo.style.display = 'none';
        });
    });
});

    // Tablas de Modales
document.addEventListener("DOMContentLoaded", () => {
    const entregarBtn = document.querySelectorAll(".btn-dashboard-delivered");
    const eliminarBtn = document.querySelectorAll(".btn-dashboard-delete");

    entregarBtn.forEach(button => {
        button.addEventListener("click", (evt) => {
            evt.preventDefault();
            const compId = button.closest("tr").querySelector("input[name='comp_id']").value;
            const action = 'entregar';

            if (confirm('¿Estás seguro de marcar esta compra como entregada?')) {
                fetch('/Controllers/CompraController.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `comp_id=${compId}&action=${action}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        alert('Compra marcada como entregada');
                        const status = button.closest("tr").querySelector(".comp-status");
                        statusCell.textContent = "Entregado";
                        button.disabled = true
                        location.reload(); 
                    } 
                })
                .catch(error => {
                    alert('Hubo un error al intentar marcar la compra como entregada');
                    console.error('Error:', error);
                });
            }
        });
    });

    eliminarBtn.forEach(button => {
        button.addEventListener("click", (evt) => {
            evt.preventDefault();
            const compId = button.closest("tr").querySelector("input[name='comp_id']").value;
            const action = 'eliminar';

            if (confirm('¿Estás seguro de eliminar esta compra?')) {
                fetch('/Controllers/CompraController.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `comp_id=${compId}&action=${action}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        alert('Compra eliminada correctamente');
                        button.closest("tr").remove(); // Eliminar la fila de la tabla
                    } else {
                        alert('Error al eliminar la compra');
                    }
                })
                .catch(error => {
                    alert('Hubo un error al intentar eliminar la compra');
                    console.error('Error:', error);
                });
            }
        });
    });
});