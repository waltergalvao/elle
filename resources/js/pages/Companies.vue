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
                <v-btn color="primary" large depressed class="ml-4" :to="{ name: 'companies.add' }">CREATE COMPANY</v-btn>
            </v-toolbar>

            <v-data-table
                fixed-header
                :search="search"
                :headers="headers"
                :items="comapnies"
            >
                <template v-slot:item.linkedin_url="{ item }">
                    <a :href="item.linkedin_url" target="_blank" rel="nofollow">{{ item.linkedin_url}}</a>
                </template>
                <template v-slot:item.actions="{ item }">
                    <v-btn
                        icon
                        :to="{ name: 'companies.edit', params: {id: item.id}}"
                        exact
                    >
                        <v-icon>mdi-pencil</v-icon>
                    </v-btn>
                </template>
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
                    { text: 'Actions', value: 'actions', align: 'end' },
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
