import axios from 'axios';

class HttpClient{
    constructor() {
        const   domain = '192.168.43.71:80/api', 
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