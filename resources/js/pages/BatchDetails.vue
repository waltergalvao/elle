<template>
    <div>

        <template v-if="isLoading">
            <v-skeleton-loader
                type="heading, list-item@3"
            ></v-skeleton-loader>
        </template>
        <template v-else>
            <v-toolbar flat>
                <v-toolbar-title>Batch: {{ batch.name }}</v-toolbar-title>
            </v-toolbar>

            <success-batch-log :imported="batch.logs.imported" class="mt-4"></success-batch-log>
            <error-batch-log v-for="log in batch.logs.acknowledge" :log="log" :key="log.id"></error-batch-log>
        </template>
    </div>
</template>

<script>
    import CreateBatchDialog from "../components/Dialogs/CreateBatchDialog";
    import {BatchService} from "../services/batchService";
    import SuccessBatchLog from "../components/Dialogs/SuccessBatchLog";
    import ErrorBatchLog from "../components/Dialogs/ErrorBatchLog";
    export default {
        name: 'BatchDetails',
        components: {ErrorBatchLog, SuccessBatchLog, CreateBatchDialog},
        data() {
            return {
                isBatchDialogOpen: false,
                isLoading: true,
                batch: {},
            }
        },
        created() {
            this.fetchBatch();
        },
        methods: {
            async fetchBatch() {
                this.isLoading = true;
                this.batch = (await BatchService.get(this.$route.params.id)).data.data;
                this.isLoading = false;
            }
        }
    }
</script>
