import ApiService from './apiService';

class BatchService extends ApiService {
    async all() {
        return await this.get(`/api/batches/`);
    }

    async find(batchId) {
        return await this.get(`/api/batches/${batchId}`, {
            batchId
        });
    }

    async store(data) {
        return await this.post(
            `/api/batches`,
            data
        );
    }
}

export default new BatchService();
