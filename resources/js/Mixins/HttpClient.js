import axios from 'axios';

class HttpClient{
    constructor() {
        // const   domain = process.env.MIX_API_DOMAIN, 
                // protocol = process.env.MIX_API_PROTOCOL,
        const   domain = 'chinmarklog.com/api', 
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