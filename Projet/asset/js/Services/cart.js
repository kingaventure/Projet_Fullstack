document.addEventListener('DOMContentLoaded', () => {
    const cartButton = document.getElementById('cart_btn');
    const buyButtons = document.querySelectorAll('.buyBtn');
    const cartModal = new bootstrap.Modal(document.getElementById('cartModal'));
    const cartModalBody = document.getElementById('cartModalBody');
    const cartModalElement = document.getElementById('cartModal');

    let cart = [];

    const loadCart = () => {
        return cart;
    };

    const saveCart = (newCart) => {
        cart = newCart;
    };

    const updateCartDisplay = () => {
        const cart = loadCart();
        const cartCount = cart.length;
        cartButton.innerHTML = `<i class="fa-solid fa-cart-shopping mr-3"></i> (${cartCount})`;
    };

    const updateCartModal = () => {
        const cart = loadCart();
        cartModalBody.innerHTML = ''; // Clear previous content

        if (cart.length === 0) {
            cartModalBody.innerHTML = '<p>Votre panier est vide.</p>';
        } else {
            cart.forEach((article, index) => {
                const articleElement = document.createElement('div');
                articleElement.classList.add('cart-item');
                articleElement.innerHTML = `
                    <p>Nom: ${article.name}</p>
                    <p>Prix: ${article.price}$</p>
                    <p>Stock: ${article.stock}</p>
                    <p>Prix original: ${article.originalPrice}$</p>
                    <p>Réduction: ${article.discount}%</p>
                    <button class="removeBtn btn btn-danger" data-index="${index}">Supprimer</button>
                `;
                cartModalBody.appendChild(articleElement);
            });

            document.querySelectorAll('.removeBtn').forEach(button => {
                button.addEventListener('click', (event) => {
                    event.preventDefault(); // Prevent default behavior
                    const index = event.target.getAttribute('data-index');
                    removeFromCart(index);
                    updateCartModal();
                    updateCartDisplay();
                });
            });
        }
    };

    const addToCart = (article) => {
        const cart = loadCart();
        cart.push(article);
        saveCart(cart);
        updateCartDisplay();
    };

    const removeFromCart = (index) => {
        const cart = loadCart();
        cart.splice(index, 1);
        saveCart(cart);
    };

    buyButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            event.preventDefault(); // Prevent default behavior
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

            addToCart(article);
            console.log('Article ajouté au panier:', articleName);
        });
    });

    cartButton.addEventListener('click', () => {
        updateCartModal();
        cartModal.show();
    });

    cartModalElement.addEventListener('hidden.bs.modal', () => {
        cartModalBody.innerHTML = ''; // Clear modal content when hidden
        document.body.classList.remove('modal-open'); // Remove the modal-open class from the body
        document.querySelector('.modal-backdrop').remove(); // Remove the backdrop element
    });

    updateCartDisplay();
});