<template>
    <v-alert
        prominent
        type="success"
    >
        <v-row align="center">
            <v-col class="grow">
                {{ imported }} contacts were successfully imported
            </v-col>
        </v-row>
    </v-alert>
</template>

<script>
    export default {
        name: 'SuccessBatchLog',
        props: {
            imported: {
                type: Number,
                required: true,
            }
        },
        methods: {}
    }
</script>
