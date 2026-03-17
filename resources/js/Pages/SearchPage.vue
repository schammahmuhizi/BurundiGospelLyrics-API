<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import SongCard from '@/Components/SongCard.vue';
import { Search, Info } from 'lucide-vue-next';

defineProps({
    results: Array,
    query: String
});
</script>

<template>
    <AppLayout>
        <Head :title="`Search results for '${query}'`" />

        <div class="py-12 space-y-16 min-h-screen">
            <!-- Search Header -->
            <div class="space-y-6">
                <div class="flex items-center gap-4 text-amber-500">
                    <Search class="w-8 h-8" />
                    <span class="text-sm font-black uppercase tracking-[0.3em]">Discovery</span>
                </div>
                <h1 class="text-5xl md:text-7xl font-black text-slate-900 dark:text-white tracking-tighter uppercase leading-none">
                    RESULTS FOR <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-500 to-orange-600">"{{ query }}"</span>
                </h1>
                <p class="text-xl text-slate-500 dark:text-slate-400 font-medium max-w-2xl">
                    Found {{ results.length }} matching creative works in the global catalog.
                </p>
            </div>

            <!-- Results Grid -->
            <div v-if="results.length > 0" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8">
                <SongCard v-for="song in results" :key="song.id" :song="song" />
            </div>

            <!-- Empty State -->
            <div v-else class="flex flex-col items-center justify-center py-32 text-center space-y-8">
                <div class="w-32 h-32 bg-slate-100 dark:bg-slate-900 rounded-full flex items-center justify-center border border-slate-200 dark:border-slate-800">
                    <Info class="w-12 h-12 text-slate-300 dark:text-slate-700" />
                </div>
                <div class="space-y-4">
                    <h2 class="text-4xl font-black text-slate-900 dark:text-white uppercase tracking-tight">No Matches Found</h2>
                    <p class="text-slate-500 dark:text-slate-400 text-lg font-medium max-w-md mx-auto">
                        We couldn't find any lyrics or artists matching your request. Try different keywords or check your spelling.
                    </p>
                </div>
                <Link href="/" class="px-8 py-4 bg-amber-500 text-white rounded-2xl font-black shadow-lg shadow-amber-500/20 hover:scale-105 transition-all">
                    BACK TO HOME
                </Link>
            </div>
        </div>
    </AppLayout>
</template>
