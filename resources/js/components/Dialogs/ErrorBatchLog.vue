<template>
    <v-alert
        outlined
        type="warning"
    >
        <strong v-if="log.contact_email">
            "{{ log.contact_email }}":
        </strong>
        {{ log.error }}
    </v-alert>
</template>

<script>
    export default {
        name: 'ErrorBatchLog',
        props: {
            log: {
                type: Object,
                required: true,
            }
        },
        methods: {}
    }
</script>
