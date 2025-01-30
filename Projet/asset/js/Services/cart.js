document.addEventListener('DOMContentLoaded', () => {
    const cart = [];
    const cartButton = document.getElementById('cart_btn');
    const buyButtons = document.querySelectorAll('.buyBtn');
    const cartModal = new bootstrap.Modal(document.getElementById('cartModal'));
    const cartModalBody = document.getElementById('cartModalBody');

    buyButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            const articleName = event.target.getAttribute('data-article-name');
            const articlePrice = event.target.getAttribute('data-article-price');
            const articleStock = event.target.getAttribute('data-article-stock');
            const articleOriginalPrice = event.target.getAttribute('data-article-original-price');
            const articleDiscount = event.target.getAttribute('data-article-discount');

            const article = {
                name: articleName,
                price: articlePrice,
                stock: articleStock,
                originalPrice: articleOriginalPrice,
                discount: articleDiscount
            };

            cart.push(article);
            updateCartDisplay();
        });
    });

    cartButton.addEventListener('click', () => {
        cartModalBody.innerHTML = ''; // Clear previous content

        cart.forEach((article, index) => {
            const articleElement = document.createElement('div');
            articleElement.classList.add('cart-item');
            articleElement.innerHTML = `
                <p>Name: ${article.name}</p>
                <p>Price: ${article.price}$</p>
                <p>Stock: ${article.stock}</p>
                <p>Original Price: ${article.originalPrice}$</p>
                <p>Discount: ${article.discount}%</p>
                <button class="removeBtn btn btn-danger" data-index="${index}">Remove</button>
            `;
            cartModalBody.appendChild(articleElement);
        });

        const removeButtons = document.querySelectorAll('.removeBtn');
        removeButtons.forEach(button => {
            button.addEventListener('click', (event) => {
                const index = event.target.getAttribute('data-index');
                cart.splice(index, 1);
                updateCartDisplay();
                cartButton.click(); // Refresh modal content
            });
        });

        cartModal.show();
    });

    function updateCartDisplay() {
        const cartCount = cart.length;
        cartButton.innerHTML = `<i class="fa-solid fa-cart-shopping mr-3"></i> (${cartCount})`;
    }
});