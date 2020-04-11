<template>
    <div>
        <v-toolbar flat>
            <v-toolbar-title>Batches</v-toolbar-title>

            <v-spacer></v-spacer>

            <v-btn depressed large color="primary" @click="isBatchDialogOpen = true">
                CREATE BATCH
            </v-btn>
        </v-toolbar>

        <create-batch-dialog :is-open="isBatchDialogOpen" @onClose="isBatchDialogOpen = false" @onSave="fetchBatches"></create-batch-dialog>

        <template v-if="isLoading">
            <v-skeleton-loader
                type="table"
            ></v-skeleton-loader>
        </template>
        <template v-else>
            <v-simple-table>
                    <thead>
                    <tr>
                        <th class="text-left">Name</th>
                        <th class="text-left">Status</th>
                        <th class="text-right">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="batch in batches.data" :key="batch.id">
                        <td>{{ batch.name }}</td>
                        <td>
                            <v-chip color="green lighten-1" outlined v-if="batch.is_processed">Processed</v-chip>
                            <v-chip color="grey" outlined v-else>Processing</v-chip>
                        </td>
                        <td class="text-right">
                            <v-btn
                                v-if="batch.is_processed"
                                icon
                                :to="{ name: 'batch.details', params: {id: batch.id}}"
                            >
                                <v-icon>mdi-eye</v-icon>
                            </v-btn>
                        </td>
                    </tr>
                    </tbody>
            </v-simple-table>
        </template>
    </div>
</template>

<script>
    import CreateBatchDialog from "../components/Dialogs/CreateBatchDialog";
    import BatchService from "../services/batchService";
    export default {
        name: 'Batches',
        components: {CreateBatchDialog},
        data() {
            return {
                isBatchDialogOpen: false,
                isLoading: true,
                batches: [],
            }
        },
        created() {
            this.fetchBatches();
        },
        methods: {
            async fetchBatches() {
                this.isLoading = true;
                this.batches = (await BatchService.all()).data;
                this.isLoading = false;
            }
        }
    }
</script>
