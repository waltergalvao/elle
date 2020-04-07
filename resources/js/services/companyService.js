import Api from '../utils/api';

export class CompanyService {
    static async all() {
        return await Api.get(`/api/companies/`);
    }

    static async get(companyId) {
        return await Api.get(`/api/companies/${companyId}`);
    }

    static async update(companyId, data) {
        return await Api.put(`/api/companies/${companyId}`, data);
    }
}
