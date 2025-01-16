document.addEventListener('DOMContentLoaded', () => {
    const toastElement = document.querySelector('#toast-message');
    const toast = new bootstrap.Toast(toastElement, { delay: 10000 });

    const modalElement = document.querySelector('#modal');
    const modal = new bootstrap.Modal(modalElement, { backdrop: 'static' });

    const modalValidBtnElement = document.querySelector('#modal-valid-btn');
    const modalCloseBtnElement = document.querySelector('#modal-close-btn');
    const modalBodyElement = modalElement.querySelector('.modal-body');

    const buyButtons = document.querySelectorAll('.buyBtn');
    const cart = document.querySelector('#cart_btn');

    buyButtons.forEach(button => {
        button.addEventListener('click', () => {
            const articleName = button.getAttribute('data-article-name');
            const articlePrice = button.getAttribute('data-article-price');
            const articleStock = button.getAttribute('data-article-stock');

            const articleDetails = `
                <div>
                    <h5>${articleName}</h5>
                    <p>Prix: ${articlePrice}$</p>
                    <p>Stock: ${articleStock}</p>
                </div>
            `;

            modalBodyElement.innerHTML += articleDetails;

            toast.show();
        });
    });

    cart.addEventListener('click', () => {
        modal.show();
    });

    modalValidBtnElement.addEventListener('click', () => {
        modal.hide();
    });
});