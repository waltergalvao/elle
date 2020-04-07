<template>
    <div>
        <template v-if="isLoading">
            <v-skeleton-loader
                type="table"
            ></v-skeleton-loader>
        </template>
        <template v-else>
            <v-toolbar flat>
                <v-toolbar-title>Companies</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-text-field
                    v-model="search"
                    append-icon="mdi-magnify"
                    label="Search"
                    single-line
                    hide-details
                ></v-text-field>
            </v-toolbar>

            <v-data-table
                fixed-header
                :search="search"
                :headers="headers"
                :items="comapnies"
            >
            </v-data-table>
        </template>
    </div>
</template>

<script>
    import {ContactService} from "../services/contactService";
    import {CompanyService} from "../services/companyService";

    export default {
        name: 'Companies',
        data() {
            return {
                isBatchDialogOpen: false,
                isLoading: true,
                comapnies: [],
                search: '',
                headers: [
                    { text: 'Name', value: 'name' },
                    { text: 'Domain', value: 'domain' },
                    { text: 'LinkedIn', value: 'linkedin_url' },
                ]
            }
        },
        created() {
            this.fetchCompanies();
        },
        methods: {
            async fetchCompanies() {
                this.isLoading = true;
                this.comapnies = (await CompanyService.all()).data.data;
                this.isLoading = false;
            }
        }
    }
</script>
