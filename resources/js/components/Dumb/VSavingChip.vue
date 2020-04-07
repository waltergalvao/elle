<template>
    <v-chip color="primary" text-color="white">
        <v-avatar left>
            <v-progress-circular
                :size="18"
                color="white"
                indeterminate
            ></v-progress-circular>
        </v-avatar>
        Saving...
    </v-chip>
</template>

<script>
    export default {
        name: 'SavingChip'
    }
</script>
