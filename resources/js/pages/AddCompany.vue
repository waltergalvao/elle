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
                    </v-card-title>
                </v-img>

                <v-card-text>
                    <div class="overline mb-4">Photo by Juhasz Imre from Pexels</div>

                    <v-text-field
                        v-model="company.name"
                        ref="name"
                        :rules="[value => !!value || 'Please fill this field']"
                        label="Name"
                    ></v-text-field>

                    <v-text-field
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
                                v-model="company.linkedin_url"
                                label="LinkedIn"
                            ></v-text-field>
                        </v-col>

                        <v-col md="6" sm="12" class="py-0">
                            <v-text-field
                                v-model="company.facebook_url"
                                label="Facebook"
                            ></v-text-field>
                        </v-col>
                    </v-row>


                    <v-row>
                        <v-col md="6" sm="12" class="py-0">
                            <v-text-field
                                v-model="company.instagram_url"
                                label="Instagram"
                            ></v-text-field>
                        </v-col>

                        <v-col md="6" sm="12" class="py-0">
                            <v-text-field
                                v-model="company.twitter_url"
                                label="Twitter"
                            ></v-text-field>
                        </v-col>
                    </v-row>

                </v-card-text>
            </v-card>

            <div class="mt-8 text-right">
                <v-btn depressed large color="primary" @click="save">
                    SAVE
                </v-btn>
            </div>
        </template>
    </div>
</template>

<script>
    import CompanyService from "../services/companyService";

    export default {
        name: 'AddCompany',
        data() {
            return {
                isLoading: false,
                company: {},
                isSaving: null,
            }
        },
        methods: {
            async save() {
                this.$refs.name.validate(true);

                if (this.company.name) {
                    this.isLoading = true;
                    this.company = (await CompanyService.create(this.company)).data.data;
                    this.$router.push({ name: 'companies'});
                }
            }
        }
    }
</script>
