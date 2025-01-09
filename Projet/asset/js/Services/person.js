export const getPersons = async (currentPage = 1) => {
    const response = await fetch(`index.php?component=persons&page=${currentPage}`, {
        headers: {
            'Content-Type': 'application/json'
        }
    })
    console.log(response)
    return await response.json()

}
