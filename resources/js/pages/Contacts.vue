<template>
    <div>
        <template v-if="isLoading">
            <v-skeleton-loader
                type="table"
            ></v-skeleton-loader>
        </template>
        <template v-else>
            <v-toolbar flat>
                <v-toolbar-title>Contacts</v-toolbar-title>
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
                :items="contacts"
                :items-per-page="10"
                class="elevation-1"
            ></v-data-table>
        </template>
    </div>
</template>

<script>
    import {ContactService} from "../services/contactService";

    export default {
        name: 'Batches',
        data() {
            return {
                isBatchDialogOpen: false,
                isLoading: true,
                contacts: [],
                search: '',
                headers: [
                    { text: 'Email', value: 'email' },
                    { text: 'First Name', value: 'first_name' },
                    { text: 'Last Name', value: 'last_name' },
                ]
            }
        },
        created() {
            this.fetchContacts();
        },
        methods: {
            async fetchContacts() {
                this.isLoading = true;
                this.contacts = (await ContactService.all()).data.data;
                this.isLoading = false;
            }
        }
    }
</script>
