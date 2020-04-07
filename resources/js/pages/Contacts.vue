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
            >
                <template v-slot:item.is_work_email="{ item }">
                    <v-chip small color="primary" v-if="item.is_work_email">
                        BUSINESS
                    </v-chip>
                    <v-chip small color="grey lighten-3" v-else>
                        PERSONAL
                    </v-chip>
                </template>
                <template v-slot:item.actions="{ item }">
                    <v-btn
                        icon
                        :to="{ name: 'contact.edit', params: {id: item.id}}"
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

    export default {
        name: 'Contacts',
        data() {
            return {
                isBatchDialogOpen: false,
                isLoading: true,
                contacts: [],
                search: '',
                headers: [
                    { text: 'First Name', value: 'first_name' },
                    { text: 'Last Name', value: 'last_name' },
                    { text: 'Email', value: 'email' },
                    { text: 'Provider', value: 'email_provider' },
                    { text: 'Email Type', value: 'is_work_email' },
                    { text: 'Actions', value: 'actions', align: 'end' },
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
