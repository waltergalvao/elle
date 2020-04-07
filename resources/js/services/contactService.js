import Api from '../utils/api';

export class ContactService {
    static async all() {
        return await Api.get(`/api/contacts/`);
    }
}
