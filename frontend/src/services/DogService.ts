export default {
    async listDogs(secret: String) {
        const response = await fetch('http://localhost/api/dogs',
            {
                headers: {
                    Authorization: secret
                }
            })
        return await response.json();
    }
}
