<template>
    <v-navigation-drawer
        v-model="isOpen"
        :clipped="$vuetify.breakpoint.lgAndUp"
        app
    >
        <v-list dense class="py-0">
            <v-list-item :to="{ name: 'batches' }" exact>
                <v-list-item-action>
                    <v-icon>mdi-cloud</v-icon>
                </v-list-item-action>
                <v-list-item-content>
                    <v-list-item-title>
                        Batches
                    </v-list-item-title>
                </v-list-item-content>
            </v-list-item>


            <v-list-item :to="{ name: 'contacts'}">
                <v-list-item-action>
                    <v-icon>mdi-contacts</v-icon>
                </v-list-item-action>
                <v-list-item-content>
                    <v-list-item-title>
                        Contacts
                    </v-list-item-title>
                </v-list-item-content>
            </v-list-item>


            <v-list-item :to="{ name: 'companies'}">
                <v-list-item-action>
                    <v-icon>mdi-store</v-icon>
                </v-list-item-action>
                <v-list-item-content>
                    <v-list-item-title>
                        Companies
                    </v-list-item-title>
                </v-list-item-content>
            </v-list-item>
        </v-list>
    </v-navigation-drawer>
</template>

<script>
    export default {
        name: 'TheNavigation',
        props: {
            isOpen: {
                type: Boolean,
                default: true,
            }
        }
    }
</script>
