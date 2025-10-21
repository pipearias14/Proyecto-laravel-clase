<script setup>
import {Head, Link} from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    venue: Object,
});
</script>

<template>
    <Head title="Venue Details"/>

    <AppLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Venue Details
                </h2>
                <Link :href="route('venues.index')"
                      class="px-4 py-2 bg-gray-800 dark:bg-gray-700 text-white rounded-md hover:bg-gray-700 dark:hover:bg-gray-600">
                    Back to Venues
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Venue Information</h3>

                            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">ID</p>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ venue.id }}</p>
                                </div>

                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Name</p>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ venue.venue_name }}</p>
                                </div>

                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Address</p>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ venue.venue_address }}</p>
                                </div>

                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Maximum Capacity</p>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-white">{{
                                            venue.venue_max_capacity
                                        }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>