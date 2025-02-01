import { resetImage } from "../Services/item.js";

export const handleRemoveImageClick = () => {
    const removeBtn = document.querySelector('#remove-image-btn');
    if (removeBtn) {
        removeBtn.addEventListener('click', async () => {
            if (window.confirm("L'image va être supprimé, souhaitez vous confirmer ?")) {
                const reset = await resetImage(removeBtn.getAttribute('data-id'));
                if (reset.hasOwnProperty('success')) {
                    document.querySelector('#person-image').innerHTML = '';
                    showToast("L'image a été détruite", "bg-success");
                }
            }
        });
    }
};

document.addEventListener('DOMContentLoaded', handleRemoveImageClick);