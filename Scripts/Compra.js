document.addEventListener("DOMContentLoaded", () => {
    const purchaseButton = document.getElementById("purchase-button");
    const modal = document.getElementById("purchase-modal");
    const closeModal = document.getElementById("close-modal");
    const confirmPurchase = document.getElementById("confirm-purchase");

    // Mostrar modal al hacer clic en "Realizar Compra"
    if (purchaseButton) {
        purchaseButton.addEventListener("click", () => {

            modal.style.display = "flex";
        });
    }

    // Cerrar el modal al hacer clic en el botón de cerrar
    if (closeModal) {
        closeModal.addEventListener("click", () => {
            modal.style.display = "none";
        });
    }

    // Confirmar la compra al hacer clic en el botón "Confirmar Compra"
    if (confirmPurchase) {
        confirmPurchase.addEventListener("click", () => {
            const selectedAddress = document.querySelector("input[name='direccion']:checked");

            if (!selectedAddress) {
                alert("Por favor selecciona una dirección.");
                return;
            }

            fetch("/Controllers/CompraController.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                },
                body: `action=create&direccion=${selectedAddress.value}`,
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        alert(`Compra realizada con éxito. ID de compra: ${data.id_compra}`);
                        location.reload(); // Recargar la página después de la compra
                    } else {
                        alert(`Error: ${data.message}`);
                    }
                })
                .catch((error) => {
                    console.error("Error al realizar la compra: ", error);
                    alert("Ocurrió un error al realizar la compra. Inténtalo nuevamente.");
                });
        });
    }

    // Cerrar el modal al hacer clic fuera del contenido
    modal.addEventListener("click", (event) => {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });
});
