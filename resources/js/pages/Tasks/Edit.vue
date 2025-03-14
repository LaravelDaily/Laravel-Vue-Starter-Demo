<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import { Task } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';

interface Props {
    task: Task;
}

const props = defineProps<Props>();

const task = props.task;

const form = useForm({
    name: task.name,
    is_completed: task.is_completed,
});

const submitForm = () => {
    form.put(route('tasks.update', task.id), {
        preserveScroll: true,
    });
};
</script>

<template>
    <AppLayout>
        <Head title="Edit Task" />
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <form class="space-y-6" @submit.prevent="submitForm">
                <div class="grid gap-2">
                    <Label htmlFor="name">Task Name *</Label>

                    <Input id="name" v-model="form.name" class="mt-1 block w-full" />

                    <InputError :message="form.errors.name" />
                </div>

                <div class="grid gap-2">
                    <Label htmlFor="is_completed">Completed?</Label>

                    <Checkbox id="is_completed" v-model:checked="form.is_completed" class="mt-1" />

                    <InputError :message="form.errors.is_completed" />
                </div>

                <div class="flex items-center gap-4">
                    <Button :disabled="form.processing" variant="default">Update Task</Button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
