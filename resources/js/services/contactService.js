import Api from '../utils/api';

export class ContactService {
    static async all() {
        return await Api.get(`/api/contacts/`);
    }

    static async get(contactId) {
        return await Api.get(`/api/contacts/${contactId}`);
    }

    static async update(contactId, data) {
        return await Api.put(`/api/contacts/${contactId}`, data);
    }
}
