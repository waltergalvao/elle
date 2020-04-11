import ApiService from './apiService';

class CompanyService extends ApiService {
    async all() {
        return await this.get(`/api/companies/`);
    }

    async create(data) {
        return await this.post(`/api/companies`, data);
    }

    async find(companyId) {
        return await this.get(`/api/companies/${companyId}`);
    }

    async update(companyId, data) {
        return await this.put(`/api/companies/${companyId}`, data);
    }
}

export default new CompanyService();
