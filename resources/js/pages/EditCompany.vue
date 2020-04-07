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
                    src="/img/company.jpg"
                >
                    <v-card-title>
                        {{ company.name }}
                        <v-spacer/>

                        <saving-chip v-if="isSaving === true"/>
                        <saved-chip v-else-if="isSaving === false"/>
                    </v-card-title>
                </v-img>

                <v-card-text>
                    <div class="overline mb-4">Photo by Juhasz Imre from Pexels</div>

                    <v-text-field
                        @change="save('name', $event)"
                        v-model="company.name"
                        label="Name"
                    ></v-text-field>

                    <v-text-field
                        @change="save('domain', $event)"
                        v-model="company.domain"
                        label="Domain"
                    ></v-text-field>


                </v-card-text>
            </v-card>

            <div class="overline mt-8">Social Medias</div>
            <v-card
                class="mx-auto mt-3"
                elevation="2"
            >
                <v-card-text>

                    <v-row>
                        <v-col md="6" sm="12" class="py-0">
                            <v-text-field
                                @change="save('linkedin_url', $event)"
                                v-model="company.linkedin_url"
                                label="LinkedIn"
                            ></v-text-field>
                        </v-col>

                        <v-col md="6" sm="12" class="py-0">
                            <v-text-field
                                @change="save('facebook_url', $event)"
                                v-model="company.facebook_url"
                                label="Facebook"
                            ></v-text-field>
                        </v-col>
                    </v-row>


                    <v-row>
                        <v-col md="6" sm="12" class="py-0">
                            <v-text-field
                                @change="save('instagram_url', $event)"
                                v-model="company.instagram_url"
                                label="Instagram"
                            ></v-text-field>
                        </v-col>

                        <v-col md="6" sm="12" class="py-0">
                            <v-text-field
                                @change="save('twitter_url', $event)"
                                v-model="company.twitter_url"
                                label="Twitter"
                            ></v-text-field>
                        </v-col>
                    </v-row>

                </v-card-text>
            </v-card>
        </template>
    </div>
</template>

<script>
    import {CompanyService} from "../services/companyService";
    import SavingChip from "../components/Dumb/VSavingChip";
    import SavedChip from "../components/Dumb/VSavedChip";

    export default {
        name: 'EditCompany',
        components: {SavedChip, SavingChip},
        data() {
            return {
                isLoading: true,
                company: {},
                isSaving: null,
            }
        },
        created() {
            this.fetchContacts();
        },
        methods: {
            async fetchContacts() {
                this.isLoading = true;
                this.company = (await CompanyService.get(this.$route.params.id)).data.data;
                this.isLoading = false;
            },
            async save(event, test) {
                this.isSaving = true;
                this.company = (await CompanyService.update(this.$route.params.id, this.company)).data.data;
                this.isSaving = false;
            }
        }
    }
</script>
