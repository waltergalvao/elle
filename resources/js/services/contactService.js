import ApiService from './apiService';

class ContactService extends ApiService {
    async all() {
        return await this.get(`/api/contacts/`);
    }

    async find(contactId) {
        return await this.get(`/api/contacts/${contactId}`);
    }

    async update(contactId, data) {
        return await this.put(`/api/contacts/${contactId}`, data);
    }
}

export default new ContactService();
