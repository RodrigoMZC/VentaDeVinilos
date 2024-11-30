document.addEventListener("DOMContentLoaded", () => {
    const cartButton = document.getElementById('cart-button');
    const sidebar = document.getElementById('cart-sidebar');
    const closeSidebar = document.getElementById('close-sidebar');
    const addButtons = document.querySelectorAll('.btn-compra');
    const removeButtons = document.querySelectorAll('.remove-item');

    // Mostrar barra lateral al presionar el botón del carrito
    cartButton.addEventListener('click', () => {
        sidebar.classList.add('open');
    });

    // Ocultar barra lateral al presionar el botón de cerrar
    closeSidebar.addEventListener('click', () => {
        sidebar.classList.remove('open');
    });

    addButtons.forEach(button => {
        button.addEventListener('click', () => {
            const id = button.dataset.id;
            const name = button.dataset.name;
            const price = button.dataset.price;

            console.log(`Producto agregado: ID=${id}, Nombre=${name}, Precio=${price}`);

            fetch ('/Controllers/CarritoController.php', {
                method: "POST", 
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                } ,
                body: `action=add&id=${id}&name=${encodeURIComponent(name)}&price=${price}`,
            }) 
            .then(response => response.json())
            .then(data => {
                if(data.status === "success"){
                    alert(data.message); 
                    location.reload();
                } else  {
                    alert("Error: " + data.message);
                }
            })
            .catch(error => {
                console.error("Error al agregar al carrito:", error);
            });

        });
    });

     removeButtons.forEach(button => {
        button.addEventListener('click', () => {
            const id = button.dataset.id;

            fetch ('/Controllers/CarritoController.php', {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                },
                body: `action=remove&id=${id}`,
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    alert(data.message);
                    location.reload();
                } else {
                    alert("Error: " + data.message);
                }
            })
            .catch(error => {
                console.error("Error al eliminar del carrito:", error);
            });
        });
     });
     modal.addEventListener("click", (event) => {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });
});