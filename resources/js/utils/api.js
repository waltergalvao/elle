import axios from 'axios';

class Api {
    constructor() {
        this.axios = axios.create({});
    }

    get(route, params) {
        return this.axios.get(
            route,
            params
        );
    }

    put(route, data) {
        return this.axios.put(
            route,
            data
        );
    }

    post(route, data) {
        return this.axios.post(
            route,
            data
        );
    }
}

export default new Api();
