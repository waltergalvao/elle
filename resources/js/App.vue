<template>
        <v-app id="inspire">
            <v-navigation-drawer
                v-model="drawer"
                :clipped="$vuetify.breakpoint.lgAndUp"
                app
            >
                <v-list dense>
                    <template v-for="item in items">
                        <v-list-item
                            :key="item.text"
                            link
                        >
                            <v-list-item-action>
                                <v-icon>{{ item.icon }}</v-icon>
                            </v-list-item-action>
                            <v-list-item-content>
                                <v-list-item-title>
                                    {{ item.text }}
                                </v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    </template>
                </v-list>
            </v-navigation-drawer>

            <v-app-bar
                :clipped-left="$vuetify.breakpoint.lgAndUp"
                app
                color="blue darken-3"
                dark
            >
                <v-app-bar-nav-icon @click.stop="drawer = !drawer" />
                <v-toolbar-title
                    style="width: 300px"
                    class="ml-0 pl-4"
                >
                    <span class="hidden-sm-and-down">ELLE</span>
                </v-toolbar-title>
                <v-text-field
                    flat
                    solo-inverted
                    hide-details
                    prepend-inner-icon="mdi-magnify"
                    label="Search"
                    class="hidden-sm-and-down"
                />
                <v-spacer />
                <v-btn icon>
                    <v-icon>mdi-apps</v-icon>
                </v-btn>
                <v-btn icon>
                    <v-icon>mdi-bell</v-icon>
                </v-btn>
                <v-btn
                    icon
                    large
                >
                    <v-avatar
                        size="32px"
                        item
                    >
                        <v-img
                            src="https://cdn.vuetifyjs.com/images/logos/logo.svg"
                            alt="Vuetify"
                        /></v-avatar>
                </v-btn>
            </v-app-bar>
            <v-content>
                <v-container
                    class="fill-height"
                    fluid
                >
                    <router-view></router-view>
                </v-container>
            </v-content>
        </v-app>
</template>

<script>
    export default {
        name: 'App',
        data: () => ({
            dialog: false,
            drawer: null,
            items: [
                { icon: 'mdi-cloud', text: 'Batches' },
                { icon: 'mdi-contacts', text: 'Contacts' },
                { icon: 'mdi-store', text: 'Companies' },
            ],
        }),
    }
</script>
