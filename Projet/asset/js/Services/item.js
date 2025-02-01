export const resetImage = async (id) =>  {
    const response = await fetch(`index.php?component=item&action=delete_image&id=${id}`, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        },
        method: 'GET'
    })

    return response.json()
}