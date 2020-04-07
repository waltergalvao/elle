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
                    src="/img/contact.jpg"
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
                        v-model="contact.name"
                        label="Name"
                    ></v-text-field>

                    <v-text-field
                        @change="save('domain', $event)"
                        v-model="contact.domain"
                        label="Domain"
                    ></v-text-field>


                </v-card-text>
            </v-card>
        </template>
    </div>
</template>

<script>
    import {CompanyService} from "../services/contactService";
    import SavingChip from "../components/Dumb/VSavingChip";
    import SavedChip from "../components/Dumb/VSavedChip";

    export default {
        name: 'EditCompany',
        components: {SavedChip, SavingChip},
        data() {
            return {
                isLoading: true,
                contact: {},
                isSaving: null,
            }
        },
        created() {
            this.fetchContacts();
        },
        methods: {
            async fetchContacts() {
                this.isLoading = true;
                this.contact = (await ContactService.get(this.$route.params.id)).data.data;
                this.isLoading = false;
            },
            async save(event, test) {
                this.isSaving = true;
                this.contact = (await ContactService.update(this.$route.params.id, this.contact)).data.data;
                this.isSaving = false;
            }
        }
    }
</script>
