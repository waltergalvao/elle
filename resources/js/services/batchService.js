import Api from '../utils/api';

export class BatchService {
    static async all() {
        return await Api.get(`/api/batches/`);
    }

    static async get(batchId) {
        return await Api.get(`/api/batches/${batchId}`, {
            batchId
        });
    }

    static async store(data) {
        return await Api.post(
            `/api/batches`,
            data
        );
    }
}
