<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Atualização Dinâmica do Carrinho</title>
<!--    <script src="cart-script.js"></script>-->
</head>
<body>
    <div id="cart-items">Aguardando dados do carrinho...</div>
    <div id="total-items"></div>
    <div id="total-price"></div>


    <script>
        async function fetchCartData() {
            try {
                const response = await fetch('get-cart.php');
                if (!response.ok) {
                    throw new Error('A conexão falhou ' + response.statusText);
                }
                const data = await response.json();
                updateCartHTML(data);
            } catch (error) {
                console.error('Fetch error: ', error);
            }
        }

        function updateCartHTML(data) {
            const cartContainer = document.getElementById('cart-items');
            cartContainer.innerHTML = '';

            data.items.forEach(item => {
                const itemElement = document.createElement('div');
                itemElement.innerHTML = `<p>${item.name}: ${item.quantity}</p>`;
                // itemElement.innerHTML = `<p>Preço: ${item.price}</p>`;
                cartContainer.appendChild(itemElement);
            });

            // document.getElementById('total-items').innerText = `Total Items: ${data.totalItems}`;
            // document.getElementById('total-price').innerText = `Total Price: ${data.totalPrice}`;
        }

        // Executa a função fetchCartData a cada 1 segundo
        setInterval(fetchCartData, 500);

    </script>
</body>
</html>
