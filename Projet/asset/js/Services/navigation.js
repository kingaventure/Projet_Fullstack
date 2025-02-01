document.addEventListener('DOMContentLoaded', () => {
    const contentContainer = document.querySelector('.container');
    const searchForm = document.querySelector('form[role="search"]');
    const cartButton = document.getElementById('cart_btn');
    const cartModalBody = document.getElementById('cartModalBody');
    const cartModalElement = document.getElementById('cartModal');
    const cartModal = new bootstrap.Modal(cartModalElement);

    const loadContent = (url) => {
        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            contentContainer.innerHTML = data.content;
            history.pushState(null, '', url);
            attachEventListeners();
        })
        .catch(error => console.error('Error:', error));
    };

    const attachEventListeners = () => {
        document.querySelectorAll('.pagination a').forEach(link => {
            link.addEventListener('click', (event) => {
                event.preventDefault();
                loadContent(event.target.href);
            });
        });

        document.querySelectorAll('.dropdown-menu a').forEach(link => {
            link.addEventListener('click', (event) => {
                event.preventDefault();
                loadContent(event.target.href);
            });
        });

        searchForm.addEventListener('submit', (event) => {
            event.preventDefault();
            const formData = new FormData(searchForm);
            const queryString = new URLSearchParams(formData).toString();
            loadContent(`index.php?${queryString}`);
        });

        document.querySelectorAll('.buyBtn').forEach(button => {
            button.addEventListener('click', (event) => {
                event.preventDefault();
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
        });
    };

    const addToCart = (article) => {
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        cart.push(article);
        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartDisplay();
    };

    const updateCartDisplay = () => {
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        const cartCount = cart.length;
        cartButton.innerHTML = `<i class="fa-solid fa-cart-shopping mr-3"></i> (${cartCount})`;
    };

    const updateCartModal = () => {
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
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
                    const index = event.target.getAttribute('data-index');
                    removeFromCart(index);
                    updateCartModal();
                    updateCartDisplay();
                });
            });
        }
    };

    const removeFromCart = (index) => {
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        cart.splice(index, 1);
        localStorage.setItem('cart', JSON.stringify(cart));
    };

    attachEventListeners();
    updateCartDisplay();
});