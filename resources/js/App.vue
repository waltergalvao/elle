<template>
        <v-app>
            <the-navigation :isOpen="drawer"></the-navigation>

            <v-app-bar
                :clipped-left="$vuetify.breakpoint.lgAndUp"
                app
                flat
                color="primary"
                dark
            >
                <v-app-bar-nav-icon @click.stop="drawer = !drawer"/>
                <v-toolbar-title class="ml-0 pl-4">
                    <span class="hidden-sm-and-down">ELLE</span>
                </v-toolbar-title>
            </v-app-bar>
            <v-content>
                <v-container fluid>
                    <router-view></router-view>
                </v-container>
            </v-content>
        </v-app>
</template>

<script>
    import TheNavigation from "./components/TheNavigation";
    export default {
        name: 'App',
        components: {TheNavigation},
        data() {
            return {
                drawer: true,
            }
        }
    }
</script>
