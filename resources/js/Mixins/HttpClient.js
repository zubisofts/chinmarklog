import axios from 'axios';

class HttpClient{
    constructor() {
        const   domain = '127.0.0.1:80/api', 
                protocol = 'http',
                appUri = `${protocol}://${domain}`;

        this.client = axios.create({
            baseURL : appUri
        })
    }
}

const httpClient = new HttpClient();

window.httpClient = httpClient;

export default httpClient;