<script setup lang="ts">
import { BarChart } from '@/components/ui/chart-bar';
import { DonutChart } from '@/components/ui/chart-donut';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

interface Props {
    completedVsPendingTaskChart: [];
    pendingTasksToday: number;
    tasksCreatedByDay: object;
}

defineProps<Props>();
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 p-4 dark:border-sidebar-border">
                    <h2 class="pb-4 text-center text-3xl font-bold">Progress Overview</h2>
                    <DonutChart
                        class="h-32"
                        index="name"
                        :category="'total'"
                        :data="completedVsPendingTaskChart"
                        :type="'pie'"
                        data-size="sm"
                        :colors="['#00a64b', '#e3544f']"
                        :show-legend="true"
                    />
                </div>
                <div
                    class="relative flex aspect-video flex-col items-center justify-start overflow-hidden rounded-xl border border-sidebar-border/70 py-4 dark:border-sidebar-border"
                >
                    <h2 class="text-center text-3xl font-bold">Tasks Due Today</h2>
                    <p class="mb-auto mt-auto text-xl">{{ pendingTasksToday }} task(-s) due today.</p>
                </div>
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <h2 class="pb-4 text-center text-3xl font-bold pt-4">Tasks by Day</h2>
                    <BarChart class="h-32 p-4" index="name" :data="tasksCreatedByDay" :categories="['Tasks Created']" :rounded-corners="4" />
                </div>
            </div>
            <div class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min">
                <PlaceholderPattern />
            </div>
        </div>
    </AppLayout>
</template>
