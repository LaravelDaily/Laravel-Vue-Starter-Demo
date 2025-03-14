<script setup lang="ts">
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import AppLayout from '@/layouts/AppLayout.vue';
import { Task } from '@/types';
import { Head, router } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { toast } from 'vue-sonner';

interface Props {
    tasks: Task[];
}

defineProps<Props>();

const deleteTask = (id: number) => {
    if (confirm('Are you sure you want to delete this task?')) {
        router.delete(route('tasks.destroy', { id }));
        toast.success('Task deleted successfully');
    }
};
</script>

<template>
    <AppLayout>
        <Head title="Index" />
        <Table class="mt-4">
            <TableHeader>
                <TableRow>
                    <TableHead>Task</TableHead>
                    <TableHead class="w-[100px]">Status</TableHead>
                    <TableHead class="w-[100px] text-right">Actions</TableHead>
                </TableRow>
            </TableHeader>
            <TableBody>
                <TableRow v-for="task in tasks" :key="task.id">
                    <TableCell>{{ task.name }}</TableCell>
                    <TableCell class="{{ task.is_completed ? 'text-green-600' : 'text-red-700'}}">
                        {{ task.is_completed ? 'Completed' : 'In Progress' }}
                    </TableCell>
                    <TableCell class="text-right">
                        <Button
                            variant="destructive"
                            @click="deleteTask(task.id)"
                            class="mr-2">Delete</Button>
                    </TableCell>
                </TableRow>
            </TableBody>
        </Table>
    </AppLayout>
</template>
