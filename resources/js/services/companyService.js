import Api from '../utils/api';

export class CompanyService {
    static async all() {
        return await Api.get(`/api/companies/`);
    }
}
