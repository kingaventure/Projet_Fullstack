document.addEventListener('DOMContentLoaded', () => {
    const buyButtons = document.querySelectorAll('.buyBtn');
    const toastMessage = document.getElementById('toast-message');
    const toast = new bootstrap.Toast(toastMessage);
    const modal = new bootstrap.Modal(document.getElementById('modal'));
    const modalBody = document.querySelector('#modal .modal-body');
    const modalTitle = document.querySelector('#modal .modal-title');
    const cartButton = document.getElementById('cart_btn');
    const modalCloseBtn = document.getElementById('modal-close-btn');
    const modalValidBtn = document.getElementById('modal-valid-btn');

    let cartItems = [];

    buyButtons.forEach(button => {
        button.addEventListener('click', () => {
            const articleName = button.getAttribute('data-article-name');
            const articlePrice = button.getAttribute('data-article-price');
            const articleStock = button.getAttribute('data-article-stock');
            const articleOriginalPrice = button.getAttribute('data-article-original-price');
            const articleDiscount = button.getAttribute('data-article-discount');

            toast.show();

            const articleElement = {
                name: articleName,
                price: articlePrice,
                stock: articleStock,
                originalPrice: articleOriginalPrice,
                discount: articleDiscount
            };

            cartItems.push(articleElement);
        });
    });

    cartButton.addEventListener('click', () => {
        modalBody.innerHTML = '';
        modalTitle.textContent = 'Panier';

        cartItems.forEach((item, index) => {
            const articleElement = document.createElement('div');
            articleElement.innerHTML = `
                <p>Nom: ${item.name}</p>
                ${item.discount > 0 ? `<p>Prix: <span style="text-decoration: line-through;">${item.originalPrice}$</span> ${item.price}$ (-${item.discount}%)</p>` : `<p>Prix: ${item.price}$</p>`}
                <p>Stock restant: ${item.stock}</p>
                <button class="btn btn-danger remove-btn" data-index="${index}">Retirer</button>
            `;
            modalBody.appendChild(articleElement);
        });

        modal.show();

        const removeButtons = document.querySelectorAll('.remove-btn');
        removeButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                const index = e.target.getAttribute('data-index');
                cartItems.splice(index, 1);
                e.target.parentElement.remove();
            });
        });
    });

    modalCloseBtn.addEventListener('click', () => {
        modal.hide();
    });

    modalValidBtn.addEventListener('click', () => {
        modal.hide();
    });
});