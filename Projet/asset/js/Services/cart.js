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

    buyButtons.forEach(button => {
        button.addEventListener('click', () => {
            const articleName = button.getAttribute('data-article-name');
            const articlePrice = button.getAttribute('data-article-price');
            const articleStock = button.getAttribute('data-article-stock');

            
            toast.show();

         
            const articleElement = document.createElement('div');
            articleElement.innerHTML = `
                <p>Nom: ${articleName}</p>
                <p>Prix: ${articlePrice}$</p>
                <p>Stock restant: ${articleStock}</p>
            `;
            modalBody.appendChild(articleElement);
        });
    });

    cartButton.addEventListener('click', () => {
        modalTitle.textContent = 'Panier';
        modal.show();
    });

    modalCloseBtn.addEventListener('click', () => {
        modal.hide();
    });

    modalValidBtn.addEventListener('click', () => {
        modal.hide();
    });
});