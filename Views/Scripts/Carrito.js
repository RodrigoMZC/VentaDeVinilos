function addToCart(viniloId) {
    fetch('/../Backend/Controllers/ViniloController.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            action: 'add_to_cart',
            vin_id: viniloId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Producto agregado al carrito');
        } else {
            alert(data.message || 'Error al agregar producto al carrito');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Ocurrió un error al procesar la solicitud.');
    });

    function formatearProducto(producto) {
        return `El producto ${producto.nombre} tiene un precio de: $ ${producto.precio}`;
    }
}
