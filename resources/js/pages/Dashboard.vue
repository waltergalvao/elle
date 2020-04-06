<template>
    <div>
        <v-toolbar flat>
            <v-toolbar-title>Batches</v-toolbar-title>

            <v-spacer></v-spacer>

            <v-btn depressed large color="primary" @click="isBatchDialogOpen = true">
                CREATE BATCH
            </v-btn>
        </v-toolbar>

        <create-batch-dialog :is-open="isBatchDialogOpen" @onClose="isBatchDialogOpen = false"></create-batch-dialog>
    </div>
</template>

<script>
    import CreateBatchDialog from "../components/Dialogs/CreateBatchDialog";
    export default {
        name: 'Dashboard',
        components: {CreateBatchDialog},
        data() {
            return {
                isBatchDialogOpen: false,
            }
        }
    }
</script>
