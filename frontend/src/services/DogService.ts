export default {
    async listDogs(secret: String) {
        const response = await fetch('http://localhost/api/listdogs',
            {
                headers: {
                    Authorization: secret
                }
            })
        return await response.json();
    }
}
