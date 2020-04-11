<template>
    <v-dialog v-model="isOpen" max-width="600px" @click:outside="close">
        <v-card>
            <v-card-title>
                <span class="headline">Create Batch</span>
            </v-card-title>
            <v-card-text>
                <v-container>
                    <v-row>
                        <v-col cols="12">
                            <v-text-field
                                v-model="formData.name"
                                label="Batch name*"
                                hint="A name you will remember (e.g. Toronto Pitch Night)"
                                :disabled="isSaving">
                            </v-text-field>
                        </v-col>
                        <v-col cols="12">
                            <v-file-input
                                v-model="file"
                                @change="parseCsv"
                                show-size
                                accept=".csv"
                                label="Select a .csv file"
                                :loading="isLoading"
                                :disabled="isLoading || isSaving">
                            </v-file-input>
                        </v-col>
                    </v-row>
                </v-container>
            </v-card-text>
            <v-divider></v-divider>
            <v-card-actions>
                <v-btn color="grey" text @click="close">Cancel</v-btn>
                <v-spacer></v-spacer>
                <v-btn color="primary" text @click="save" v-if="formData.name && formData.data" :loading="isSaving">Save</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
    import Papa from 'papaparse'
    import BatchService from "../../services/batchService";

    export default {
        name: 'CreateBatchDialog',
        props: {
            isOpen: {
                type: Boolean,
                default: false
            }
        },
        data() {
            return {
                file: null,
                isLoading: false,
                isParsed: false,
                isSaving: false,
                formData: {
                    name: '',
                    data: null,
                }
            }
        },
        methods: {
            parseCsv() {
                if (!this.file) {
                    return;
                }

                this.isLoading = true;

                Papa.parse(this.file, {
                    header: true,
                    complete: ({ data, errors }) => {
                        this.isParsed = true;
                        this.isLoading = false;
                        this.formData.data = data;
                        this.errors = errors;
                    }
                });
            },
            async save() {
                this.isSaving = true;
                const response = await BatchService.store(this.formData);
                this.isSaving = false;
                this.reset();
                this.$emit('onSave');
                this.$emit('onClose');
            },
            reset() {
                this.formData = {
                    name: '',
                    data: null,
                };
                this.file = null;
            },
            close() {
                this.$emit('onClose');
            }
        }
    }
</script>
