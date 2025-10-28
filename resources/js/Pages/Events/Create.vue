<script setup>
import { onMounted } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
    venues: Array,
    selectedVenue: [String, Number]
});

const form = useForm({
    event_name: '',
    event_date: '',
    event_is_virtual: false,
    event_speaker_name: '',
    fk_venue_event: props.selectedVenue || '',
});

const submit = () => {
    form.post(route('events.store'));
};

onMounted(() => {
    // Configurar fecha y hora actual como valor predeterminado
    if (!form.event_date) {
        const now = new Date();
        now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
        form.event_date = now.toISOString().slice(0, 16);
    }
});
</script>

<template>
    <Head title="Create Event"/>

    <AppLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Create Event</h2>
                <Link :href="route('events.index')"
                      class="px-4 py-2 bg-gray-800 dark:bg-gray-700 text-white rounded-md hover:bg-gray-700 dark:hover:bg-gray-600">
                    Back to Events
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <form @submit.prevent="submit">
                            <div class="mb-4">
                                <InputLabel for="event_name" value="Event Name" class="dark:text-gray-300"/>
                                <TextInput
                                    id="event_name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.event_name"
                                    required
                                    autofocus
                                />
                                <InputError class="mt-2" :message="form.errors.event_name"/>
                            </div>

                            <div class="mb-4">
                                <InputLabel for="event_date" value="Event Date" class="dark:text-gray-300"/>
                                <input
                                    id="event_date"
                                    type="datetime-local"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                    v-model="form.event_date"
                                    required
                                />
                                <InputError class="mt-2" :message="form.errors.event_date"/>
                            </div>

                            <div class="mb-4">
                                <div class="flex items-center">
                                    <input
                                        id="event_is_virtual"
                                        type="checkbox"
                                        class="rounded border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600"
                                        v-model="form.event_is_virtual"
                                    />
                                    <InputLabel for="event_is_virtual" value="Is Virtual Event?" class="ml-2 dark:text-gray-300"/>
                                </div>
                                <InputError class="mt-2" :message="form.errors.event_is_virtual"/>
                            </div>

                            <div class="mb-4">
                                <InputLabel for="event_speaker_name" value="Speaker Name" class="dark:text-gray-300"/>
                                <TextInput
                                    id="event_speaker_name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.event_speaker_name"
                                    required
                                />
                                <InputError class="mt-2" :message="form.errors.event_speaker_name"/>
                            </div>

                            <div class="mb-4">
                                <InputLabel for="fk_venue_event" value="Venue" class="dark:text-gray-300"/>
                                <select
                                    id="fk_venue_event"
                                    v-model="form.fk_venue_event"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                >
                                    <option value="">Select a Venue</option>
                                    <option v-for="venue in venues" :key="venue.id" :value="venue.id">
                                        {{ venue.venue_name }} (Capacity: {{ venue.venue_max_capacity }})
                                    </option>
                                </select>
                                <InputError class="mt-2" :message="form.errors.fk_venue_event"/>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }"
                                               :disabled="form.processing">
                                    Create Event
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>