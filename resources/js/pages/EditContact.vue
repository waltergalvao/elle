<template>
    <div class="mx-auto mt-2" style="max-width: 600px;">
        <template v-if="isLoading">
            <v-card
                class="mx-auto"
                max-width="344"
                outlined
            >
                <v-skeleton-loader
                    type="card"
                ></v-skeleton-loader>
            </v-card>
        </template>
        <template v-else>
            <v-card
                class="mx-auto"
                elevation="2"
            >

                <v-img
                    class="white--text align-end"
                    height="200px"
                    src="/img/contact.jpeg"
                >
                    <v-card-title>
                        {{ contact.name }}
                        <v-spacer/>

                        <saving-chip v-if="isSaving === true"/>
                        <saved-chip v-else-if="isSaving === false"/>
                    </v-card-title>
                </v-img>

                <v-card-text>
                    <div class="overline mb-4">Photo by energepic.com from Pexels</div>

                    <v-text-field
                        @change="save('name', $event)"
                        v-model="contact.first_name"
                        label="Name"
                    ></v-text-field>

                    <v-text-field
                        @change="save('name', $event)"
                        v-model="contact.last_name"
                        label="Name"
                    ></v-text-field>

                    <v-select
                        :items="companies"
                        label="Company"
                        v-model="contact.company_id"
                        item-text="name"
                        item-value="id"
                        @change="save('company_id', $event)"
                    ></v-select>
                </v-card-text>
            </v-card>

            <div class="overline mt-8">Social Medias</div>
            <v-card
                class="mx-auto mt-3"
                elevation="2"
            >
                <v-card-text>
                    <v-text-field
                        @change="save('name', $event)"
                        v-model="contact.linkedin_url"
                        label="LinkedIn"
                    ></v-text-field>
                </v-card-text>
            </v-card>

            <div class="overline mt-8">Extra</div>
            <v-card
                class="mx-auto mt-3"
                elevation="2"
            >
                <v-card-text>
                    <v-textarea
                        v-model="contact.notes"
                        @change="save('name', $event)"
                        label="Notes"
                    ></v-textarea>
                </v-card-text>
            </v-card>
        </template>
    </div>
</template>

<script>
    import SavingChip from "../components/Dumb/VSavingChip";
    import SavedChip from "../components/Dumb/VSavedChip";
    import {ContactService} from "../services/contactService";
    import {CompanyService} from "../services/companyService";

    export default {
        name: 'EditContact',
        components: {SavedChip, SavingChip},
        data() {
            return {
                isLoading: true,
                contact: {},
                companies: [],
                isSaving: null,
            }
        },
        created() {
            this.isLoading = true;
            this.fetchContact(this.$route.params.id);
            this.fetchCompanies();
            this.isLoading = false;
        },
        methods: {
            async fetchContact(contactId) {
                this.contact = (await ContactService.get(contactId)).data.data;
            },
            async fetchCompanies() {
                this.companies = (await CompanyService.all()).data.data;
            },
            async save(event, test) {
                this.isSaving = true;
                this.contact = (await ContactService.update(this.$route.params.id, this.contact)).data.data;
                this.isSaving = false;
            }
        }
    }
</script>
